<?php
$url = substr($_SERVER['SCRIPT_NAME'], 0, -strlen(basename($_SERVER['SCRIPT_NAME'])))."../index.php/moderation";
header("Location: $url");
?>
