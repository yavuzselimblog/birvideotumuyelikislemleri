<?php 

    require_once 'fonksiyon.php';

    if($_POST){

        $eposta = post('eposta');
        $sifre  = post('sifre');
        $sifrele = sha1(md5($sifre));

        if(!$eposta || !$sifre){
            echo "bos";
        }else{
            if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
                echo "format";
            }else{

                $giris = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e AND sifre=:s");
                $giris->execute([':e' => $eposta,':s'=>$sifrele]);
                if($giris->rowCount()){

                    $row = $giris->fetch(PDO::FETCH_OBJ);
                    if($row->durum == 1){

                        $_SESSION['oturum'] = true;
                        $_SESSION['id'] = $row->id;
                        $_SESSION['kadi'] = $row->kadi;
                        $_SESSION['eposta'] = $row->eposta;

                        echo "ok";

                    }else{
                        echo "pasif";
                    }

                }else{
                    echo "hata";
                }

            }
        }


    }

?>