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


class Admin_ExtraFieldController extends AppController
{
    /**
     * set access privileges
     */
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    function getByCategoryIdAction()
    {
        $categoryId = $this->request->categoryId;
        $extraFields = $this->extraField->getCategoryFieldsWithOptions($categoryId);
        $this->set("extraFields", $extraFields);

        $this->viewFile = "itemForm";
    }

    function saveFieldAction()
    {
        $fields = array("name", "type", "required", "description", "suffix");
        $fieldId = !empty($this->request->fieldId) ? $this->request->fieldId : null;

        $configFields = array(
            'url'  => array('nofollow' => '', 'anchor' => ''),
            'file' => array('extensions' => '', 'maxSize' => '')
        );

        if ($fieldId) {
            $c = new Criteria();
            $c->add("fieldId", $fieldId);

            $extraField = $this->extraField->findByPk($fieldId);
        } else {
            $extraField = new ExtraFieldRecord();
        }

        $extraField->fromArray($this->request->getArray($fields));

        if (!empty($this->request->config)
            && !empty($configFields[$this->request->type])
        ) {
            $config = array_intersect_key(
                $this->request->config,
                $configFields[$this->request->type]
            );
            if (!empty($config)) {
                $extraField->config = serialize($config);
            }
        }
        $extraField->save();

        if (!$fieldId) {
            $fieldId = $extraField->fieldId;
            $extraFieldCategory = new ExtraFieldCategoryRecord();
            $extraFieldCategory->categoryId = $this->request->categoryId;
            $extraFieldCategory->fieldId = $extraField->fieldId;
            $extraFieldCategory->save();
        }

        $lp = 0;

        if (!empty($this->request->option)) {
            foreach ($this->request->option as $value => $label) {
                if (empty($value)) {
                    continue;
                }

                $c = new Criteria();
                $c->add("fieldId", $fieldId);
                $c->add("value", $value);

                $extraFieldOption = $this->extraFieldOption->find($c);

                $label = trim($label);
                if (empty($label) && !$extraFieldOption) {
                    continue;
                }

                if ($extraFieldOption) {
                    if ($label) {
                        $extraFieldOption->label = $label;
                        $this->extraFieldOption->update(array("label" => $label,
                                                              "position" => ++$lp),
                                                        $c);
                    } else {
                        $this->extraFieldOption->del($c);
                    }
                } else {
                    $extraFieldOption = new ExtraFieldOptionRecord();
                    $extraFieldOption->fieldId = $fieldId;
                    $extraFieldOption->value = $value;
                    $extraFieldOption->label = $label;
                    $extraFieldOption->position = ++$lp;
                    $extraFieldOption->save();
                }
            }
        }

        if (isset($this->request->returnUrl)) {
            $returnUrl = $this->request->returnUrl;
        } else {
            $returnUrl = $this->request->getRefererUrl();
        }

        $this->redirect($returnUrl);
    }

    function editAction($fieldId)
    {
        $extraField = $this->extraField->findByPk($fieldId);

        if (empty($extraField)) {
            $this->return404();
        }

        $extraField->options = $this->extraField->getOptions($fieldId);
        $config = unserialize($extraField->config);
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                $extraField['config[' . $key . ']'] = $value;
            }
        }

        $this->set("extraField", $extraField);
        $this->set("extraFieldJson", JsonView::php2js($extraField));
        $this->set('returnUrl', $this->request->getRefererUrl());
    }

    function deleteAction($fieldId)
    {
        $extraField = $this->extraField->findByPk($fieldId);

        if (empty($extraField)) {
            $this->return404();
        }

        $c = new Criteria();
        $c->add("fieldId", $extraField->fieldId);
        $c->setLimit(1);

        $categoryId = $this->extraFieldCategory->get("categoryId", $c);
        $extraField->del();

        $url = AppRouter::getRewrittedUrl("/admin/category/edit/" . $categoryId);

        $this->redirect($url);
    }

    function savePositionsAction()
    {
        $this->viewClass = "JsonView";

        foreach ($this->request->positions as $fieldId => $position) {
            $this->extraField->updateByPk(array("position" => $position), $fieldId);
        }

        $this->set("status", "ok");
    }
}
