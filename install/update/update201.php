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
    
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."categories`
               ADD INDEX `urlName` (`urlName`)";

    $sqls[] = "CREATE TABLE `".$dbConfig['DB_PREFIX']."rewrites` (
                `originalUrl` varchar(128) NOT NULL,
                `rewrittedUrl` varchar(128) NOT NULL,
                PRIMARY KEY (`originalUrl`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('advancedUrlRewritingParentsEnabled', '1'),
                ('errorHandlerSaveToFileEnabled', '1'),
                ('errorHandlerDisplayErrorEnabled', '1'),
                ('newsEnabled', '1'),
                ('sitesInParentCategoriesEnabled', '0')";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v2.0.1?')">
</form>

</body>
</html>

<?php
}
?>