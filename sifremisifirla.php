<?php 

require_once 'sistem/fonksiyon.php';

$kod = get('kod');
if($kod){

    $bul = $db->prepare("SELECT * FROM uyeler WHERE sifirlamakodu=:a");
    $bul->execute([':a' => $kod]);
    if($bul->rowCount()){

        ?>

        <form method="POST" id="sifremiguncelleformu" action="" onsubmit="return false;">

        <input type="password" name="yenisifre" placeholder="Yeni şifreniz"/>
        <br>
        <input type="hidden" value="<?php echo $kod;?>" name="kod" />
        <button type="submit" onclick="yenisifremigonder();">Şifremi güncelle</button>
        </form>

        
<script src="jquery.js"></script>
        <script>

            function yenisifremigonder(){

                var deger = $("#sifremiguncelleformu").serialize();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo $site;?>/sistem/sifreguncelle.php",
                    data : deger,
                    success : function(sonuc){
                        if($.trim(sonuc) == "bos"){
                            alert("yeni şifrenizi giriniz");
                        }else if($.trim(sonuc) == "hata"){
                            alert("sistem hatası oluştu");
                        }else if($.trim(sonuc) == "ok"){
                            alert("şifreniz başarıyla güncellendi");
                        }else if($.trim(sonuc) == "yok"){
                            alert("bu sıfırlama kodu geçersizdir");
                        }
                    }
                });

            }

        </script>

        <?php 

    }else{
        header('Location:index.php');
    }

}else{
    header('Location:index.php');
}

?>
