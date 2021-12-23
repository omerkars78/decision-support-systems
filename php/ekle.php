<!-- <?php
// kullanıcıdan alacağımız verileri buradan baglanti.php tarafına ve oradan da database'ye yollayacağız.
require("baglanti.php");
if($baglan){
    if($_POST){
        if($_POST["kullanici_adi"]){
            $adi = $_POST["kullanici_adi"];
            echo $adi;
        }else{
            die("Kullanıcı Adı Yazdırılamadı!");
        }
        echo " ";
        if($_POST["sifre"]){
            $soyadi = $_POST["sifre"];
            echo $soyadi;
        }else{
            die("Şifre Yazdırılamadı!");
        }
        echo " ";
      
       
        $sorgu = mysqli_query($baglan, "INSERT INTO kullanici (kullanici_adi,sifre) VALUES('".$kullanici_adi."','".$sifre."')");

        if($sorgu === TRUE){
            echo "Kayıt Başarıyla Yapıldı. ☺️";
        }else{
            echo "Hata".$baglan -> error;
        }
    }
}else{
    die("Bağlantı Yapılamadı!");
}


?> -->