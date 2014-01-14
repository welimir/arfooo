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
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES ('backLinkMandatory', '0'),
                      ('showRandomSitesInDetails', '1'),
                      ('randomSitesInDetailsCount', '5'),
                      ('randomSitesInDetailsDescriptionLength', '100'),
                      ('minSiteDescriptionLength', '30'),
                      ('rssSitesEnabled', '1'),
                      ('countryFlagsEnabled', '1'),
                      ('similarSiteKeywordMatch', '0')";
                      
    $sqls[] = "ALTER TABLE ".$dbConfig['DB_PREFIX']."custommessages
               ADD  `userText` text NOT NULL,
               ADD  `userDefined` enum('0','1') NOT NULL default '1',
               ADD  `type` enum('email','custom') NOT NULL default 'email'";
               
    $sqls[] = "TRUNCATE TABLE ".$dbConfig['DB_PREFIX']."custommessages";
    
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."custommessages (`messageId`, `title`, `description`, `userText`, `userDefined`, `type`) VALUES
                ('validateSite', 'Your site is accepted', 'Your site [site name] is accepted in the category [name of the category] \r\nYou can see your site at this address [url site details] \r\n\r\nThank you for your site listed in the directory [name of directory] [url of your directory]\r\n\r\n', 'When you validate a site', '0', 'email'),
                ('refuseSite', 'Your site is refused ', 'Your site [site name] is denied in the category [name of the category]. \r\nIt does not correspond to the criteria for listing in our directory [name of directory] [url of your directory]\r\n\r\nAfter modifying your site, do not hesitate to come to resubmit \r\nIn our directory [name of directory] [url of your directory]\r\n', 'For mail received by the webmaster if the site is refused', '0', 'email'),
                ('submitSite', 'A new website has just been submitted ', 'Information to the new site: \r\nName: [site name] \r\nURL: [url site] \r\nDescription: [description of the site] \r\nCategory: [name of the category]\r\n\r\n', 'Received by administrator the directory when a site is submitted', '0', 'email'),
                ('directoryDescription', 'Title description 1 for a better ranking in search engines if you want', 'description 1 for a better ranking in search engines if you want.', '', '0', 'custom'),
                ('directoryCondition', '', 'Regulation and condition of submission of websites. <br />\r\n<br />\r\n<br />\r\ndddd\r\n<br />\r\n<br />', '', '0', 'custom'),
                ('webmasterSubmitSite', 'Your site has been successfully submitted ', 'Information on your site: \r\nName: [site name] \r\nURL: [url site] \r\nDescription: [description of the site]\r\nYour site has been submitted in the category [name of the category] \r\n\r\nThank you for submitting your site in our directory [name of directory] [url of your directory]\r\n', 'Email received by the webmaster when he submitt a site', '0', 'email')";
              
    $sqls[] = "ALTER TABLE ".$dbConfig['DB_PREFIX']."sites
               ADD  `countryCode` char(2) default NULL";
              
    $sqls[] = "CREATE TABLE ".$dbConfig['DB_PREFIX']."visits (
              `ip` char(15) NOT NULL,
              `type` enum('ref','vis') NOT NULL,
              `id` int(11) NOT NULL,
              `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
              PRIMARY KEY  (`ip`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8";
        
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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.3?')">
</form>

</body>
</html>

<?php
}
?>