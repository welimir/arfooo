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


class PayPalPaymentProcessor extends PaymentProcessor
{
    private $processorId = "PayPal";
    private $normalFormActionUrl = "https://www.paypal.com/cgi-bin/webscr";
    private $testModeFormActionUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    private $currentPayment;
    private $debug = false;

    public function __construct()
    {
        parent::__construct($this->processorId);
    }

    public function getActionUrl()
    {
        return ($this->settings->testMode) ? $this->testModeFormActionUrl : $this->normalFormActionUrl;
    }

    public function getPaymentOptions()
    {
        $paymentOptions = $this->settings->toArray();
        $paymentOptions = array_merge($paymentOptions,
                                      array("formActionUrl" => $this->getActionUrl()));

        foreach ($this->product as $key => $value) {
            $paymentOptions[$key] = $value;
        }

        return $paymentOptions;
    }

    public function processPayment()
    {
        $payment = $this->createNewPayment();
        $payment->save();

        $this->product->itemNumber = $payment->paymentId;

        return true;
    }

    public function setProduct($package)
    {
        $this->product = new PayPalProduct($package);
        return $this->product->valid;
    }

    public function setNotifyUrl($url)
    {
        $this->settings->notifyUrl = $url;
    }

    public function setCancelReturnUrl($url)
    {
        $this->settings->cancelReturnUrl = $url;
    }

    public function setReturnUrl($url)
    {
        $this->settings->returnUrl = $url;
    }

    private function payLog($msg, $type = "normal")
    {
        if ($this->debug) {
            if ($type == "error") {
                $msg = "ERROR: " . $msg;
            }
            $fp = fopen(CODE_ROOT_DIR . "ipn.html", "a");
            fwrite($fp, $msg);
            fclose($fp);
        }

        return ($type != "error");
    }

    private function onComplete()
    {
        if (in_array($this->currentPayment->status, array("unpaid", "pending"))) {
            $this->currentPayment->updateStatus("paid");
            $this->payLog("Payment was completed successfully");
        }
    }

    private function onPending()
    {
        if ($this->currentPayment->status == "unpaid") {
            $this->currentPayment->updateStatus("pending");
            $this->payLog("Payment status was changed to pending");
        }
    }

    private function onDenied()
    {
        $this->currentPayment->updateStatus("denied");
    }

    private function validatePayment($ipnData)
    {
        if (empty($this->currentPayment)) {
            return "Payment don't exists";
        }
        if ($ipnData['receiver_email'] != $this->settings->email) {
            return "Bad receiver mail";
        }
        if ($ipnData['mc_gross'] != $this->currentPayment->amount) {
            return "Bad amount";
        }
        if ($ipnData['mc_currency'] != $this->currentPayment->currency) {
            return "Bad currency";
        }

        return "";
    }

    public function handleIpn()
    {
        $ipnData = $this->request;

        $postData = 'cmd=_notify-validate';

        foreach ($ipnData as $key => $value) {
            $postData .= "&" . urlencode($key) . "=" . urlencode($value);
        }

        $httpClient = new HttpClient();
        $url = $this->getActionUrl();
        $buff = $httpClient->getSiteContent($url, false, true, false, "POST", $postData);

        if (strcmp($buff, "VERIFIED") != 0) {
            return $this->payLog("Request isn't VERIFIED", "error");
        }

        if ($this->debug) {
            $this->payLog(var_export($ipnData, true) . "\r\n");
        }
        if ($this->debug) {
            $this->payLog($postData . "\r\n");
        }

        foreach (array("item_number", "receiver_email", "mc_gross", "mc_currency",
                       "txn_type", "payment_status") as $key) {
            if (empty($ipnData[$key])) {
                return $this->payLog("Field $key is not set", "error");
            }
        }

        $this->currentPayment = $this->payment->findByPk($ipnData['item_number']);

        $errorMessage = $this->validatePayment($ipnData);
        if ($errorMessage) {
            return $this->payLog($errorMessage, "error");
        }

        switch ($ipnData['txn_type']) {
            case "web_accept":

                switch ($ipnData['payment_status']) {
                    case "Completed":
                        $this->onComplete();
                        break;

                    case "Pending":
                        $this->onPending();
                        break;

                    case "Denied":
                        $this->onDenied();
                        break;
                }

                break;

            default:
                return $this->payLog("Unhandled txn_type", "error");
        }

        return $this->payLog("Finished");
    }
}

class PayPalProduct extends PackageProduct
{
    public $itemName;
    public $itemNumber;

    public function __construct($package)
    {
        parent::__construct($package);
        $this->itemName = $package->name;
        $this->valid = true;
    }
}
