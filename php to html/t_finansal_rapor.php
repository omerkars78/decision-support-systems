<!DOCTYPE html>
<html lang="tr">

<head>

    <title>Finansal Rapor</title>
    <meta charset="UTF-8">
    <meta name="description" content="KDS Yönetim Paneli" />
    <meta name="Keywords" content="Karar Destek Sistemleri, Yönetim, Panel">
    <meta name="googlebot" content="noarchive" />
    <meta name="Revisit-After" content="1 days" />
    <meta name="robots" content="index,contact" />
    <meta name="copyright" content="Tek-Stil - 2021">
    <!-- <link href="t_style_finansal.css" type="text/css" rel="stylesheet">     -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!--METANIN ALTINA SCRİPTİ CHART EKLEMEK İÇİN KOPYALADIK-->
    <link rel="stylesheet" type="text/css" href="CSS/finansal.css">
    <script>
        window.onload = function(e) {

            var y1 = document.getElementById("y1");
            var y2 = document.getElementById("y2");
            var y3 = document.getElementById("y3");
            var sonuc = document.getElementById("sonuc");
            var hesapla = document.getElementById("hesapla");
            var sonucYaz = document.getElementById("sonuc-yaz");

            /*hesapla butonuna tıkladığında*/
            hesapla.onclick = function() {

                var s = (Number(y1.value) * Number(y2.value) / Number(y3.value));
                sonuc.value = s.toFixed(2);


                sonucYaz.textContent = "Toplam Kazanç($):" + s + "$";




            }

            //  var chart2 = new CanvasJS.Chart("chartContainer2", {
            // 	animationEnabled: true,
            // 	title: {
            // 		text: "Ülke Bazında Alınan Sipariş Yüzdeleri(%)"
            // 	},
            // 	data: [{
            // 		type: "pie",
            // 		startAngle: 240,
            // 		yValueFormatString: "##0.00\"%\"",
            // 		indexLabel: "{label} {y}",
            // 		dataPoints: [
            // 			{y: 25, label: "Almanya"},
            // 			{y: 35, label: "Amerika"},
            // 			{y: 50, label: "Rusya"},
            // 			{y: 8, label: "Fransa"},
            // 			{y: 5, label: "Somali"}
            // 		]
            // 	}]
            // });
            // chart2.render();


        }
        //Java Script Kodları    
    </script>

