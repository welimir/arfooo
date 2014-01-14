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


class CaptchaController extends AppController
{
    /**
     * Display captcha html with new captcha image
     */
    function showAction($newCaptchaLinkClass = null)
    {
        $captcha = new CaptchaCodeRecord();
        $this->set("generatedPublicCode", $captcha->generateCaptchaCodesAndGetPublicOne());
        $this->set("newCaptchaLinkClass", $newCaptchaLinkClass);
    }

    /**
     * Change captcha image to new
     */
    function changeAction($publicCode)
    {
        $c = new Criteria();
        $c->add("publicCode", $publicCode);

        //remove old captcha
        $this->captchaCode->del($c);

        //create new CaptchaCodeRecord
        $captcha = new CaptchaCodeRecord();
        $this->set("newPublicCode", $captcha->generateCaptchaCodesAndGetPublicOne());
        $this->viewClass = "JsonView";
    }

    /**
     * Display captcha PNG image
     */
    function pngAction($publicCode)
    {
        //find captchaCode by public code
        $c = new Criteria();
        $c->add("publicCode", $publicCode);
        $captcha = $this->captchaCode->find($c);

        //display private code as image
        $this->set("code", $captcha->privateCode);
        $this->viewClass = "CaptchaView";
    }
}
