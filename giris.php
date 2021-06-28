<?php require_once 'sistem/baglan.php'; ?>

<form method="POST" id="girisformu" action="" onsubmit="return false;">


<input type="text" name="eposta" placeholder="E-posta"/>
<br>
<input type="password" name="sifre" placeholder="Şifre"/>
<br>
<button type="submit" onclick="girisyap();">Giriş Yap</button>
<a href="<?php echo $site;?>/sifremiunuttum.php">Şifremi unuttum</a>
</form>

<script src="jquery.js"></script>
<script>
    function girisyap(){
        var deger = $("#girisformu").serialize();
        $.ajax({
            type : "POST",
            url  : "<?php echo $site;?>/sistem/giris.php",
            data : deger,
            success : function(sonuc){
                if($.trim(sonuc) == "bos"){
                    alert("Boş alan bırakmayınız");
                }else if($.trim(sonuc) == "pasif"){
                    alert("Üyeliğiniz pasif durumdadır");
                }else if($.trim(sonuc) == "format"){
                    alert("E-posta formatı hatalı");
                }else if($.trim(sonuc) == "ok"){
                    alert("Giriş başarılı");
                    window.location.href = "<?php echo $site;?>/anasayfa.php";

                }else if($.trim(sonuc) == "hata"){
                    alert("E-posta veya şifre yanlış");
                }
            }
        });
    }
</script>