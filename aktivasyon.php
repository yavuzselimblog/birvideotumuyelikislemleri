<?php 

require_once 'sistem/fonksiyon.php';

$kod = get('kod');
if($kod){

    $bul = $db->prepare("SELECT * FROM uyeler WHERE aktivasyonkodu=:a");
    $bul->execute([':a' => $kod]);
    if($bul->rowCount()){

        $up = $db->prepare("UPDATE uyeler SET durum=:d,aktivasyonkodu=:aa WHERE aktivasyonkodu=:a");
        $up->execute([':d' => 1,':aa'=>'',':a'=>$kod]);
        if($up){
            echo "Üyeliğiniz aktifleştirildi";
            header('refresh:2;url=giris.php');
        }else{
            echo "Hata oluştu";
        }

    }else{
        header('Location:index.php');
    }

}else{
    header('Location:index.php');
}

?>