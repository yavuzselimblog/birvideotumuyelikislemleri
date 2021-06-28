<?php 

require_once 'sistem/baglan.php';

if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}

echo "Hoşgeldiniz | ".$_SESSION["kadi"];
echo "<br><a href='".$site."/cikis.php'>Çıkış yap</a>";

?>