</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header_genel">
                <div class="header_ic1">
                    <img class="logo" src="images/logo_tekstil_son.png" alt="logo">
                </div>
                <div class="header_ic2">
                    <form>
                        <div id="box">
                            <input type="text" id="search" placeholder="Merak Ettikleriniz...">
                            <i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>
                <div class="header_ic3">
                    <img class="mesaj" src="images/mesaj.png" alt="mesaj">
                    <img class="bildirim" src="images/bildirim.png" alt="bildirim">
                    <img class="ayarlar" src="images/ayarlar.png" alt="ayarlar">
                </div>
            </div>
        </div>
        <div class="headerin_alti">
            <?php include("sidebar.php"); ?>
            <div class="content">
                <div class="content_ustu">
                    <div class="content_ici">
                        <div class="content_üstündeki_yazi">
                            Finansal Raporlar
                        </div>
                    </div>
                </div>
                <div class="content_baslangic">
                    <div class="kutu_content">
                        <div class="kutu_content_icerik">

                            <div class="panel">
                                <input type="text" id="y1" placeholder="Birim Fiyat Giriniz">
                                <input type="text" id="y2" placeholder="Sipariş Adedini Giriniz">
                                <input type="text" id="y3" placeholder="Kur Değerini (TL cinsinden) Giriniz">
                                <input type="text" id="sonuc">
                                <input type="button" id="hesapla" value="DÖVİZ KUR HESAPLA">
                                <div id="sonuc-yaz">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kutu_content_icerik">
                        <!-- <div id="chartContainer2">
                            
                            

                        </div> -->
                        <table cellspacing="0" cellpadding="0" bordercolor="lightgray" border="1">
                            <tr>
                                <th height="40">TEDARİKÇİ FİRMA</th>
                                <th>HAM MADDE</th>
                                <th>DURUM</th>
                            </tr>

                            <?php
                            require_once("connection.php");

                            if ($conFaq) {
                                $query = mysqli_query($conFaq, "SELECT tedarikci.tedarikci_adi,ham_urun.ham_tur,IF( ham_urun.h_satis_fiyat - ham_urun.h_alis_fiyat > 0, 'KÂR', 'ZARAR') AS aciklama FROM ham_urun,tedarikci,ham_tedarik WHERE ham_urun.ham_id = ham_tedarik.ham_id AND tedarikci.tedrikci_id = ham_tedarik.tedarikci_id GROUP BY tedarikci.tedrikci_id ");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($rows = mysqli_fetch_array($query)) { ?>
                                        <tr bgcolor="#FFFFFF">
                                            <td height="41" align="center"><?php echo $rows['tedarikci_adi'] ?></td>
                                            <td height="41" align="center"><?php echo $rows['ham_tur'] ?></td>
                                            <td height="41" align="center"><?php echo $rows['aciklama'] ?></td>

                                        </tr>


                            <?php

                                    }
                                } else {
                                    echo "<h1>Veri Bulunamadı</h1>";
                                }
                            } else {
                                echo "<h1>Bağlantı Başarısız</h1>";
                            }
                            ?>
                        </table>
                    </div>
                    <div  id="piechart" class="kutu_content_icerik">

                   
                    </div>
                    <div class="content_baslangic">
                        <div class="kutu_content_icerik2">
                            <div class="siparis_tablo">
                                <table cellspacing="0" cellpadding="0" bordercolor="lightgray" border="1">
                                    <tr>
                                        <th height="43" width="200" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>FİRMA<b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>ÜLKE</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>KUR</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>KUR TARİH</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>VERGİ ORAN(%)</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>VERGİ TÜR</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>VERGİ TARİH</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>ENFLASYON ORAN(%)</b></font>
                                        </th>
                                        <th width="300" bgcolor="#EEEEEE" align="center">
                                            <font color="black"><b>ENFLASYON TARİH</b></font>
                                        </th>
                                    </tr>
                                    <?php
                                    require_once("connection.php");

                                    if ($conFaq) {
                                        $query = mysqli_query($conFaq, "SELECT firma.firma_adi,ulke.ulke_adi,kur.kur_deger,kur.kur_tarih,vergi.vergi_oran,vergi.vergi_tur,vergi.vergi_tarih,enflasyon.enf_oran,enflasyon.enf_tarih FROM firma,ulke,kur,vergi,enflasyon WHERE firma.firma_id = ulke.firma_id AND kur.kur_id = ulke.kur_id AND vergi.vergi_id = ulke.vergi_id AND enflasyon.enf_id = ulke.enf_id GROUP BY ulke.ulke_id ");
                                        if (mysqli_num_rows($query) > 0) {
                                            while ($rows = mysqli_fetch_array($query)) { ?>





                                                </tr>
                                                <tr bgcolor="#FFFFFF">
                                                    <td height="41" align="center"><?php echo $rows['firma_adi'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['ulke_adi'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['kur_deger'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['kur_tarih'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['vergi_oran'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['vergi_tur'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['vergi_tarih'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['enf_oran'] ?></td>
                                                    <td height="41" align="center"><?php echo $rows['enf_tarih'] ?></td>
                                                </tr>

                                    <?php

                                            }
                                        } else {
                                            echo "<h1>Veri Bulunamadı</h1>";
                                        }
                                    } else {
                                        echo "<h1>Bağlantı Başarısız</h1>";
                                    }
                                    ?>
                                </table>





                                </tr>


                                </table>

                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>


</body>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Ülkeler', 'Vergi Oranları'],
            <?php
            require_once("connection.php");
            if ($conFaq) {
                $sql = "SELECT ulke.ulke_adi,vergi.vergi_oran FROM ulke,vergi WHERE ulke.vergi_id = vergi.vergi_id GROUP BY ulke.ulke_id";
                $result = mysqli_query($conFaq, $sql);
                $rowResult = mysqli_fetch_array($result);

                $chart_data = "";
                while ($row = mysqli_fetch_array($result)) {

                    echo "['" . $row["ulke_adi"] . "'," . $row["vergi_oran"] . "],";
                }
            } else {
                echo "<h1>Bağlantı başarısız.</h1>";
            }
            ?>
        ]);




        var options = {
            title: 'Ülkelerin Vergi Oranları',
               is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

</html>



<?php
                                $sql = "SELECT siparis.siparis_id , tedarikci.tedarikci_adi , siparis.operasyon_bilgisi , siparis.siparis_adeti , siparis.siparis_tarihi 
                                FROM siparis , tedarikci 
                                WHERE siparis.siparis_id = tedarikci.tedarikci_id;";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {

                                        // echo "<tr>";
                                        // echo "<td>" . $row["makina_id"] .  "</td>";
                                        // echo "<td>" . $row["makina_turu"] . "</td>";
                                        // echo "</tr>";
                                  
                                echo "<tr>";
                                        echo "<td>" echo "<p>";  echo "Siparis ID:  " . $row["siparis_id"].  "</p>";  "</td>";
                                        
                                echo "</tr>";        
                                


                                  echo "<p>";  echo "Siparis ID:  " . $row["siparis_id"].  "</p>"; echo "<p>";" Tedarikci: ". $row["tedarikci_adi"].  "</p>";
                                  echo "<p>"; "Operasyon Bilgisi: ".$row["operasyon_bilgisi"]. "</p>"; echo "<p>";"Operasyon Bilgisi:".$row["operasyon_bilgisi"]. "</p>";
                                  echo "<p>";"Sipariş Adeti".$row["siparis_adeti"]. "</p>"; echo "<p>"; "Sipariş Tarihi".$row["siparis_tarihi"].
                                  "</p>"; " <br>";   
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $con->close();
                            ?> 