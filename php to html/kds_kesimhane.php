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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" ></script>
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

        .anasayfa_main_container .content_container .genel_bilgi_container_kesimhane {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
        }

        .anasayfa_main_container .content_container .genel_bilgi_container_kesimhane #kesimhane_first_box {
            display: flex;
            flex-direction: column;
            width: 850px;
            height: 450px;
            border-radius: 15px;
            margin-left: 200px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            padding: 20px;

        }

        .second_box_kesimhane {
            display: flex;
            flex-direction: column;
            margin-left: 50px;
        }
        .box-2{
            width: 800px;
            height: 500px;
            align-items: center;
        }
        .activity-card{
            width: 800px;
            height: 500px;
            align-items: center;
        }
        .box-1{
            width: 800px;
            height: 500px;
            align-items: center;
        }
        .chart #myChart {
            width: 800px;
            height: 500px;
            align-items: center;
        }
        .genel_bilgi_container_kesimhane_2 {
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: #f0f0f5;
        }
        p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            margin-top: 15px;
            font-weight: bold;
        }
        #kesimhane_bilgileri {
            margin-left: 320px;
        }
    </style>
    <title>Kesimhane</title>
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
                <a href="kds_kalite_kontrol.php">Kalite Kontrol</a>
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


            <div class="genel_bilgi_container_kesimhane">

                <div id="kesimhane_first_box">
                    <div class="siparis_bilgileri">
                        <p id="kesimhane_bilgileri">Kesimhane Bilgileri</p>
                    </div>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>
                            <th>Sipariş ID</th>
                            <th>İstenen Parça Adeti</th>
                            <th>Çıkan Parça Adeti</th>
                            <th>Kesim Farkı</th>
                            <th>Sipariş Tarihi</th>
                            <th>Kesim Tarihi</th>
                            <th>Kesim Süresi</th>
                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT siparis.siparis_id , siparis.istenen_parca , kesimhane.cikan_parca , (SELECT CASE 
                            WHEN ((kesimhane.cikan_parca)-(siparis.istenen_parca)) > 0 THEN 'Kesim Fazlası'
                            WHEN ((kesimhane.cikan_parca)-(siparis.istenen_parca)) = 0 THEN 'Fark Yok'
                            ELSE 'Kesim Açığı'
                            END) as kesim_farki , siparis.siparis_tarihi , kesimhane.kesim_tarihi , DATEDIFF(kesimhane.kesim_tarihi,siparis.siparis_tarihi) AS kesim_suresi
                           FROM kesimhane , siparis 
                           WHERE kesimhane.kesim_id = siparis.kesim_id;");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['siparis_id'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['istenen_parca'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['cikan_parca'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['kesim_farki'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['siparis_tarihi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['kesim_tarihi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['kesim_suresi'] ?></td>

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

                <div class="second_box_kesimhane">




                </div>

            </div>

            <div class="genel_bilgi_container_kesimhane_2">

                <p>Sipariş İd leri ve Kesim Farkları</p>
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
    </div>
</body>

</html>