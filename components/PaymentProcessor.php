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


abstract class PaymentProcessor extends AppController
{
    protected $settings;
    protected $product;

    abstract function setProduct($package);

    abstract function getPaymentOptions();

    function __construct($processId)
    {
        parent::__construct();
        $this->settings = $this->paymentProcessor->findByPk($processId);
    }

    public function createNewPayment()
    {
        $payment = new PaymentRecord();
        $payment->ip = $this->request->getIp();
        $payment->description = $this->product->name;
        $payment->amount = $this->product->amount;
        $payment->currency = $this->settings->currency;
        $payment->processorId = $this->settings->processorId;
        $payment->packageId = $this->product->packageId;

        if ($this->userId) {
            $payment->userId = $this->userId;
        }

        return $payment;
    }
}

class PackageProduct
{
    public $name;
    public $amount;
    public $packageId;
    public $valid = false;

    public function __construct($package)
    {
        $this->name = $package->name;
        $this->amount = $package->amount;
        $this->packageId = $package->packageId;
    }
}
