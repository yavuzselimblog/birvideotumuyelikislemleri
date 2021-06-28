<?php require_once 'sistem/baglan.php'; ?>

<form method="POST" id="kayitformu" action="" onsubmit="return false;">

<input type="text" name="kadi" placeholder="Kullanıcı adı"/>
<br>
<input type="text" name="eposta" placeholder="E-posta"/>
<br>
<input type="password" name="sifre" placeholder="Şifre"/>
<br>
<input type="password" name="sifretekrar" placeholder="Tekrar şifre"/>
<br>
<button type="submit" onclick="kayitol();">Kayıt ol</button>
<a href="<?php echo $site;?>/giris.php">Giriş yap</a>
</form>



<script src="jquery.js"></script>
<script>
function kayitol(){
    
    var deger = $("#kayitformu").serialize();

    $.ajax({
        type : "POST",
        url  : "<?php echo $site;?>/sistem/kayit.php",
        data : deger,
        success : function(sonuc){

            if($.trim(sonuc) == "bos"){
                alert("Boş alan bırakmayınız");
            }else if($.trim(sonuc) == "format"){
                alert("E-posta formatı hatalı");
            }else if($.trim(sonuc) == "uyusmadi"){
                alert("Şifreler uyuşmuyor");
            }else if($.trim(sonuc) == "var"){
                alert("E-posta sistemde kayıtlıdır");
            }else if($.trim(sonuc) == "hata"){
                alert("Sistem hatası oluştu");
            }else if($.trim(sonuc) == "ok"){
                alert("Kaydınız başarı ile gerçekleşti lütfen mail adresinize gelen linke tıklayarak üyeliğinizi aktifleştirin....");
            }

        }
    });

}
</script>