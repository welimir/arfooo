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
    
    $sqls[] = "DROP TABLE IF EXISTS `".$dbConfig['DB_PREFIX']."visits` ";
    
        $sqls[] = "CREATE TABLE IF NOT EXISTS `".$dbConfig['DB_PREFIX']."visits` (
  `ip` char(15) NOT NULL,
  `type` enum('ref','vis') NOT NULL,
  `id` int(11) default NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
  KEY `ts` (`ts`),
  KEY `ip` (`ip`,`id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

   foreach($sqls as $sql)
   {
       mysql_query($sql);
   }


}
else
{

?>

<html>
<head>
</head>
<body>
<form action="" method="post">
<input type="submit" name="update" value="Fix visits table!" onclick="return confirm('Are you sure want to fix visits table')">
</form>

</body>
</html>

<?php
}
?>