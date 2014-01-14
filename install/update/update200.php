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

require_once("../../config/db.php");

if(!empty($_POST['update']))
{

    if(!mysql_connect($dbConfig['DB_HOST'],
                      $dbConfig['DB_USER'],
                      $dbConfig['DB_PASS']))
                      {
                          die(mysql_error());
                      }

    if(!mysql_selectdb($dbConfig['DB_NAME']))
    {
        die(mysql_error());
    }

    $sqls = array();
    
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."ads`
               DROP INDEX `AdCriterionID`,
               DROP INDEX `Page`,
               ADD INDEX `adCriterionId` (`adCriterionId`),
               ADD INDEX `page` (`page`,`place`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."cachegoogledetails`
               DROP INDEX `URL`,
               ADD INDEX `url` (`url`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."captchacodes`
               DROP INDEX `GenerationDate`,
               ADD INDEX `generationDate` (`generationDate`)";
    
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."categories`
               DROP INDEX `Name`,
               ADD `urlName` varchar(128) NOT NULL,
               ADD `navigationName` varchar(128) NOT NULL,
               ADD `headerDescription` varchar(255) NOT NULL,
               ADD `metaDescription` text NOT NULL,
               ADD `position` smallint(5) unsigned NOT NULL,
               ADD `searchEngineSettings` text,
               ADD INDEX `name` (`name`),
               ADD INDEX `parentCategoryId` (`parentCategoryId`,`position`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."categoryparents`
               DROP INDEX `ParentID`,
               DROP INDEX `CategoryID`,
               DROP INDEX `Depth`,
               CHANGE `categoryId` `childId` mediumint(8) unsigned NOT NULL,
               ADD INDEX `childId` (`childId`,`depth`),
               ADD INDEX `parentId` (`parentId`,`depth`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."comments`
               DROP INDEX `SiteID`,
               ADD `rating` tinyint(3) unsigned default NULL,
               ADD INDEX `siteId` (`siteId`,`remoteIp`)";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."extrafieldcategories` (
              `categoryId` mediumint(8) unsigned NOT NULL,
              `fieldId` mediumint(8) unsigned NOT NULL,
              KEY `categoryId` (`categoryId`),
              KEY `fieldId` (`fieldId`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."extrafieldoptions` (
              `fieldId` mediumint(8) unsigned NOT NULL,
              `value` smallint(5) unsigned NOT NULL,
              `label` varchar(128) NOT NULL,
              `position` tinyint(3) unsigned NOT NULL default '0',
              PRIMARY KEY  (`fieldId`,`value`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."extrafields` (
              `fieldId` mediumint(8) unsigned NOT NULL auto_increment,
              `name` varchar(128) NOT NULL,
              `type` enum('text','textarea','select','radio','checkbox','range') NOT NULL,
              `required` enum('0','1') NOT NULL,
              `description` text,
              `inSearchEngine` enum('0','1') NOT NULL default '0',
              `position` tinyint(3) unsigned NOT NULL default '0',
              `suffix` varchar(128) default NULL,
              PRIMARY KEY  (`fieldId`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."extrafieldvalues` (
              `itemId` mediumint(8) unsigned NOT NULL,
              `fieldId` mediumint(8) unsigned NOT NULL,
              `value` smallint(5) unsigned default NULL,
              `text` text,
              KEY `itemId` (`itemId`,`fieldId`),
              KEY `value` (`value`),
              FULLTEXT KEY `text` (`text`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."hits`
               DROP INDEX `SiteID`,
               ADD INDEX `siteId` (`siteId`,`remoteIp`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."keywords`
               DROP INDEX `Keyword`,
               ADD INDEX `keyword` (`keyword`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."keywordsofsites`
               DROP INDEX `SiteID`,
               DROP INDEX `KeywordID`,
               ADD INDEX `siteId` (`siteId`),
               ADD INDEX `keywordId` (`keywordId`)";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."photos` (
              `photoId` int(10) unsigned NOT NULL auto_increment,
              `itemId` mediumint(8) unsigned NOT NULL,
              `src` varchar(32) NOT NULL,
              `addDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
              `tempId` varchar(32) default NULL,
              PRIMARY KEY  (`photoId`),
              KEY `tempId` (`tempId`),
              KEY `itemId` (`itemId`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."siteproblems` (
              `problemId` mediumint(8) unsigned NOT NULL auto_increment,
              `siteId` mediumint(8) unsigned NOT NULL,
              `type` enum('spam','badCategory','other') NOT NULL,
              `description` text NOT NULL,
              PRIMARY KEY  (`problemId`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."sites`
                DROP INDEX `WebmasterID`,
                DROP INDEX `CategoryID`,
                DROP INDEX `Status`,
                DROP INDEX `URL`,
                DROP INDEX `SiteTitle`,
                DROP INDEX `Description`,
                ADD `reversePriority` tinyint(4) NOT NULL default '0',
                ADD `searchPartnership` enum('0','1') NOT NULL default '0',
                ADD `ip` varchar(15) default NULL,
                ADD `firstGalleryImageSrc` varchar(100) default NULL,
                ADD `photosCount` tinyint(3) unsigned NOT NULL default '0',
                ADD `haveExtraFields` enum('0','1') NOT NULL default '0',
                ADD `haveKeywords` enum('0','1') NOT NULL default '0',
                ADD `pageRank` tinyint(3) unsigned NOT NULL default '0',
                ADD INDEX `votesAverage` (`votesAverage`,`votesCount`),
                ADD INDEX `pageRank` (`pageRank`),
                ADD INDEX `referrerTimes` (`referrerTimes`),
                ADD INDEX `webmasterId` (`webmasterId`),
                ADD INDEX `url` (`url`),
                ADD INDEX `categoryId` (`categoryId`,`status`,`reversePriority`,`creationDate`),
                ADD INDEX `status` (`status`,`creationDate`),
                ADD FULLTEXT `description` (`description`),
                ADD FULLTEXT `siteTitle` (`siteTitle`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."users`
                DROP INDEX `Email`,
                DROP INDEX `Role`,
                DROP INDEX `Username`,
                ADD UNIQUE `email` (`email`),
                ADD INDEX `role` (`role`),
                ADD INDEX `login` (`login`)";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."votes`
                DROP INDEX `RemoteIP`,
                DROP INDEX `SiteID`,
                DROP INDEX `Date`,
                ADD INDEX `remoteIp` (`remoteIp`),
                ADD INDEX `siteId` (`siteId`,`value`),
                ADD INDEX `date` (`date`)";

    $sqls[] = "INSERT INTO `".$dbConfig['DB_PREFIX']."custommessages` (`messageId`, `title`, `description`, `userText`, `userDefined`, `type`) VALUES
                ('banSite', 'Your site is banned ', 'Your site [site name] is banned in our directory.<br /><br />\r\n\r\nThank you for subbmited your site in our directory <a href=\"[url of your directory]\">[name of directory]</a>', 'For mail received by the webmaster if the site is banned', '0', 'email'),
                ('newComment', 'New commment was posted in your directory', 'New commment was posted in your directory.<br /><br />\r\n\r\n<a href=\"[url of your directory]\">[url of your directory]</a>', 'Emails recived when new comment was posted', '0', 'email'),
                ('newSiteProblem', 'New site problem was posted in your directory', 'New site problem was posted in your directory.<br /><br />\r\n\r\n<a href=\"[url of your directory]\">[url of your directory]</a>', 'Emails recived when new site problem was posted', '0', 'email'),
                ('webmasterContact', 'Webmaster contact', 'A user want contact you<br /><br />\r\n\r\nHis message : [message]<br /><br />\r\n\r\nHis email <b>[sender email]<b/><br /><br />\r\nThank you, <a href=\"[url of your directory]\">[name of directory]</a>\r\n\r\n', 'Webmaster contact', '0', 'email')";
 
    $sqls[] = "DELETE FROM ".$dbConfig['DB_PREFIX']."settings WHERE `key` = 'commentsDisplayMethod'";
    
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('firstGalleryImageForThumbEnabled', '1'),
                ('informWebmastersForAdminValidateDecision', '1'),
                ('informWebmastersForAdminRefuseDecision', '1'),
                ('informWebmastersForAdminBanDecision', '1'),
                ('sendEmailsOnComment', '1'),
                ('sendEmailsOnSiteProblem', '1'),
                ('advancedSearchEnabled', '1'),
                ('searchEngineLikeMethodEnabled', '1'),
                ('searchEngineWordDefaultOperator', 'AND'),
                ('urlMandatory', '0'),
                ('itemGalleryImagesMaxCount', '10'),
                ('itemGalleryImageMaxWeight', '1000'),
                ('mediumThumbWidth', '220'),
                ('mediumThumbHeight', '165'),
                ('smallThumbWidth', '120'),
                ('smallThumbHeight', '90'),
                ('microThumbWidth', '60'),
                ('microThumbHeight', '45'),
                ('imageWatermarkEnabled', '0'),
                ('searchEngineSearchIn', 'siteTitle|description|url'),
                ('supportedUrlSchemes', 'http'),
                ('searchEngineLikeMethodWordMinLength', '2'),
                ('searchEngineLikeMethodWordMaxLength', '3'),
                ('partnershipSearchingEnabled', '1'),
                ('itemGalleryImagesEnabled', '0'),
                ('advancedUrlRewritingEnabled', '0'),
                ('httpGzipCompressionEnabled', '0'),
                ('maxSubpagesCountPerSite', '1'),
                ('templateCompileCheckEnabled', '1'),
                ('templateWhiteSpaceFilterEnabled', '1'),
                ('referrersSavingEnabled', '1'),
                ('siteDetailsCacheEnabled', '0'),
                ('watermarkImageSrc', ''),
                ('imageWatermarkPosition', 'b,l'),
                ('siteDetailsCacheLifeTime', '3600')";
                
    $sqls[] = "UPDATE " . $dbConfig['DB_PREFIX'] . "sites s
               SET haveKeywords=IF(EXISTS(SELECT * FROM " . $dbConfig['DB_PREFIX'] . "keywordsofsites kof
                                          WHERE kof.siteId = s.siteId),
                                   '1', '0'),
                   reversePriority = -priority";

    foreach($sqls as $sql)
    {
        $res = mysql_query($sql);

        if(!$res)
        {
            echo mysql_error();
            exit;
        }
    }

    echo 'Updated successfully';
}
else
{

?>

<html>
<head>
</head>
<body>
<form action="" method="post">
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v2.0?')">
</form>

</body>
</html>

<?php
}
?>