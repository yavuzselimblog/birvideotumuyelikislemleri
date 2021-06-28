<?php 
require_once 'baglan.php';

function post($par){
    return strip_tags(trim($_POST[$par]));
}

function get($par){
    return strip_tags(trim($_GET[$par]));
}

?>