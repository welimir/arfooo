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


class AllopassPaymentProcessor extends PaymentProcessor
{
    private $processorId = "Allopass";
    private $allopassMaxTime = 3;

    function __construct()
    {
        parent::__construct($this->processorId);
    }

    function setProduct($package)
    {
        $this->product = new AllopassProduct($package);
        return $this->product->valid;
    }

    function getPaymentOptions()
    {
        $paymentOptions = $this->settings->toArray();
        foreach ($this->product as $key => $value) {
            $paymentOptions[$key] = $value;
        }
        return $paymentOptions;
    }

    public function sendCode($code)
    {
        $url = "http://www.allopass.com/check/index.php4?";
        $url .= "SITE_ID=" . $this->product->siteId;
        $url .= "&DOC_ID=" . $this->product->docId;

        for ($i = 0, $n = count($code); $i < $n; $i++) {
            $url .= "&CODE" . $i . "=" . urlencode($code[$i]);
        }

        $httpClient = new HttpClient();
        $buff = $httpClient->getSiteContent($url, false);
        return ($buff !== false);
    }

    public function verifyCode($code)
    {
        $url = "http://www.allopass.com/check/vf.php4?";
        $url .= "AUTH=" . urlencode($this->product->allopassId);
        $url .= "&CODE=";

        for ($i = 0, $n = count($code); $i < $n; $i++) {
            $url .= urlencode($code[$i]);
            if ($i + 1 < $n) {
                $url .= ",";
            }
        }

        $url .= "&MAXT=" . $this->allopassMaxTime;

        $httpClient = new HttpClient();
        $buff = $httpClient->getSiteContent($url, false);
        return (strncmp("OK", $buff, 2) == 0);
    }

    public function saveCode($codes)
    {
        foreach ($codes as $code) {
            $allopassCode = new AllopassCodeRecord();
            $allopassCode->code = $code;
            $allopassCode->ip = $this->request->getIp();
            $allopassCode->save();
        }
    }

    public function canBeUsed($codes)
    {
        $this->allopassCode->cleanUpOvertimed($this->allopassMaxTime);

        foreach ($codes as $code) {
            $c = new Criteria();
            $c->add("code", $code);
            if ($this->allopassCode->getCount($c)) {
                return false;
            }
        }

        return true;
    }

    public function validateCodes($codes)
    {
        foreach ($codes as $code) {
            if (empty($code) || !preg_match("#^[a-z0-9]+$#i", $code)) {
                return "Please enter a valid code";
            }
        }

        if (!$this->sendCode($codes)) {
            return "Can't check code on allopass.com";
        }
        if (!$this->verifyCode($codes)) {
            return "You have entered an invalid code";
        }
        if (!$this->canBeUsed($codes)) {
            return "This code was used earlier";
        }
        return '';
    }

    public function processPayment()
    {
        $codes = $this->request->code;
        $errorMessage = $this->validateCodes($codes);

        if (!empty($errorMessage)) {
            return $this->setLastError($errorMessage);
        }

        $payment = $this->createNewPayment();
        $payment->status = "paid";
        $payment->save();

        $this->saveCode($codes);

        return true;
    }
}

class AllopassProduct extends PackageProduct
{
    public $allopassId;
    public $allopassNumber;
    public $siteId;
    public $docId;
    public $authId;

    public function __construct($package)
    {
        parent::__construct($package);

        if (empty($package->allopassId) || empty($package->allopassNumber)) {
            return;
        }

        $this->allopassId = $package->allopassId;
        $this->allopassNumber = $package->allopassNumber;

        $values = explode("/", $this->allopassId);
        if (count($values) != 3) {
            return;
        }

        $this->siteId = $values[0];
        $this->docId = $values[1];
        $this->authId = $values[2];
        $this->valid = true;
    }
}
