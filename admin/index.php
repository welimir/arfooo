<?php
$dir = dirname($_SERVER['SCRIPT_NAME']);
$url = $dir."/../index.php/".basename($dir)."/";
header("Location: $url");
?>