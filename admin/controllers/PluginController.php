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


class Admin_PluginController extends AppController
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

    /**
     * Get available plugins in /plugin directory
     */
    function getAvailablePlugins()
    {
        $plugins = array();
        $dir = new DirectoryIterator(CODE_ROOT_DIR . 'plugins/');

        foreach ($dir as $file) {
            if (!$file->isDot() && $file->isDir()) {
                $plugins[] = $file->getFilename();
            }
        }

        return $plugins;
    }

    /**
     * Show plugin details
     */
    function editAction($pluginName)
    {
        $pluginName = basename($pluginName);
        $pluginRootPath = CODE_ROOT_DIR . "plugins/" . $pluginName . "/";

        $descriptionPath = $pluginRootPath . "info.txt";
        $pluginDescription = file_exists($descriptionPath) ? file_get_contents($descriptionPath) : "";

        $functionsPath = $pluginRootPath . "functions.xml";
        $pluginFunctions = array();

        if (file_exists($functionsPath)) {
            $xml = new SimpleXMLElement(file_get_contents($functionsPath));

            foreach ($xml->function as $function) {
                $pluginFunctions[] = array("action"      => (string) $function->action,
                                           "description" => (string) $function->description);
            }

        }

        $this->set("pluginDescription", $pluginDescription);
        $this->set("pluginFunctions", $pluginFunctions);
    }

    /**
     * Display plugins managment page
     */
    function indexAction()
    {
        $plugins = $this->getAvailablePlugins();
        $this->set("plugins", $plugins);
    }
}
