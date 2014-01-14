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


class SiteValidatorModel extends SiteModel
{
    public function getIfHostIsBanned($hostname, $exceptSiteId = 0)
    {
        $hostname = addslashes($hostname);
        $c = new Criteria();
        $c->add("status", "banned");
        $c->add("siteId", $exceptSiteId);
        $c->add("LOCATE( '$hostname', `url` ) = 1 ");
        return $this->find($c) ? true : false;
    }

    public function getCountOfSiteSubpages($url)
    {
        $hostname = AppRouter::getHostNameFromUrl($url);
        $hostname = addslashes($hostname);
        $c = new Criteria();
        $c->add("LOCATE( '$hostname', `url` ) = 1 ");
        return $this->getCount($c);
    }

    public function getCountOfSiteCopiesInDifferentCategories($url)
    {
        $c = new Criteria();
        $c->add("url", $url);
        return $this->getCount($c);
    }

    public function whetherSiteIsRegisteredInCategory($url, $categoryId)
    {
        $hostname = addslashes(AppRouter::getHostNameFromUrl($url));

        $c = new Criteria();
        $c->add("categoryId", $categoryId);
        $c->add("LOCATE( '$hostname', `url` ) = 1 ");

        return ($this->getCount($c) > 0);
    }

    function validate($newSite, $oldSite = null, $validationOptions = array())
    {
        $categoryId = intval($newSite->categoryId);
        $url = !empty($newSite->url) ? $newSite->url : "";
        $isAdmin = (!empty($validationOptions['admin']));
        $package = (!empty($validationOptions['package'])) ? $validationOptions['package'] : null;

        // required fields validation
        if (empty($newSite->siteTitle) || !isset($newSite->description)) {
            return 'Please, fill in the fields title and Description.';
        }
        if (empty($categoryId)) {
            return 'Please, select a category from the dropdown list.';
        }
        if (Config::get("urlMandatory") && empty($url)) {
            return 'Please fill URL field';
        }

        if (!empty($url)) {
            // ensure that site is not registered in this category
            if ((!$oldSite || $oldSite->categoryId != $categoryId)
                && !$isAdmin && empty($validationOptions['forceCategoryDuplicate'])
                && $this->whetherSiteIsRegisteredInCategory($url, $categoryId)
            ) {
                return 'The site is already registered in this category.';
            }
            // check whether the URL is allowed to be offered
            if (!preg_match('#^' . Config::get("supportedUrlSchemes") . '://#', $url)) {
                return 'We do not support this url protocol';
            }
            if (!preg_match('#^' . Config::get("supportedUrlSchemes") . '://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$#i', $url)) {
                return 'Url is invalid';
            }
            if ($this->getIfHostIsBanned(AppRouter::getHostNameFromUrl($url), 0)) {
                return 'This site is not allowed to be offered.';
            }
            if ($this->bannedSite->isBanned($url)) {
                return 'This site is not allowed to be offered.';
            }
            if (!$oldSite && !$isAdmin) {
                if ((int) ($this->getCountOfSiteCopiesInDifferentCategories($url)) >= (int) (Config::get('maxCategoriesCountPerSite')))
                    return 'This site is not allowed to be offered more times.';

                if ((int) ($this->getCountOfSiteSubpages($url)) >= (int) (Config::get('maxSubpagesCountPerSite')))
                    return 'No more subpages of this site can be submitted.';
            }
            if (Config::get('inscriptionCheckHttpResponseCode') == 1) {
                $httpClient = new HttpClient();
                $httpCode = $httpClient->checkResponseCodeOfSite($url);

                if ($httpCode != 200) {
                    return 'This site\' HTTP response code is not 200. The site is not accepted.';
                }
            }
        }

        if (!$isAdmin) {
            $minSiteDescriptionLength = $package ? $package['siteDescriptionMinLength'] : Config::get("minSiteDescriptionLength");

            $rawDescription = strip_tags($newSite->description);
            if ($minSiteDescriptionLength && utf8_strlen($rawDescription) < $minSiteDescriptionLength && !$isAdmin) {
                return _t('Description of site must have minimum') . ' ' . $minSiteDescriptionLength . ' ' . _t('characters length.');
            }

            $siteDescriptionMaxLength = $package ? $package['siteDescriptionMaxLength'] : Config::get('siteDescriptionMaxLength');

            if ($siteDescriptionMaxLength && utf8_strlen($rawDescription) > $siteDescriptionMaxLength) {
                return _t('Description of site must have maximum') . ' ' . $siteDescriptionMaxLength . ' ' . _t('characters length.');
            }
        }

        if (Config::get('backLinkMandatory')
            && (!$package || $package['backLinkMandatory'])
            && empty($newSite->returnBond)
            && !$isAdmin
        ) {
            return 'Backlink is mandatory.';
        }

        if (Config::get('countryFlagsEnabled') && empty($newSite->countryCode) && !$isAdmin) {
            return 'Country is mandatory.';
        }

        $category = $this->category->findByPk($categoryId);

        if (!$category
            || (!$isAdmin
                && $category->possibleTender != 1
                && empty($validationOptions['forcePossibleTender'])
                )
        ) {
            return 'Sites cannot be offered for this category.';
        }

        if ($this->bannedEmail->isBanned($newSite->webmasterEmail) && !$isAdmin) {
            return 'This email is banned.';
        }

        if ($this->bannedIp->isBanned(Request::getInstance()->getIp())) {
            return 'Your IP is banned.';
        }

        if (Config::get('duplicateContentCheckerEnabled') && !$isAdmin) {
            $duplicateChecker = new GoogleDuplicateChecker();
            $duplicateChecker
                ->setPhrasesToCheckCount(
                    Config::get('duplicateContentCheckerPhrasesToCheckCount')
                )
                ->setWordsInPhraseCount(
                    Config::get('duplicateContentCheckerWordsInPhraseCount')
                )
                ->setAllowableDuplicatedPhrasesCount(
                    Config::get('duplicateContentCheckerAllowableDuplicatedPhrasesCount')
                );

            if ($duplicateChecker->isDuplicateContent($newSite->description)) {
                return 'We have detected duplicate content, change your description.';
            }
        }
        
        $errorMessage = $this->extraField->validate($newSite);
        if ($errorMessage) {
            return $errorMessage;
        }

        return '';
    }
}
