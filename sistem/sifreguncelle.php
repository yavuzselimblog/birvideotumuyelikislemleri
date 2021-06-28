<?php 
    require_once 'fonksiyon.php';

    if($_POST){

        require_once 'class.phpmailer.php';
        require_once 'class.smtp.php';

        $yenisifre = post('yenisifre');
        $kod = post('kod');
        $sifrele = sha1(md5($yenisifre));

        if(!$yenisifre || !$kod){
            echo "bos";
        }else{

            $varmi = $db->prepare("SELECT * FROM uyeler WHERE sifirlamakodu=:e");
            $varmi->execute([':e'=>$kod]);
            if($varmi->rowCount()){

                $row = $varmi->fetch(PDO::FETCH_OBJ);

                $up = $db->prepare("UPDATE uyeler SET sifre=:s,sifirlamakodu=:e WHERE sifirlamakodu=:si");
                $up->execute([':s'=>$sifrele,':e'=>'',':si'=>$kod]);

                if($up->rowCount()){

                    $mail = new PHPMailer();
                    $mail->Host = "smtp.yandex.com";
                    $mail->Port = 587; //ssl ise => 465 tls ise = 587
                    $mail->SMTPSecure = "tls";
                    $mail->SMTPAuth   = true;
                    $mail->Username = "eposta";
                    $mail->Password = "sifre";
                    $mail->IsSMTP();
                    $mail->AddAddress($row->eposta);
                    $mail->From  = "gonderen eposta";
                    $mail->FromName = "Yavuz Selim - Önemli Değişiklik";
                    $mail->CharSet = "UTF-8";
                    $mail->Subject = "Şifreniz değiştirildi";

                    $mailicerigi = "<p>Yakın zamanda şifreniz değiştirildi.. Bu işlemi siz yapmadıysanız lütfen yönetici ile iletişime geçiniz...</p>";

                    $mail->MsgHTML($mailicerigi);
                    $mail->Send();

                    echo "ok";


                }else{
                    print_r($up->errorInfo());
                    echo "hata";
                }

            }else{
                echo "yok";
            }

        }

    }
?>