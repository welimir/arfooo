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


class SiteHtmlModel extends SiteModel
{
    public function configureSiteHtmlDisplay(&$site)
    {
        switch ($site->descriptionDisplayMethod) {
            case 'html':
                if ($site->packageId) {
                    $package = $this->package->findByPk($site->packageId);
                    if ($package && $package->siteDescriptionHtmlEnabled) {
                        $site->description = HtmlFilter::getFilteredHtml(
                            $site->description,
                            $package->siteDescriptionHtmlAllowedTags,
                            $package->siteDescriptionHtmlAllowedCssProperties
                        );
                        $site->htmlModeEnabled = true;
                        break;
                    }
                }

                if (Config::get('siteDescriptionHtmlEnabled')) {
                    $site->htmlModeEnabled = true;

                    $site->description = HtmlFilter::getFilteredHtml(
                        $site->description,
                        Config::get('siteDescriptionHtmlAllowedTags'),
                        Config::get('siteDescriptionHtmlAllowedCssProperties')
                    );
                } else {
                    $site->htmlModeEnabled = false;
                    $site->description = self::cleanupHtml($site->description); 
                }
                break;

            case 'htmlAdmin':
                if (Config::get('siteDescriptionHtmlEnabledAdmin')) {
                    $site->htmlModeEnabled = true;
                    $site->description = HtmlFilter::getFilteredHtml(
                        $site->description,
                        Config::get('siteDescriptionHtmlAllowedTagsAdmin'),
                        Config::get('siteDescriptionHtmlAllowedCssPropertiesAdmin')
                    );
                } else {
                    $site->htmlModeEnabled = false;
                    $site->description = self::cleanupHtml($site->description);
                }
                break;

            default:
                $site->htmlModeEnabled = false;
                $site->description = self::cleanupHtml($site->description);
        }
    }

    public static function cleanupHtml($html)
    {
        return strip_tags(str_replace('<br />', "\n", html_entity_decode($html, ENT_COMPAT, 'UTF-8')));
    }
}
