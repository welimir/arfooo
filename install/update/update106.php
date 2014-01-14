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
    $sqls[] = "ALTER TABLE ".$dbConfig['DB_PREFIX']."categories ADD `title` VARCHAR(255) NOT NULL AFTER `name`";

    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key`, `value`) VALUES ('magpieRssCacheMaxAgeDays', '1')";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."bannedsites` (
                `banId` mediumint(8) NOT NULL auto_increment,
                `site` varchar(255) NOT NULL,
                `dateBanned` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
                PRIMARY KEY  (`banId`)
              ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.6?')">
</form>

</body>
</html>

<?php
}
?>