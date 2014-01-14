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
               VALUES ('googleMapKey', ''),
                      ('googleMapEnabled', '0'),
                      ('googleMapZoom', '3'),
                      ('remoteRssParsingEnabled', '1'),
                      ('companyInfoEnabled', '0'),
                      ('sitesSortyBy', 'creationDate'),
                      ('numberOfItemsForRssParsing', '5'),
                      ('numberOfCharactersForRssParsing', '150'),
                      ('numberOfCharactersForItemDescription', '200')";
                                                                           
    $sqls[] = "ALTER TABLE ".$dbConfig['DB_PREFIX']."sites
                      ADD `address` varchar(255) default NULL,
                      ADD `zipCode` varchar(255) default NULL,
                      ADD `city` varchar(255) default NULL,
                      ADD `country` varchar(255) default NULL,
                      ADD `phoneNumber` varchar(255) default NULL,
                      ADD `faxNumber` varchar(255) default NULL";
        
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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.5?')">
</form>

</body>
</html>

<?php
}
?>