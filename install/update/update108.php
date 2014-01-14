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

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."bannedtags` (
                `banId` mediumint(8) NOT NULL auto_increment,
                `tag` varchar(255) NOT NULL,
                `dateBanned` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
                PRIMARY KEY  (`banId`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
                
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."newsletteremails` (
                `emailId` mediumint(9) NOT NULL auto_increment,
                `email` varchar(128) NOT NULL,
                `active` enum('0','1') NOT NULL default '0',
                PRIMARY KEY  (`emailId`),
                KEY `email` (`email`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
                
    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."verifications` (
                `code` varchar(32) NOT NULL,
                `itemId` varchar(32) NOT NULL,
                `type` enum('newsletterEmailAdd','newsletterEmailDel','userEmail','siteEmail') NOT NULL,
                `data` text NOT NULL,
                `creationDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
                PRIMARY KEY  (`code`),
                KEY `itemId` (`itemId`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
       
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."keywords`
                ADD `description` text NOT NULL";
                
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."packages`
                ADD `backLinkMandatory` enum('0','1') NOT NULL default '0'";

    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."sites`
                ADD `newsletterActive` enum('0','1') NOT NULL default '0',
                ADD `emailConfirmed` enum('0','1') NOT NULL default '0',
                ADD `lng` float default NULL,
                ADD `lat` float default NULL";
                
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."tasks`
                CHANGE `status` `status` enum('init','active','pause','stop','finish','next') NOT NULL default 'active'";
                
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."users`
                ADD `active` enum('0','1') NOT NULL default '1'";
                         
    $sqls[] = "INSERT INTO `".$dbConfig['DB_PREFIX']."custommessages` (`messageId`, `title`, `description`, `userText`, `userDefined`, `type`) VALUES
                ('newsletterEmailAdd', 'Confirm your email', 'Confirm your email<br>\r\n<br>\r\n<a href=\"[confirm link]\">Confirm</a>\r\n', 'Email received by the user who add his email to newsletter', '0', 'email'),
                ('newsletterEmailDel', 'Confirm email delete ', 'Confirm email delete<br>\r\n<br>\r\n<a href=\"[confirm link]\">Confirm</a>', 'Email received by the user who delete his email from newsletter', '0', 'email'),
                ('siteEmail', 'Confirm your email', 'Confirm your email<br>\r\n<br>\r\n<a href=\"[confirm link]\">Confirm</a>', 'Email received by the user who submit site and confirm email is ON.', '0', 'email'),
                ('userEmail', 'Confirm your email', 'Confirm your email<br>\r\n<br>\r\n<a href=\"[confirm link]\">Confirm</a>', 'Email received by the user who register to confirm his email.', '0', 'email'),
                ('newsletterFooter', '', '<br><br>\r\n<a href=\"[unsubscribe link]\">\r\nClick here to unsubscribe me\r\n</a>', 'Newsletter footer', '0', 'email')";
                                        
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('commentsDisplayMethod', 'popup'),
                ('maxNewsCount', '20'),
                ('displayBannedSitesCount', '1'),
                ('newsletterEnabled', '0'),
                ('emailConfirmationEnabled', '0')";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.8?')">
</form>

</body>
</html>

<?php
}
?>