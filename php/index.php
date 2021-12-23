<!-- <?php
require("baglanti.php");
if($baglan){
    $sorgu = mysqli_query($baglan,"SELECT * FROM kullanici");
    /*
    //mysqli_fetch_row kullanımı:
    if(mysqli_num_rows($sorgu)>0){
        $row = mysqli_fetch_row($sorgu);
        echo $row[0];
    }else{
        echo "Sonuç Yok";
    }
    //fetch_array kullanımı:
    if(mysqli_num_rows($sorgu)>0){
        $row = $sorgu->fetch_array(MYSQLI_ASSOC);
        echo $row["ID"];
    }
    */
/* ----Örneklerden biri, nasıl yazdırılacağını gördük----
    if(mysqli_num_rows($sorgu)>0){
        while($row = mysqli_fetch_assoc($sorgu)){
            echo "ID: ".$row["ID"]."Adı: ".$row["adi"]."Soyadı: ".$row["soyadi"]."Hesap No: ".$row["hesap_no"]."</br>";
        }
    }    
*/
echo "<table>";
if(mysqli_num_rows($sorgu)>0){
    while($row = mysqli_fetch_assoc($sorgu)){
        echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["kullanici_adi"]."</td>";
            echo "<td>".$row["sifre"]."</td>";
        echo "</tr>";
    }
}
echo "</table>";

}else{
    echo die("Veritabanına bağlantı sağlanamadı");
}
    
?> -->