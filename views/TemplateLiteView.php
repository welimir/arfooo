<?php
//////////////////////////////////////////////////////////////////////////////////
//    					 copyright (c) Arfooo Annuaire                          //
//   				 by Hocine Guillaume (c) 2007 - 2008                        //
//       					http://www.arfooo.com/                              //
//    Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/   //
//////////////////////////////////////////////////////////////////////////////////


class TemplateLiteView extends View
{
    /**
     * @var Template_Lite $templateLite
     */
    protected $templateLite;
    protected $viewFile;
    protected $vars;
    protected $debug = false;
    protected $templateName;

    function __construct()
    {
        require_once (Config::get("COMPONENTS_PATH") . "template_lite/class.template.php");
        $this->templateLite = new Template_Lite();
        $this->templateLite->debugging = $this->debug;
        $this->templateName = Config::get("templateName");
    }

    public function render($controller)
    {
        $tpl = $this->templateLite;
        $templateName = $this->templateName;

        $tpl->template_dir = Config::get('TEMPLATES_PATH') . $templateName;

        if (!is_dir($tpl->template_dir)) {
            $templateName = Config::get("DEFAULT_TEMPLATE_NAME");
            $tpl->template_dir = Config::get('TEMPLATES_PATH') . $templateName;
        }

        $tpl->compile_dir = CODE_ROOT_DIR . "compiled/" . $controller->localDir . $templateName . "_template" . "/" . Config::get("language");

        if (!is_dir($tpl->compile_dir)) {
            $currentPath = CODE_ROOT_DIR . "compiled/";

            $dirs = explode("/", substr($tpl->compile_dir, strlen($currentPath)));

            foreach ($dirs as $dir) {
                $currentPath .= $dir . "/";
                if (!is_dir($currentPath)) {
                    $oldMask = umask(0);
                    mkdir($currentPath, 0777);
                    umask($oldMask);
                }
            }
        }

        $tpl->assign("setting", Config::getAll());
        $tpl->assign("display", Display::getAll());

        $tpl->assign("templateName", $templateName);
        $tpl->assign("controllerAction", $controller->action);
        $tpl->assign("controllerName", $controller->name);

        $tpl->assign(array_map_recursive("htmlspecialchars", $controller->viewVars));

        $tpl->assign("action", $controller->action);
        $tpl->assign("sessionLifeTime", ini_get('session.gc_maxlifetime'));

        if ($controller->viewFile) {
            $viewFile = NameTool::getTemplateFileName($controller->niceName . "/" . $controller->viewFile);
        } else {
            $viewFile = NameTool::getTemplateFileName($controller->niceName . "/" . $controller->action);
        }

        $tpl->encode_file_name = false;
        return $tpl->fetch($viewFile);
    }
}
