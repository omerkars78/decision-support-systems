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
                    <p>Sipariş İd leri ve Sipariş Adetleri</p>

                    <div class="box-2">
                    <div class="activity-card">

                        <div class="chart">
                            <canvas id="myChart"></canvas>
                        </div>
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
                        <script>
                            const data = {
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

                            const config = {
                                type: 'pie',
                                data: data,
                            };

                            
                            const ctx = document.getElementById('myChart');
                            const myChart = new Chart(ctx, config);
                        </script>
                            
                    </div>
                </div>


            </div>

            <div class="second_box">
            <div class="box-2">
                    <div class="activity-card">

                        <div class="chart">
                            <canvas id="myChart"></canvas>
                        </div>
                        <?php
                        $siparisler = [];
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
                        <script>
                            const data = {
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

                            const config = {
                                type: 'line',
                                data: data,
                            };


                            const ctx = document.getElementById('myChart');
                            const myChart = new Chart(ctx, config);
                        </script>

                    </div>
                </div>

            </div>

            <div class="thirth_box">

            </div>
        </div>

        <div class="genel_bilgi_container_2">
            <div class="fourth_box">

            </div>

            <div class="fifth_box">

            </div>
        </div>

    </div>


    </div>
</body>

</html>