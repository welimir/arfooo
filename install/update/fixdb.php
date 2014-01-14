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

    $tables = array("adcriterias" => array("name", "htmlContent"),
                    "categories" => array("name", "description"),
                    "comments" => array("pseudo", "text"),
                    "custommessages" => array("title", "description"),
                    "keywords" => array("keyword"),
                    "settings" => array("value"),
                    "sites" => array("siteTitle", "description", "proposalForKeywords", "proposalForCategory", "rssTitle"),
                    "users" => array("login"));
                    
    foreach($tables as $table => $fields)
    {
        $sql = "UPDATE ".$dbConfig['DB_PREFIX'].$table." SET ";
        
        $updateItems = array();
        
        foreach($fields as $field)
        {
            $updateItems[] = $field." = convert(BINARY convert(".$field." using latin1) using utf8)";
        }
        
        $sql .= implode(",\r\n", $updateItems);
        
        echo $sql."<br>"; 
        
        mysql_query($sql);
    }

    foreach(glob("../../cache/*") as $fileName)
    {
        if($fileName == ".htaccess")continue;
        unlink($fileName); 
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
<input type="submit" name="update" value="Convert db!" onclick="return confirm('Are you sure want to convert database?')">
</form>

</body>
</html>

<?php
}
?>