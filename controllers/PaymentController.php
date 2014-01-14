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


class PaymentController extends AppController
{
    /**
     * Initailize controller set access privileges
     */
    function init()
    {
        $this->acl->allow('webmaster', $this->name, "*");
        $this->acl->allow('guest', $this->name, "ipn");

        if (!Config::get("registrationOfWebmastersEnabled")) {
            $this->acl->allow('guest', $this->name, "selectPaymentOptions");
            $this->acl->allow('guest', $this->name, "makePayment");
            $this->acl->allow('guest', $this->name, "processPayment");
        }

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/webmaster/logIn"));
        }
    }

    public function selectPaymentOptionsAction()
    {
        $packages = $this->package->findAll();
        $payPal = $this->paymentProcessor->findByPk("PayPal");
        $allopass = $this->paymentProcessor->findByPk("Allopass");
        $allopassNumbers = array();

        foreach ($packages as &$package) {
            $details = "";

            if ($payPal->active) {
                $details .= " " . $package['amount'] . " " . $payPal->currency;
            }

            if ($payPal->active && $allopass->active && $package['allopassNumber'])
                $details .= " or ";

            if ($allopass->active && $package['allopassNumber']) {
                $details .= $package['allopassNumber'] . " Allopass";
            }

            $package['details'] = $details;
            $allopassNumbers[$package['packageId']] = $package['allopassNumber'];
        }

        $this->set("packages", $packages);
        $this->set("allopassNumbersJSON", JsonView::php2js($allopassNumbers));
        $c = new Criteria();
        $c->add("active", 1);
        $this->set("paymentProcessors", $this->paymentProcessor->getArray($c, "displayName"));
    }

    public function factoryPaymentProcessor($processorId)
    {
        switch ($processorId) {
            case "PayPal":
                $paymentProcessor = new PayPalPaymentProcessor();
                break;

            case "Allopass":
                $paymentProcessor = new AllopassPaymentProcessor();
                break;

            default:
                $paymentProcessor = null;
        }

        return $paymentProcessor;
    }

    public function makePaymentAction()
    {
        if (empty($this->request->processorId)) {
            $this->redirect($this->moduleLink("selectPaymentOptions"));
        }

        $processorId = $this->request->processorId;
        $package = $this->package->findByPk($this->request->packageId);
        $paymentProcessor = $this->factoryPaymentProcessor($this->request->processorId);

        if (empty($paymentProcessor) || empty($package)) {
            $this->redirect($this->moduleLink("selectPaymentOptions"));
        }

        if (!$paymentProcessor->setProduct($package)) {
            $this->return404();
        }

        $this->set("package", $package);
        $this->set("paymentOptions", $paymentProcessor->getPaymentOptions());
    }

    public function processPaymentAction()
    {
        if (empty($this->request->processorId) || empty($this->request->packageId)) {
            $this->redirect($this->moduleLink("selectPaymentOptions"));
        }

        $processorId = $this->request->processorId;
        $package = $this->package->findByPk($this->request->packageId);
        $paymentProcessor = $this->factoryPaymentProcessor($processorId);

        if (empty($paymentProcessor) || empty($package)) {
            $this->return404();
        }

        if (!$paymentProcessor->setProduct($package)) {
            $this->return404();
        }

        $processPaymentSuccesfully = $paymentProcessor->processPayment();

        if ($processorId == "PayPal") {
            $notifyUrl = Config::get("siteRootUrl") . $this->moduleLink("ipn", false);

            $returnUrl = Config::get("siteRootUrl") . AppRouter::getRewrittedUrl("/webmaster/loading", false);
            $cancelReturnUrl = Config::get("siteRootUrl") . AppRouter::getRewrittedUrl("/webmaster/submitWebsite/premium", false);

            $paymentProcessor->setNotifyUrl($notifyUrl);
            $paymentProcessor->setReturnUrl($returnUrl);
            $paymentProcessor->setCancelReturnUrl($cancelReturnUrl);

            $this->set("paymentOptions", $paymentProcessor->getPaymentOptions());
        }

        if ($processorId == "Allopass") {
            $this->viewClass = "JsonView";

            if (!$processPaymentSuccesfully) {
                //set status to js part about that something is wrong with site data
                $this->set("status", "error");

                //set error message what is wrong
                $this->set("message", _t($paymentProcessor->getLastError()));
                return;
            }

            //set status to js part about site proccessing
            $this->set("status", "ok");

            //inform js to redirect
            $redirectUrl = AppRouter::getRewrittedUrl("/webmaster/submitWebsite/premium");

            $this->set("redirectUrl", $redirectUrl);
            $this->set("message", _t("Allopass was validated sucessfully."));
        }
    }

    public function ipnAction()
    {
        $paymentProcessor = new PayPalPaymentProcessor();
        $paymentProcessor->handleIpn();

        $this->autoRender = false;
    }
}
