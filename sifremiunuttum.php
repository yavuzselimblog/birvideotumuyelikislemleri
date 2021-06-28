<?php require_once 'sistem/baglan.php'; ?>

<form method="POST" id="sifremiunuttumformu" action="" onsubmit="return false;">

<input type="text" name="eposta" placeholder="e-posta"/>
<br>
<button type="submit" onclick="sifremigonder();">Şifremi sıfırla</button>
<a href="<?php echo $site;?>/giris.php">Giriş yap</a>
</form>

<script src="jquery.js"></script>
<script>
 function sifremigonder(){
     var deger = $("#sifremiunuttumformu").serialize();
     $.ajax({
        type : "POST",
        url  : "<?php echo $site;?>/sistem/sifremigonder.php",
        data : deger,
        success : function(sonuc){
            if($.trim(sonuc) == "bos"){
                alert("E-posta giriniz");
            }else if($.trim(sonuc) == "yok"){
                alert("Böyle bir e-posta sistemde yok");
            }else if($.trim(sonuc) == "ok"){
                alert("Şifre sıfırlama linkiniz e-posta adresinize gönderildi");
            }else if($.trim(sonuc) == "hata"){
                alert("Sistem hatası oluştu");
            }else if($.trim(sonuc) == "format"){
                alert("E-posta formatı hatalı");
            }
        }
     });
 }
</script>
