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


class Admin_TemplateController extends AppController
{
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    function previewAction($previewTemplateName)
    {
        setcookie("previewTemplateName", $previewTemplateName, 0, "/");
    }

    function updateAction()
    {
        $this->setting->set("templateName", $this->request->templateName);
        Cacher::getInstance()->clean("tag", array("setting"));
        $this->redirect($this->moduleLink());
    }

    function indexAction()
    {
        setcookie("previewTemplateName", false, 0, "/");

        $templates = array();
        $dir = new DirectoryIterator(Config::get('TEMPLATES_PATH'));

        while ($dir->valid()) {
            if (!$dir->isDot()) {
                $templates[] = (string) $dir->current();
            }

            $dir->next();
        }

        $this->set("alltemplates", $templates);

    }
}
