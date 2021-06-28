<?php 

require_once 'fonksiyon.php';

if($_POST){

    require_once 'class.phpmailer.php';
    require_once 'class.smtp.php';

    $eposta = post('eposta');
    $sifirlamakodu = uniqid("yavuz_");
    $sifirlamalinki = $site."/sifremisifirla.php?kod=".$sifirlamakodu;
    if(!$eposta){
        echo "bos";
    }else{
        if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
            echo "format";
        }else{

            $giris = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e");
            $giris->execute([':e' => $eposta]);
            if($giris->rowCount()){

                $up = $db->prepare("UPDATE uyeler SET sifirlamakodu=:k WHERE eposta=:e");
                $up->execute([':k'=>$sifirlamakodu,':e'=>$eposta]);
                if($up){

                        $mail = new PHPMailer();
                        $mail->Host = "smtp.yandex.com";
                        $mail->Port = 587; //ssl ise => 465 tls ise = 587
                        $mail->SMTPSecure = "tls";
                        $mail->SMTPAuth   = true;
                        $mail->Username = "eposta";
                        $mail->Password = "sifre";
                        $mail->IsSMTP();
                        $mail->AddAddress($eposta);
                        $mail->From  = "gondereneposta";
                        $mail->FromName = "Yavuz Selim - Parolamı sıfırla";
                        $mail->CharSet = "UTF-8";
                        $mail->Subject = "Parola sıfırla";

                        $mailicerigi = "<p>Şifrenizi sıfırlamak için aşağıda yer alan linke tıklayınız...</p>
                        <p>".$sifirlamalinki."</p>";

                        $mail->MsgHTML($mailicerigi);
                        $mail->Send();

                        echo "ok";

                }else{
                    echo "hata";
                }

            }else{
                echo "yok";
            }

        }
    }

}

?>