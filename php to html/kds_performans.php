<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5c2368ed16.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <style>
        table {
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
        }

        tr {
            border: 1px solid black;
            background-color: #ffffff;
        }

        td {
            border: 1px solid black;
            background-color: #ffffff;
        }

        .chart #myChart {
            width: 800px;
            height: 500px;
            align-items: center;
        }

        .box-2 {
            width: 800px;
            height: 500px;
            align-items: center;
            margin-left: 250px;
            margin-top: 75px;
        }

        .anasayfa_main_container .content_container .genel_bilgi_container_performans_2 {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_performans_3 {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_performans {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
            padding-top: 100px;
        }

        .anasayfa_main_container .content_container .genel_bilgi_container_performans .performans_first_box {
            display: flex;
            flex-direction: column;
            width: 850px;
            height: 450px;
            border-radius: 15px;
            margin-left: 55px;
            margin-bottom: 75px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            overflow: scroll;
            padding: 20px;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_performans_2 .third_box {
            display: flex;
            flex-direction: column;
            width: 850px;
            height: 280px;
            border-radius: 15px;
            margin-left: 50px;
            margin-bottom: 15px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            overflow: none;
            padding: 20px;


        }

        .hesaplama {
            display: flex;
            flex-direction: column;
            margin-left: 25px;
            width: 150px;
            height: 450px;
            text-align: center;

        }

        .hesaplama_1 {
            display: flex;
            flex-direction: column;
            margin-left: 25px;
            margin-top: 50px;
            width: 150px;
            height: 450px;
            text-align: center;

        }

        #y1 {
            width: 290px;
            padding: 5px;
            box-shadow: 1px 1px 5px rgba(255, 255, 255, 0.2);
            text-align: center;
            height: 20px;
            margin-bottom: 20px;
        }
        #y3 {
            width: 290px;
            padding: 5px;
            box-shadow: 1px 1px 5px rgba(255, 255, 255, 0.2);
            text-align: center;
            height: 20px;
            margin-bottom: 20px;
        }

        #hesapla_buton {
            width: 305px;
            height: 40px;
        }
        #hesapla_buton_1 {
            width: 305px;
            height: 40px;
        }

        #sonuc_yaz,
        #sonuc_yaz2 {
            background-color: #ffffff;
            margin: auto;
            padding: 25px;
            height: 50px;
            width: 250px;
            box-shadow: 1px 1px 7px #000000;
            border-radius: 12px;
        }

        #sonuc_yaz_1 {
            background-color: #ffffff;
            margin: auto;
            padding: 25px;
            height: 50px;
            width: 250px;
            box-shadow: 1px 1px 7px #000000;
            border-radius: 12px;
        }

        p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            width: 305px;
            font-weight: bold;
        }

        #performans_title {
            font-size: 30px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            width: 1000px;
            margin-left: 275px;
            padding-top: 40px;
        }

        #title {
            font-size: 30px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            align-items: center;
            width: 450px;
            margin-left: 200px;
        }

        #title_1 {
            font-size: 30px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            align-items: center;
            width: 650px;
            margin-left: 200px;
        }
    </style>
    <script>
        window.onload = function(e) {

            var y1 = document.getElementById("y1");
            var y3 = document.getElementById("y3");
            var sonuc = document.getElementById("sonuc");
            var hesapla = document.getElementById("hesapla_buton");
            var sonucYaz = document.getElementById("sonuc_yaz");
            var sonuc_yaz_1 = document.getElementById("sonuc_yaz_1");
            var sonucYaz2 = document.getElementById("sonuc_yaz2");

            /*hesapla butonuna tıkladığında*/
            hesapla_buton.onclick = function() {

                var s = (Number(y1.value) * 12);
                console.log(s);
                /*sonuc.value = s.toFixed(2);*/
                var g = (Number(y1.value) * 108);
                console.log(g);

                var x = (Number(y3.value) * 120);
                console.log(x);

                sonucYaz.textContent = "1 Saatlik Operasyon Sayısı: " + s;
                sonucYaz2.textContent = "1 Günlük Operasyon Sayısı: " + g;
                sonuc_yaz_1.textContent = "6 Aylık Operasyon Sayısı: " + x;

            }
            hesapla_buton_1.onclick = function() {

               

                var x = (Number(y3.value) * 120);
                console.log(x);

               
                sonuc_yaz_1.textContent = "6 Aylık Operasyon Sayısı: " + x;

            }
        }
    </script>
    <title>Anasayfa</title>
</head>

