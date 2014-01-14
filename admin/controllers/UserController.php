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


class Admin_UserController extends AppController
{
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    function indexAction()
    {

    }

    function saveNewAdminPasswordAction()
    {
        if (!empty($this->request->newPassword)
            && $this->request->newPassword == $this->request->repeatedNewPassword
        ) {
            $c = new Criteria();
            $c->add("role", "administrator");
            $this->user->update(array("password" => md5($this->request->newPassword)), $c);
        }

        $this->redirect($this->moduleLink());
    }

    function administratorAction()
    {
        $admins = $this->user->getUsersWithRole("administrator");
        $this->set("admins", $admins);
    }

    function moderatorAction()
    {
        $moderators = $this->user->getUsersWithRole("moderator");
        $stats = $this->statistic->getModeratorsStats();

        foreach ($moderators as $moderator) {
            $moderator->validatedCount = isset($stats['validated'][$moderator->userId]['validatedSitesCount']) ? $stats['validated'][$moderator->userId]['validatedSitesCount'] : 0;
            $moderator->refusedCount = isset($stats['refused'][$moderator->userId]['refusedSitesCount']) ? $stats['refused'][$moderator->userId]['refusedSitesCount'] : 0;
            $moderator->bannedCount = isset($stats['banned'][$moderator->userId]['bannedSitesCount']) ? $stats['banned'][$moderator->userId]['bannedSitesCount'] : 0;
        }

        $this->set("moderators", $moderators);
    }

    function updateModeratorAction($moderatorId)
    {
        if (isset($this->request->delete)) {
            $this->deleteAction($moderatorId);
        } else {
            $this->user->updateByPk(array("email" => $this->request->email), $moderatorId);
            $this->redirect($this->moduleLink("moderator"));
        }
    }

    function saveAction()
    {
        $userId = $this->request->userId;

        if (isset($this->request->delete) && $userId != "1") {
            $this->deleteAction($userId);
        } else {
            $data = array("login" => $this->request->login,
                          "email" => $this->request->login);

            if (!empty($this->request->password)) {
                $data['password'] = md5($this->request->password);
            }

            $this->user->updateByPk($data,
                                    $userId);
            $this->redirect($this->moduleLink("administrator"));
        }
    }

    function deleteAction($userId)
    {
        $user = $this->user->findByPk($userId);
        $redirectUrl = $this->moduleLink($user->role);
        $user->del();
        $this->redirect($redirectUrl);
    }

    function saveNewUserAction()
    {
        if (!empty($this->request->login)
            && !empty($this->request->password)
            && !empty($this->request->role)
            && in_array($this->request->role, array("moderator", "administrator"))
        ) {
            $user = new UserRecord();
            $user->login = $this->request->login;
            $user->email = $user->login;
            $user->password = md5($this->request->password);
            $user->role = $this->request->role;
            $user->save();

            $refusal = new RefusalRecord();
            $refusal->moderatorId = $user->userId;
            $refusal->refusedSitesCount = 0;
            $refusal->save();
        }

        $this->redirect($this->moduleLink($this->request->role));
    }

