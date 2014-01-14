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

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."extrafields`
               CHANGE `type` `type` ENUM( 'text', 'textarea', 'select', 'radio', 'checkbox', 'range', 'url', 'file'),
               ADD `config` text";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."packages`
               ADD `siteDescriptionHtmlEnabled` enum('0','1') NOT NULL,
               ADD `siteDescriptionHtmlAllowedTags` text NOT NULL,
               ADD `siteDescriptionHtmlAllowedCssProperties` text NOT NULL,
               ADD `siteDescriptionMinLength` int(11) NOT NULL DEFAULT '0'";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."photos`
               ADD `altText` varchar(255) DEFAULT NULL";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."siteadditionalcategories` (
              `categoryId` mediumint(8) unsigned NOT NULL,
              `siteId` mediumint(8) unsigned NOT NULL,
              PRIMARY KEY (`categoryId`,`siteId`),
              KEY `siteId` (`siteId`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."sites`
               ADD `descriptionDisplayMethod` enum('text','html','htmlAdmin') NOT NULL DEFAULT 'text',
               ADD `isDuplicateContent` enum('0','1') NOT NULL DEFAULT '0'";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."tasks`
               CHANGE `data` `data` longtext NOT NULL";

    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('siteDescriptionHtmlEnabled', '0'),
                ('siteDescriptionHtmlAllowedTags', 'a[href|title|target], br, b, p, ul, ol, li, table[cellspacing|cellpadding|border], tbody, tr, td[colspan|rowspan], strong, span, em, *[style], *[class], img[src]'),
                ('siteDescriptionHtmlAllowedCssProperties', 'text-align, color, background-color, font-family, font-size, border, text-decoration, padding-left, height, width, font-weight'),
                ('campaignFilters', ''),
                ('siteDescriptionHtmlEnabledAdmin', '0'),
                ('siteDescriptionHtmlAllowedTagsAdmin', 'a[href|title|target], br, b, p, ul, ol, li, table[cellspacing|cellpadding|border], tbody, tr, td[colspan|rowspan], strong, span, em, *[style], *[class], img[src]'),
                ('siteDescriptionHtmlAllowedCssPropertiesAdmin', 'text-align, color, background-color, font-family, font-size, border, text-decoration, padding-left, height, width, font-weight'),
                ('duplicateContentCheckerEnabled', '0'),
                ('duplicateContentCheckerPhrasesToCheckCount', '3'),
                ('duplicateContentCheckerWordsInPhraseCount', '6'),
                ('duplicateContentCheckerAllowableDuplicatedPhrasesCount', '0')";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v2.0.2?')">
</form>

</body>
</html>

<?php
}
?>