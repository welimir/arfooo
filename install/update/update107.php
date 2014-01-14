<?php

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

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."allopasscodes` (
                `code` char(8) NOT NULL,
                `ip` char(15) NOT NULL,
                `useDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
                KEY `code` (`code`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
                
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."packages` (
                `packageId` mediumint(9) unsigned NOT NULL auto_increment,
                `name` varchar(64) NOT NULL,
                `amount` float(10,2) NOT NULL,
                `allopassId` varchar(32) default NULL,
                `allopassNumber` tinyint(4) default NULL,
                `priority` tinyint(4) NOT NULL,
                `description` text NOT NULL,
                `imageSrc` varchar(64) default NULL,
                `siteDescriptionMaxLength` int(11) NOT NULL default '500',
                `maxKeywordsCountPerSite` tinyint(4) NOT NULL default '5',
                PRIMARY KEY  (`packageId`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
            
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."paymentprocessors` (
                `processorId` varchar(32) NOT NULL,
                `displayName` varchar(64) NOT NULL,
                `active` enum('0','1') NOT NULL,
                `currency` char(3) NOT NULL,
                `testMode` enum('0','1') NOT NULL,
                `email` varchar(64) default NULL,
                PRIMARY KEY  (`processorId`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
            
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."payments` (
                `paymentId` int(11) NOT NULL auto_increment,
                `processorId` varchar(64) NOT NULL,
                `packageId` mediumint(9) unsigned NOT NULL,
                `amount` float(10,2) NOT NULL,
                `description` text NOT NULL,
                `ip` char(15) NOT NULL,
                `userId` mediumint(9) unsigned default NULL,
                `createDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
                `status` enum('unpaid','pending','paid','denied') NOT NULL default 'unpaid',
                `used` enum('0','1') NOT NULL default '0',
                `currency` char(3) NOT NULL,
                `siteId` mediumint(8) unsigned default NULL,
                PRIMARY KEY  (`paymentId`),
                KEY `userId` (`userId`),
                KEY `createDate` (`createDate`),
                KEY `ip` (`ip`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
                
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."searchtags` (
                `tagId` int(11) NOT NULL auto_increment,
                `tag` varchar(128) NOT NULL,
                `searchTimes` int(11) NOT NULL default '1',
                `banned` enum('0','1') NOT NULL default '0',
                PRIMARY KEY  (`tagId`),
                KEY `tag` (`tag`),
                KEY `searchTimes` (`searchTimes`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
                
    $sqls[] = "ALTER TABLE ".$dbConfig['DB_PREFIX']."sites
                ADD `packageId` mediumint(9) unsigned default NULL,
                ADD `siteType` enum('basic','premium') NOT NULL default 'basic',
                ADD `paymentProcessorName` varchar(64) default NULL,
                ADD `paymentStatus` enum('pending','paid','denied') default NULL";
                      
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."visits`
                CHANGE `type` `type` enum('ref','vis','tag') NOT NULL";
                
    $sqls[] = "INSERT INTO `".$dbConfig['DB_PREFIX']."paymentprocessors` (`processorId`, `displayName`, `active`, `currency`, `testMode`, `email`) VALUES
                ('Allopass', 'Allopass', '0', 'EUR', '1', ''),
                ('PayPal', 'PayPal', '0', 'EUR', '1', '')";
                                      
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('availableSiteTypes', 'basic'),
                ('numberOfTagInTagCloud', '10'),
                ('minNumberOfTagInTagCloud', '2'),
                ('tagCloudEnabled', '0'),
                ('backLinkHtmlCode1Enabled', '1'),
                ('backLinkHtmlCode2Enabled', '1'),
                ('backLinkHtmlCode1Text', ''),
                ('backLinkHtmlCode1Url', ''),
                ('backLinkHtmlCode2Text', '')";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.7?')">
</form>

</body>
</html>

<?php
}
?>