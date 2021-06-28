<?php 

require_once 'fonksiyon.php';

if($_POST){

    require_once 'class.phpmailer.php';
    require_once 'class.smtp.php';

    $kadi        = post('kadi');
    $eposta      = post('eposta');
    $sifre       = post('sifre');
    $sifretekrar = post('sifretekrar');

    $sifrele        = sha1(md5($sifre));
    $aktivasyonkodu = uniqid("yavuz_");
    $aktivasyonlinki = $site."/aktivasyon.php?kod=".$aktivasyonkodu;

    if(!$kadi || !$eposta || !$sifre || !$sifretekrar){
        echo "bos";
    }else{

        if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
            echo "format";
        }else{

            if($sifre != $sifretekrar){
                echo "uyusmadi";
            }else{

                $varmi = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e");
                $varmi->execute([':e' => $eposta]);
                if($varmi->rowCount()){
                    echo "var";
                }else{

                    $kayitol = $db->prepare("INSERT INTO uyeler SET
                        kadi   =:k,
                        eposta =:e,
                        sifre  =:s,
                        aktivasyonkodu=:a
                    ");

                    $kayitol->execute([
                        ':k' => $kadi,
                        ':e' => $eposta,
                        ':s' => $sifrele,
                        ':a' => $aktivasyonkodu
                    ]);

                    if($kayitol){

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
                        $mail->FromName = "Yavuz Selim - Üyelik aktivasyonu";
                        $mail->CharSet = "UTF-8";
                        $mail->Subject = "Üyelik Aktivasyonu";

                        $mailicerigi = "<p>Üyeliğinizi aktifleştirmek için aşağıda yer alan linke tıklayınız...</p>
                        <p>".$aktivasyonlinki."</p>";

                        $mail->MsgHTML($mailicerigi);
                        $mail->Send();

                        echo "ok";

                    }else{
                        echo "hata";
                    }

                }

            }

        }

    }


}




?>