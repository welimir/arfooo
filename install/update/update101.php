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

    $sql = "INSERT INTO ".$dbConfig['DB_PREFIX']."settings (`key` , `value` )
            VALUES ('automaticCommentValidation', '1')";
            
    mysql_query($sql);
	
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
<input type="submit" name="update" value="Update Now!" onclick="return confirm('Are you sure want to update to v1.0.1?')">
</form>

</body>
</html>

<?php
}
?>