    function webmasterAction($page = 1)
    {
        $c = new Criteria();
        $c->add("role", "webmaster");

        //set pagination
        $perPage = 50;
        $totalCount = $this->user->getCount($c);
        $totalPages = ceil($totalCount / $perPage);

        $this->set("pageNavigation", array("baseLink" => "/admin/user/webmaster/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));

        $c->setPagination($page, $perPage);

        $this->set("webmastersCount", $totalCount);

        $c->addLeftJoin("sites", "sites.webmasterId", "users.userId");
        $c->addGroup("userId");
        $c->addOrder("sitesCount DESC");

        if (!empty($this->request->searchedEmail)) {
            $c->add('users.email', '%' . $this->request->searchedEmail . '%', 'LIKE');
            $this->set('searchedEmail', $this->request->searchedEmail);
        }

        $webmasters = $this->user->findAll($c, "userId, email, COUNT(siteId) as sitesCount");
        $this->set("webmasters", $webmasters);
    }

    function banIpAction()
    {
        $this->set("bannedIps", $this->bannedIp->getArray(null, "remoteIP"));
    }

    function saveNewIpBanAction()
    {
        $bannedIps = preg_split("#\r?\n#", $this->request->bannedIps);

        foreach ($bannedIps as $ip) {
            $ip = trim($ip);
            if (empty($ip)) {
                continue;
            }

            $bannedIp = new BannedIpRecord();
            $bannedIp->remoteIp = $ip;
            $bannedIp->save();
        }

        $this->redirect($this->moduleLink("banIp"));
    }

    function deleteIpBanAction()
    {
        if (!empty($this->request->unbanIps)) {
            $c = new Criteria();
            $c->add("banId", $this->request->unbanIps, "IN");
            $this->bannedIp->del($c);
        }

        $this->redirect($this->moduleLink("banIp"));
    }

    function banEmailAction()
    {
        $this->set("bannedEmails", $this->bannedEmail->getArray(null, "email"));
    }

    function saveNewEmailBanAction()
    {
        $bannedEmails = preg_split("#\r?\n#", $this->request->bannedEmails);
        foreach ($bannedEmails as $email) {
            $email = trim($email);
            if (empty($email)) {
                continue;
            }

            $bannedEmail = new BannedEmailRecord();
            $bannedEmail->email = $email;
            $bannedEmail->save();
        }

        $this->redirect($this->moduleLink("banEmail"));
    }

    function deleteEmailBanAction()
    {
        if (!empty($this->request->unbanEmails)) {
            $c = new Criteria();
            $c->add("banId", $this->request->unbanEmails, "IN");
            $this->bannedEmail->del($c);
        }

        $this->redirect($this->moduleLink("banEmail"));
    }

    function newsletterAction()
    {
        $c = new Criteria();
        $c->add("role", "administrator");
        $c->setLimit(1);
        $admin = $this->user->find($c, "email");

        $this->set('adminEmail', $admin->email);

        $task = new NewsletterBackgroundTask();

        $this->set(
            'statistic',
            array (
                'subscribersEmailsCount' => count($task->getEmails('subscribers')),
                'allCount' => count($task->getEmails('all'))
            )
        );
    }

    function editWebmasterAction($webmasterId)
    {
        $c = new Criteria();
        $c->add("webmasterId", $webmasterId);
        $this->set("userSites", $this->site->findAll($c));
        $this->set("webmaster", $this->user->findByPk($webmasterId));
    }

    function deleteWebmasterAction($webmasterId)
    {
        $this->user->delByPk($webmasterId);
        $this->redirect($this->moduleLink("webmaster"));
    }

    function updateWebmasterAction($webmasterId)
    {
        if (isset($this->request->delete)) {
            $this->deleteWebmasterAction($webmasterId);
        } else {
            $this->user->changeUserEmail($webmasterId, $this->request->email);
            $this->redirect($this->moduleLink("webmaster"));
        }
    }

    function editModeratorAction($moderatorId)
    {
        $this->set("moderator", $this->user->findByPk($moderatorId));
    }

    function editAdministratorAction($userId)
    {
        $this->set("administrator", $this->user->findByPk($userId));
    }

    function newsletterEmailAction()
    {
        $c = new Criteria();
        $c->add("active", "1");
        $this->set("newsletterEmailsCount", $this->newsletterEmail->getCount($c));
    }

    function importNewsletterEmailAction()
    {
        $csvFile = new UploadedFile("csvFile");
        try {
            $csvFile->validate();

            $fileName = $csvFile->getTempName();
            $buff = file_get_contents($fileName);

            $this->newsletterEmail->del(new Criteria());

            foreach (preg_split("#[\r\n]+#", $buff) as $email) {
                $email = trim($email);
                if (empty($email)) {
                    continue;
                }

                $newsletterEmail = new NewsletterEmailRecord();
                $newsletterEmail->email = $email;
                $newsletterEmail->active = "1";
                $newsletterEmail->save();
            }

        } catch (Exception $e) {

        }

        $this->redirect($this->moduleLink("newsletterEmail"));
    }

    function exportNewsletterEmailAction()
    {
        $c = new Criteria();
        $c->add("active", "1");

        $emails = array();
        $newsletterEmails = $this->newsletterEmail->findAll($c, "email");

        foreach ($newsletterEmails as $newsletterEmail) {
            $emails[] = $newsletterEmail['email'];
        }

        $c = new Criteria();
        $c->add("newsletterActive", 1);

        $sites = $this->site->findAll($c, "DISTINCT webmasterEmail");

        foreach ($sites as $site) {
            if ($site['webmasterEmail']) {
                $emails[] = $site['webmasterEmail'];
            }
        }

        $emails = array_unique($emails);
        $content = implode("\r\n", $emails) . "\r\n";

        $this->autoRender = false;
        $fileName = "newsletter-emails-" . date("Y-m-d") . ".csv";
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-length: " . strlen($content));
        echo $content;
    }

}
