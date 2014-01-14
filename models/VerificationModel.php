<?php
//
// copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
// by Guillaume Hocine (c) 2007 - 2010
// Developer Team : Adrian Galewski
// http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
// Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/
//


class VerificationModel extends Model
{
    protected $primaryKey = "code";

    function addVerification($itemId, $type, $data = "")
    {
        if ($itemId === null) {
            $itemId = md5($data);
        }
        $c = new Criteria();
        $c->add("itemId", $itemId);
        $c->add("type", $type);

        $verification = $this->find($c);
        if (!empty($verification)) {
            return $verification;
        }

        do {
            $code = md5(mt_rand());
        } while ($this->findByPk($code));

        $verification = new VerificationRecord();
        $verification->itemId = $itemId;
        $verification->type = $type;
        $verification->code = $code;
        $verification->data = $data;
        $verification->save();

        return $verification;
    }

    function findByCodeType($code, $type)
    {
        $c = new Criteria();
        $c->add("code", $code);
        $c->add("type", $type);

        return $this->find($c);
    }
}

class VerificationRecord extends ModelRecord
{

}
