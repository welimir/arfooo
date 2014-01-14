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


class ExtraFieldValueModel extends Model
{
    public function deleteFieldValue($itemId, $fieldId)
    {
        $c = new Criteria();
        $c->add('itemId', $itemId);
        $c->add('fieldId', $fieldId);

        $fieldValue = $this->find($c);
        if ($fieldValue) {
            $extraField = $this->extraField->findByPk($fieldId);

            if ($extraField->type == 'file') {
                $data = unserialize($fieldValue->text);

                if ($data['fileSrc']) {
                    $filePath = CODE_ROOT_DIR . 'uploads/files/' . $data['fileSrc'];
                    if (file_exists($filePath)) {
                        unlink ($filePath);
                    }
                }

                $this->del($c);
            }
        }
    }
}

class ExtraFieldValueRecord extends ModelRecord
{

}
