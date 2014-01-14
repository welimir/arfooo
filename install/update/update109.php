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
       
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."categories`
                ADD `forbidden` enum('0','1') NOT NULL default '0'";
                       
    $sqls[] = "ALTER TABLE `".$dbConfig['DB_PREFIX']."sites`
                ADD `ascreen` enum('0','1') NOT NULL default '0'";
                                      
    $sqls[] = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
               VALUES
                ('allCategoriesPageEnabled', '1'),
                ('contactPageEnabled', '1'),
                ('ascreenEnabled', '0')";

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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.9?')">
</form>

</body>
</html>

<?php
}
?>