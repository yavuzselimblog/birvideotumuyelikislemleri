<?php 
session_start();
ob_start();
$db = new PDO("mysql:host=localhost;dbname=tekvideoaltindasistem;charset=utf8;","root","");

$site = "http://localhost/tekvideotumuyelikislemleri";

?>