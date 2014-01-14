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


class Admin_CampaignController extends AppController
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

    function filterAction()
    {
        $this->set("filters", $this->setting->getCampaignFilters());
    }

    function saveNewFilterAction()
    {
        $filters = $this->setting->getCampaignFilters();
        $newFilters = preg_split("#\r?\n#", $this->request->filters);
        foreach ($newFilters as $filter) {
            $filter = trim($filter);
            if (empty($filter)) {
                continue;
            }
            $filters[] = $filter;
        }

        $this->setting->saveCampaignFilters($filters);

        $this->redirect($this->moduleLink("filter"));
    }

    function deleteFilterAction()
    {
        $filters = $this->setting->getCampaignFilters(); 

        if (!empty($this->request->filters)) {
            foreach ($this->request->filters as $id) {
                unset($filters[$id]);
            }
        }
        $this->setting->saveCampaignFilters($filters);

        $this->redirect($this->moduleLink("filter"));
    }
}
