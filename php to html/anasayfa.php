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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/anasayfa.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Anasayfa</title>
    <script src="https://kit.fontawesome.com/6057c2ec97.js" crossorigin="anonymous"></script>
    <style>

    </style>
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

                <a href="kds_siparis.php"><i class="fas fa-shopping-cart"> </i> Sipariş</a>
            </button>
            <button class="kesimhane">
                <a href="kds_kesimhane.php"><i class="fas fa-cut"> </i> Kesimhane</a>
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

            <div class="gunluk_bilgi_kutusu">
                <div class="gunluk_bilgiler">

                    <div id="tarih">


                    </div>

                    <div id="saat">


                    </div>

                    <div id="kesimdeki_urun">


                    </div>

                    <div id="bekleyen_siparis">


                    </div>

                </div>
            </div>

            <div class="genel_bilgi_container">

                <div class="first_box">
                    <p style="margin-left: 50px; margin-top:10px; font-family: 'Times New Roman'; font-size: 20px;">Sipariş İd leri ve Sipariş Adetleri</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div style="margin-left: 25px; margin-top:25px;" class="chart">
                                <canvas id="myChart_1"></canvas>
                            </div>
                            <?php

                            include("../php/baglanti.php");
                            ?>
                            <?php

                            $siparisler = [];
                            $sql = "SELECT siparis.siparis_id, siparis.siparis_adeti
                  FROM siparis 
                  ;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $siparisler[$row["siparis_id"]] += $row["siparis_adeti"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>


                        </div>
                    </div>

                </div>

                <div class="second_box">
                    <p style="margin-left: 50px; margin-top:10px; font-family: 'Times New Roman'; font-size: 20px;">Sipariş İd leri ve Kesim Farkları</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div style="margin-left: 25px; margin-top:25px;" class="chart">
                                <canvas id="myChart_2"></canvas>
                            </div>
                            <?php

                            include("../php/baglanti.php");

                            ?>
                            <?php
                            $kesim_farki = [];
                            $sql = "SELECT siparis.siparis_id, ((kesimhane.cikan_parca)-(siparis.istenen_parca)) as kesim_farki
                           FROM siparis , kesimhane 
                           WHERE siparis.siparis_id = kesimhane.siparis_id;
                           ";


                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $kesim_farki[$row["siparis_id"]] += $row["kesim_farki"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>


                        </div>
                    </div>

                </div>

                <div class="thirth_box">
                    <p style="margin-left: 50px; margin-top:10px; font-family: 'Times New Roman'; font-size: 20px;">Arıza Türleri Ve 6 Aylık Sayıları</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div style="margin-left: 25px; margin-top:25px;" class="chart">
                                <canvas id="myChart_3"></canvas>
                            </div>
                            <?php

                            include("../php/baglanti.php");

                            ?>
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
            </div>

            <div class="genel_bilgi_container_2">
                <div class="fourth_box">
                    <p style="margin-left: 50px; margin-top:10px; font-family: 'Times New Roman'; font-size: 20px;">Sağlam Çıkan Ürün Listesi</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div style="margin-left: 25px; margin-top:25px;" class="chart">
                                <canvas id="myChart_4"></canvas>
                            </div>
                            <?php

                            include("../php/baglanti.php");
                            ?>
                            <?php

                            $kalite = [];
                            $sql = "SELECT siparis.siparis_id, siparis.siparis_adeti
                  FROM siparis 
                  ;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $kalite[$row["siparis_id"]] += $row["siparis_adeti"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>


                        </div>
                    </div>
                </div>

                <div class="fifth_box">
                    <p style="margin-left: 50px; margin-top:10px; font-family: 'Times New Roman'; font-size: 20px;">Operatörlerin 6 Aylık Toplam Operasyon Sayısı</p>
                    <div class="box-2">
                        <div class="activity-card">

                            <div style="margin-left: 25px; margin-top:25px;" class="chart">
                                <canvas id="myChart_5"></canvas>
                            </div>
                            <?php

                            include("../php/baglanti.php");
                            ?>
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


                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>
    <script>
        //birinci chart
        const data_1 = {
            labels: [
                <?php
                foreach ($siparisler as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [
                    <?php
                    foreach ($siparisler as $key => $value) {
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

        // Second Chart
        const data_2 = {
            labels: [
                <?php
                foreach ($kesim_farki as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Kesim Farkları',
                data: [
                    <?php
                    foreach ($kesim_farki as $key => $value) {
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

        const config_2 = {
            type: 'bar',
            data: data_2,
        };


        const ctx_2 = document.getElementById('myChart_2');
        const myChart_2 = new Chart(ctx_2, config_2);
        // THİRTH CHART
        const data_3 = {
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

        const config_3 = {
            type: 'pie',
            data: data_3,
        };


        const ctx_3 = document.getElementById('myChart_3');
        const myChart_3 = new Chart(ctx_3, config_3);
        // FOURTH BOX
        const data_4 = {
            labels: [
                <?php
                foreach ($kalite as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Kalite Kontrol Grafiği',
                data: [
                    <?php
                    foreach ($kalite as $key => $value) {
                        echo "'" . $value . "',";   // echo $value . ",";
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

        const config_4 = {
            type: 'line',
            data: data_4,
        };


        const ctx_4 = document.getElementById('myChart_4');
        const myChart = new Chart(ctx_4, config_4);
        // FİFTH BOX
        const data_5 = {
            labels: [
                <?php
                foreach ($performans as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Operatör ID',
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

        const config_5 = {
            type: 'bar',
            data: data_5,
        };


        const ctx_5 = document.getElementById('myChart_5');
        const myChart_5 = new Chart(ctx_5, config_5);
    </script>
</body>

</html>