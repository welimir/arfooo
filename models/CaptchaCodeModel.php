<?php

class CaptchaCodeModel extends Model
{
    protected $primaryKey = "captchaCodeId";

    function deleteExpiredCaptchaCodes()
    {
        $c = new Criteria();
        $c->add("ADDDATE( generationDate , INTERVAL 1 HOUR ) < NOW()");
        $this->del($c);
    }

    function validatePublicAndPrivateCodes($request)
    {
        if (empty($request->privateCode) || empty($request->publicCode)) {
            return false;
        }

        $c = new Criteria();
        $c->add("publicCode", $request->publicCode);
        $c->add("privateCode", $request->privateCode);

        $result = $this->getCount($c);
        $this->del($c);

        return ($result == 1);
    }

}

class CaptchaCodeRecord extends ModelRecord
{
    function generateCaptchaCodesAndGetPublicOne()
    {
        // generate random private code
        $lettersSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $privateCode = '';
        do {
            for ($i = 0; $i < 4; $i++) {
                $privateCode .= substr($lettersSet, rand(0, strlen($lettersSet) - 1), 1);
            }
        } while (strlen($privateCode) != 4);

        // generate random public code
        $publicCode = '';
        do {
            for ($i = 0; $i < 20; $i++) {
                $publicCode .= substr($lettersSet, rand(0, strlen($lettersSet) - 1), 1);
            }
        } while (strlen($publicCode) != 20);

        $this->publicCode = $publicCode;
        $this->privateCode = $privateCode;
        $this->save();

        Model::factoryInstance("captchaCode")->deleteExpiredCaptchaCodes();

        return $publicCode;
    }
}