<body>
    <div class="anasayfa_main_container">
        <div class="menu_bar_tutucu">

            <div class="logo">
                <img class="logo_foto" src="../img/avcitekstil.png">

            </div>

            <button class="anasayfa">
                <a href="anasayfa.php"><i class="fas fa-home"> </i> Anasayfa</a>
            </button>
            <button class="siparis">
                <a href="kds_siparis.php"><i class="fas fa-shopping-cart"></i>Sipariş</a>
            </button>
            <button class="kesimhane">
                <a href="kds_kesimhane.php"><i class="fas fa-cut"></i>Kesimhane</a>
            </button>
            <button class="makine_dikim">
                <a href="kds_makine_dikim.php"><i class="fas fa-tshirt"> </i> Makine Dikim</a>
            </button>
            <button class="kalite_kontrol">
                <a href="kds_kalite_kontrol.php"><i class="fas fa-thumbs-up"> </i> Kalite Kontrol</a>
            </button>
            <button class="performans">
                <a href="kds_performans.php"><i class="fas fa-chart-line"> </i> Performans</a>
            </button>
            <button class="oturum_kapat">
                <a href="signin_1.php"><i class="fas fa-sign-out-alt"></i> Oturum Kapat</a>
            </button>

        </div>
        <div class="content_container">

            <div class="ust_bar">

            </div>

            <div class="genel_bilgi_container_performans">

                <div class="performans_first_box">
                    <div class="siparis_bilgileri">
                        <p id="title">Operatörler Performans Bilgileri</p>
                    </div>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>
                            <th>Sipariş ID</th>
                            <th>Operatör Adı</th>
                            <th>5 Dakikalık Operasyon Sayısı</th>
                            <th>1 Saatlik Operasyon Sayısı</th>
                            <th>1 Günlük Operasyon Sayısı</th>
                            <th>Performans Tarihi</th>

                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT performans.siparis_id , operator.operator_adi , performans.bes_dk_op ,(performans.bes_dk_op*12)
                            AS bir_saatlik ,(performans.bes_dk_op*108) AS bir_gunluk , performans.tarih 
                            FROM performans , siparis , operator
                            WHERE operator.operator_id = performans.operator_id AND siparis.siparis_id = performans.siparis_id; ");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['siparis_id'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['operator_adi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['bes_dk_op'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['bir_saatlik'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['bir_gunluk'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['tarih'] ?></td>

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

                <div class="hesaplama">
                    <p>Manuel Performans Hesaplama</p>
                    <input type="text" id="y1" placeholder="5 Dakikalık Operasyon Giriniz">
                    <input type="button" id="hesapla_buton" value="Saatlik ve Günlük Hesapla">
                    <div id="sonuc_yaz"> </div>
                    <div id="sonuc_yaz2"></div>


                </div>

            </div>

            <div class="genel_bilgi_container_performans_2">

                <div class="third_box">
                    <p id="title_1">Genel Performans Değerlendirmesi</p>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>

                            <th>Operatör Adı</th>
                            <th>6 Aylık Toplam Operasyon Sayısı</th>
                            <th>Genel 6 Aylık Ortalama</th>
                            <th>Genel Performans Değerlendirmesi</th>


                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT operator.operator_adi , (SUM(bes_dk_op)*108) as alti_aylik_toplam , ((SELECT  (SUM(bes_dk_op)*108) as toplam 
                            FROM performans)/(SELECT COUNT(*) FROM (SELECT performans.operator_id  FROM operator,performans 
                                                                   WHERE performans.operator_id = operator.operator_id
                                                                   GROUP BY performans.operator_id)as yeni )) as ortalama_performans, (SELECT CASE 
                             WHEN (ortalama_performans - (SUM(bes_dk_op)*108)) < 0 THEN 'Yüksek Performans'
                             ELSE 'Düşük Performans'
                             END) as genel_degerlendirme
                            FROM operator , performans 
                            WHERE operator.operator_id = performans.operator_id
                            GROUP BY performans.operator_id; ");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['operator_adi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['alti_aylik_toplam'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['ortalama_performans'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['genel_degerlendirme'] ?></td>


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


                <div class="fourth_box">
                    <div class="hesaplama_1">
                        <p>Günlük Değere Göre 6 Aylık Toplam Performans </p>
                        <input type="number" id="y3" placeholder="Günlük Operasyon Giriniz">
                        <input type="button" id="hesapla_buton_1" value="6 Aylık Toplam Hesapla">
                        <div id="sonuc_yaz_1"> </div>



                    </div>
                </div>
            </div>

            <div class="genel_bilgi_container_performans_3">
                <div class="second_box_performans">
                    <p id="performans_title">Operatörlerin 6 Aylık Toplam Performans Değerlendirmesi</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div class="chart">
                                <canvas id="myChart"></canvas>
                            </div>
                            <?php
                            $performans = [];
                            $sql = "SELECT operator.operator_adi , (SUM(bes_dk_op)*108) as toplam FROM operator,performans 
                            WHERE operator.operator_id = performans.operator_id GROUP BY performans.operator_id
                                                ;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $performans[$row["operator_adi"]] += $row["toplam"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>
                            <script>
                                const data = {
                                    labels: [
                                        <?php
                                        foreach ($performans as $key => $value) {
                                            echo "'" . $key . "',";
                                        }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'Operatörlerin 6 Aylık Toplam Performans Değerlendirmesi',
                                        data: [
                                            <?php
                                            foreach ($performans as $key => $value) {
                                                echo $value . ",";
                                            }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 21)',
                                            'rgb(210, 0, 120)',
                                            'rgb(210, 98, 120)',
                                        ],
                                        hoverOffset: 4
                                    }]
                                };

                                const config = {
                                    type: 'bar',
                                    data: data,
                                };


                                const ctx = document.getElementById('myChart');
                                const myChart = new Chart(ctx, config);
                            </script>

                        </div>
                    </div>

                </div>

            </div>
        </div>
</body>

</html>