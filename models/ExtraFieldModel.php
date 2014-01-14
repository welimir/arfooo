<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class ExtraFieldModel extends Model
{
    protected $primaryKey = "fieldId";

    function getCategoryFields($categoryId)
    {
        $c = new Criteria();
        $c->addInnerJoin("extrafieldcategories", "extrafieldcategories.fieldId", "extrafields.fieldId");
        $c->addInnerJoin("categoryparents", "categoryparents.parentId", "extrafieldcategories.categoryId");
        $c->add("categoryparents.childId", $categoryId);
        $c->addOrder("position");

        $fields = $this->findAll($c);
        return $fields;
    }

    function getOptions($fieldId)
    {
        $c = new Criteria();
        $c->add("fieldId", $fieldId);
        $c->addOrder("position");

        $options = $this->extraFieldOption->findAll($c);
        return $options;
    }

    function getCategoryFieldsWithOptions($categoryId)
    {
        $fields = $this->getCategoryFields($categoryId);
        $extraFields = array();

        foreach ($fields as $field) {
            $extraFields[$field['fieldId']] = $field;
            $extraFields[$field['fieldId']]['options'] = array();
            if ($field['config']) {
                $extraFields[$field['fieldId']]['config'] = unserialize($field['config']);
            } else {
                $extraFields[$field['fieldId']]['config'] = array();
            }
        }

        $c = new Criteria();
        $c->add("fieldId", array_keys($extraFields), "IN");
        $options = $this->extraFieldOption->findAll($c);

        foreach ($options as $option) {
            $extraFields[$option['fieldId']]['options'][$option['value']] = $option;
        }

        return $extraFields;
    }

    function validate($newItem)
    {
        $extraFields = $this->extraField->getCategoryFieldsWithOptions($newItem->categoryId);

        foreach ($extraFields as $field) {
            $fieldId = $field['fieldId'];

            if ($field['required']
                && (empty($newItem->extraField)
                    || empty($newItem->extraField[$fieldId])
                    )
            ) {
                return "You don't fill required field " . $field['name'];
            }

            if ($field['type'] == 'file') {
                $file = new UploadedFile('extraField_' . $fieldId . '_file');
                $extensions = preg_split('/\s*,\s*/', $field['config']['extensions']);
                $file->addFilter('extension', $extensions);
                $file->addFilter('maxSize', intval($field['config']['maxSize']) * 1024);
                if ($file->wasUploaded()) {
                    try {
                        $file->validate();
                    } catch (Exception $e) {
                        return $e->getMessage();
                    }
                }
            }
        }
    }

    function saveExtraFieldsValues($item, $newItem)
    {
        $fields = $this->getCategoryFieldsWithOptions($item->categoryId);
        $itemId = $item->siteId;

        $c = new Criteria();
        $c->addInnerJoin('extrafields', 'extrafields.fieldId', 'extrafieldvalues.fieldId');
        $c->add('type', 'file');
        $files = $this->extraFieldValue->getArray($c, 'text', 'extrafields.fieldId');

        $c = new Criteria();
        $c->add("itemId", $itemId);
        $this->extraFieldValue->del($c);

        foreach ($fields as $fieldId => $field) {
            $extraFieldValue = new ExtraFieldValueRecord();
            $extraFieldValue->itemId = $itemId;
            $extraFieldValue->fieldId = $fieldId;

            if (!isset($newItem->extraField[$fieldId])) {
                continue;
            }

            $newItemExtraFieldData = $newItem->extraField[$fieldId];

            try {
                switch ($field['type']) {
                    case "text":
                    case "textarea":
                        $extraFieldValue->text = $newItemExtraFieldData;
                        break;

                    case "select":
                    case "radio":
                        if (!isset($field['options'][$newItemExtraFieldData])) {
                            continue 2;
                        }

                    case "range":
                        $extraFieldValue->value = $newItemExtraFieldData;
                        break;

                    case 'url':
                        $extraFieldValue->text = serialize($newItemExtraFieldData);
                        break;

                    case "checkbox":
                        $value = 0;

                        foreach ($newItemExtraFieldData as $checkBoxValue) {
                            if (!isset($field['options'][$checkBoxValue])) {
                                continue 3;
                            }
                            $value += pow(2, $checkBoxValue - 1); //minus 1 because we count from 1,2,3,4.. to have 1,2,4,8
                        }

                        $extraFieldValue->value = $value;
                        break;

                    case 'file':
                        $file = new UploadedFile('extraField_' . $fieldId . '_file');

                        if (!empty($files[$fieldId])) {
                            $data = unserialize($files[$fieldId]);
                        } else {
                            $data = array();
                        }

                        $data['title'] = $newItemExtraFieldData['title'];

                        if ($file->wasUploaded()) {
                            $filesPath = CODE_ROOT_DIR . 'uploads/files/';
                            $file->setSavePath($filesPath);
                            $file->save();
                            $fileSrc = $file->getSavedFileName();
                            $data['fileSrc'] = $fileSrc;
                        }

                        $extraFieldValue->text = serialize($data);
                }

                $extraFieldValue->save();

            } catch (Exception $e) {

            }
        }

        $this->site->updateByPk(array("haveExtraFields" => !empty($newItem->extraField) ? "1" : "0"), $itemId);
    }

    function getItemExtraFields($item)
    {
        $extraFields = $this->getCategoryFieldsWithOptions($item->categoryId);
        $itemExtraFields = array();

        $c = new Criteria();
        $c->add("itemId", $item->siteId);
        $extraFieldValues = $this->extraFieldValue->getArray($c, "*", "fieldId", true);

        foreach ($extraFields as $fieldId => $extraField) {
            if (empty($extraFieldValues[$fieldId])) {
                continue;
            }

            $extraFieldValue = $extraFieldValues[$fieldId];

            switch ($extraField['type']) {
                case "text":
                case "textarea":
                    $itemExtraFieldValue = $extraFieldValue['text'];
                    $itemExtraFieldLabel = $extraFieldValue['text'];
                    break;

                case "select":
                case "radio":
                    $itemExtraFieldValue = $extraFieldValue['value'];
                    $itemExtraFieldLabel = $extraField['options'][$extraFieldValue['value']]['label'];
                    break;

                case "checkbox":
                    $itemExtraFieldValue = array();
                    $itemExtraFieldLabel = array();

                    foreach ($extraField['options'] as $option) {
                        if ($extraFieldValue['value'] & pow(2, $option['value'] - 1)) {
                            $itemExtraFieldValue[] = $option['value'];
                            $itemExtraFieldLabel[] = $option['label'];
                        }
                    }
                    break;

                case "range":
                    $itemExtraFieldValue = $extraFieldValue['value'];
                    $itemExtraFieldLabel = $extraFieldValue['value'];
                    break;

                case 'url':
                case 'file':
                    $itemExtraFieldValue = unserialize($extraFieldValue['text']);
                    $itemExtraFieldLabel = '';
                    break;
            }

            $itemExtraFields[$fieldId] = array(
                'name'   => $extraField['name'],
                'type'   => $extraField['type'],
                'value'  => $itemExtraFieldValue,
                'label'  => $itemExtraFieldLabel,
                'suffix' => $extraField['suffix'],
                'config' => $extraField['config']
            );
        }

        return $itemExtraFields;
    }

    function createExtraFieldsCriteria($categoryId, $extraFieldsValues)
    {
        $c = new Criteria();
        $extraFields = $this->getCategoryFields($categoryId);

        foreach ($extraFields as $extraField) {
            $fieldId = $extraField['fieldId'];

            if (empty($extraFieldsValues[$fieldId])
                || ($extraField['type'] == "range"
                && empty($extraFieldsValues[$fieldId]['from'])
                && empty($extraFieldsValues[$fieldId]['to']))
            ) {
                continue;
            }

            $c2 = new Criteria();
            $prefix = Config::get("DB_PREFIX");
            $sql = "EXISTS (SELECT * FROM " . $prefix . "extrafieldvalues WHERE itemId = " . $prefix . "sites.siteId AND fieldId = '$fieldId' AND ";

            switch ($extraField['type']) {
                case "text":
                case "textarea":
                    $c2->add("text", $extraFieldsValues[$fieldId], "LIKE");
                    break;

                case "checkbox":
                    $value = 0;
                    $checkboxValues = $extraFieldsValues[$fieldId];

                    foreach ($checkboxValues as $checkBoxValue) {
                        $value += pow(2, $checkBoxValue - 1); //minus 1 because we count from 1,2,3,4.. to have 1,2,4,8
                    }

                    $c2->add("value & $value = $value");
                    break;

                case "select":
                case "radio":
                    $c2->add("value", $extraFieldsValues[$fieldId]);
                    break;

                case "range":
                    if (!empty($extraFieldsValues[$fieldId]['from'])) {
                        $c2->add("value", $extraFieldsValues[$fieldId]['from'], ">=");
                    }

                    if (!empty($extraFieldsValues[$fieldId]['to'])) {
                        $c2->add("value", $extraFieldsValues[$fieldId]['to'], "<=");
                    }
                    break;
            }

            $sql .= $c2->prepareQuery();
            $sql .= ")";
            $c->add($sql);
        }

        return $c;
    }

}

class ExtraFieldRecord extends ModelRecord
{

}
