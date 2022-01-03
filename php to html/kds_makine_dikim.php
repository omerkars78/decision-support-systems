<?php
error_reporting(0);
?>
<?php

include("../php/baglanti.php");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="googlebot" content="noarchive" />
    <meta name="Revisit-After" content="1 days" />
    <meta name="robots" content="index,contact" />
    <meta name="copyright" content="Tek-Stil - 2021">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        table {
            border: 1px solid black;
            width: 500px;
            height: 350px;
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

        .genel_bilgi_container_makina_1 {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            background-color: #f0f0f5;

        }

        p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            padding-left: 12px;
            padding-top: 12px;
        }

        .bir {
            display: flex;
            flex-direction: row;
            width: 655px;
            height: 100%;
            background-color: #f0f0f5;
            align-items: center;
        }

        .genel_bilgi_container_makina_2 {
            display: flex;
            flex-direction: row;
            width: 1510px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
            padding: 50px;
        }

        .third_box_side {
            display: flex;
            flex-direction: row;
            width: 1510px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
            padding: 50px;
        }

        .third_box {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 550px;
            height: 350px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

        }

        .first_box_makina {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 550px;
            height: 350px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            overflow-y: scroll;

        }

        .second_box_makina {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 550px;
            height: 350px;
            margin-left: 10px;
            border-radius: 15px;

            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            /* overflow-y: scroll; */

        }


        #thirth_box_makina {
            display: flex;
            flex-direction: column;
            width: 550px;
            height: 350px;
            border-radius: 15px;
            margin-left: 120px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            margin-left: 200px;

        }

        .makina_bilgileri {
            display: flex;
            align-items: center;
            flex-direction: row;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        #makina_igne_bilgileri {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 800;
        }

        #ariza {
            display: flex;
            width: 500px;
            height: 500px;

        }

        .box-2 {
            width: 500px;
            height: 500px;
        }

        .activity-card {
            width: 500px;
            height: 500px;
        }

        .box-1 {
            width: 500px;
            height: 500px;
        }

        .chart #myChart {
            width: 500px;
            height: 500px;
        }

        .chart #myChart_1 {
            width: 500px;
            height: 500px;
        }

        .ariza_turu_title {
            margin-left: 130px;
        }

        .hesaplama {
            display: flex;
            flex-direction: column;
            margin-left: 25px;
            width: 450px;
            height: 450px;
            text-align: center;
            align-items: center;

        }

        #y1 {
            width: 290px;
            padding: 5px;
            box-shadow: 1px 1px 5px rgba(255, 255, 255, 0.2);
            text-align: center;
            height: 20px;
            margin-bottom: 20px;
            margin-top: 50px;
        }

        #hesapla_buton {
            width: 305px;
            height: 40px;
        }

        #sonuc_yaz {
            background-color: #ffffff;
            margin: auto;
            padding: 25px;
            height: 50px;
            width: 250px;
            box-shadow: 1px 1px 7px #000000;
            border-radius: 12px;
        }

        #hesaplam_makina {
            margin-top: 50px;
        }

        .hesaplama_box {
            display: flex;
            flex-direction: column;
            width: 500px;
            height: 550px;
            border-radius: 15px;
            margin-left: 120px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

        }
    </style>
    <script>
        window.onload = function(e) {

            var y1 = document.getElementById("y1");
            var sonuc = document.getElementById("sonuc");
            var hesapla = document.getElementById("hesapla_buton");
            var sonucYaz = document.getElementById("sonuc_yaz");


            /*hesapla butonuna tıkladığında*/
            hesapla_buton.onclick = function() {

                var s = (180 / Number(y1.value));
                // sonuc.value = s.toFixed(2);

                console.log(s);

                sonucYaz.textContent = "Ortalama Tamir Edilmesi Gereken Gün Sayısı: " + s;

            }
        }
    </script>

    <title>Makina Dikim</title>
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


            <div class="genel_bilgi_container_makina_1">



                <div class="bir">
                    <div class="first_box_makina" style="margin-left:30px;width:590px;">
                        <div class="makina_bilgileri">
                            <p id="makina_igne_bilgileri">Makina İğne Bilgileri</p>
                        </div>
                        <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                            <tr>
                                <th>Makina ID</th>
                                <th>Makina Türü</th>
                                <th>İğne Türü </th>
                                <th>İğne Boyutu</th>
                            </tr>

                            <?php
                            include("../php/baglanti.php");

                            if ($con) {
                                $query = mysqli_query($con, "SELECT makina.makina_id , makina.makina_turu ,igne.igne_turu , igne.igne_boyutu 
                            FROM makina,igne,makina_igne
                            WHERE makina.makina_id=makina_igne.makina_id AND igne.igne_id = makina_igne.igne_id;");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($rows = mysqli_fetch_array($query)) { ?>
                                        <tr bgcolor='#ffffff'>
                                            <td height="41" align="center"><?php echo $rows['makina_id'] ?></td>
                                            <td height="41" align="center"><?php echo $rows['makina_turu'] ?></td>
                                            <td height="41" align="center"><?php echo $rows['igne_turu'] ?></td>
                                            <td height="41" align="center"><?php echo $rows['igne_boyutu'] ?></td>


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
                </div>

                <div class="second_box_makina">

                    <div class="makina_bilgileri">
                        <p id="makina_igne_bilgileri">6 Aylık Makina Arıza Bilgileri</p>
                    </div>
                    <table id="ariza" bordercolor="black" border="1">
                        <tr>
                            <th>Makina ID</th>
                            <th>Makina Türü</th>
                            <th>Arıza Türü </th>
                            <th>Ortalama Arıza Süresi(dk)</th>
                            <th>Arıza Sıklığı</th>
                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT makina.makina_id , makina.makina_turu ,ariza.ariza_turu,round(AVG(ariza.ariza_suresi)) as ortalama_ariza_suresi , COUNT(ariza.ariza_turu) as ariza_sikligi
                            FROM makina , ariza 
                            WHERE makina.makina_id = ariza.makina_id 
                            GROUP BY ariza.ariza_turu;");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['makina_id'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['makina_turu'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['ariza_turu'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['ortalama_ariza_suresi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['ariza_sikligi'] ?></td>

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




            </div>
            <div class="third_box_side">
                <div class="third_box">

                    <div class="ariza_turu_title">
                        <p>Makinelerin 6 Aylık Arıza Sayıları</p>
                    </div>

                    <div class="activity-card">

                        <div class="chart">
                            <canvas id="myChart_1"></canvas>
                        </div>
                        <?php

                        include("../php/baglanti.php");
                        ?>
                        <?php
                        $arizalar = [];
                        $sql = "SELECT ariza.makina_id , COUNT(ariza.makina_id) as ariza_sayisi
                    FROM makina , ariza 
                    WHERE makina.makina_id = ariza.makina_id 
                    GROUP BY ariza.makina_id;";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $arizalar[$row["makina_id"]] += $row["ariza_sayisi"];
                            }
                        } else {
                            echo "0 results";
                        }
                        $con->close();


                        ?>

                    </div>


                </div>

            </div>




        </div>

        <div class="genel_bilgi_container_makina_2">
            <div id="thirth_box_makina">
                <div class="ariza_turu_title">
                    <p>Arıza Türleri Ve 6 Aylık Sayıları</p>
                </div>
                <div class="box-2">
                    <div class="activity-card">

                        <div class="chart">
                            <canvas id="myChart"></canvas>
                            <?php

                            include("../php/baglanti.php");
                            ?>
                        </div>
                        <?php
                        $arizalar = [];
                        $sql = "SELECT ariza.ariza_turu, COUNT(ariza.ariza_turu) as ariza_sikligi
                            FROM makina , ariza 
                            WHERE makina.makina_id = ariza.makina_id 
                            GROUP BY ariza.ariza_turu;";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $arizalar[$row["ariza_turu"]] += $row["ariza_sikligi"];
                            }
                        } else {
                            echo "0 results";
                        }
                        $con->close();


                        ?>

                    </div>


                </div>




            </div>
            <div class="hesaplama_box">
                <div class="hesaplama">
                    <p id="hesaplam_makina">Ortalama Tamir Günü Hesaplama</p>
                    <input type="text" id="y1" placeholder="6 Aydaki Arıza Sayısını Giriniz">
                    <input type="button" id="hesapla_buton" value="Ortalama Tamir Günü Hesapla">
                    <div id="sonuc_yaz"> </div>
                </div>




            </div>
        </div>
        <script>
            // Hataların Sıklık Grafiği
            const data = {
                labels: [
                    <?php
                    foreach ($arizalar as $key => $value) {
                        echo "'" . $key . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Arıza Sıklık Grafiği',
                    data: [
                        <?php
                        foreach ($arizalar as $key => $value) {
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

            // Makina Arıza Sayısı Chartı
            const data_1 = {
                labels: [
                    <?php
                    foreach ($arizalar as $key => $value) {
                        echo "'" . $key . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Arıza Sıklık Grafiği',
                    data: [
                        <?php
                        foreach ($arizalar as $key => $value) {
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

            const config_1 = {
                type: 'pie',
                data: data_1,
            };


            const ctx_1 = document.getElementById('myChart_1');
            const myChart_1 = new Chart(ctx_1, config_1);
        </script>
<?php

?>
</body>

</html>