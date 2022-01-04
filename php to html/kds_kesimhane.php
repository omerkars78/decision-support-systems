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
    <script src="https://kit.fontawesome.com/6057c2ec97.js" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <style>
        #kesimhane_bilgileri {
            font-weight:800;

        }
        th{
            padding:10px;
            text-align:center;
            margin-bottom:5px;
        }
    .siparis_bilgileri {
        background-color: #ffffff;
        border-radius: 7px;
    }

    .siparis_bilgileri h3 {
        color: black;
        margin: 1rem;
    }

    .siparis_bilgileri table {
        width: 100%;
        border-collapse: collapse;
    }

    .siparis_bilgileri thead {
        background: #efefef;
        text-align: left;
    }

    td {
        padding: 0.2rem;
    }

    .box-2 {
        width: 800px;
        height: 500px;
        align-items: center;
    }

    .activity-card {
        width: 800px;
        height: 500px;
        align-items: center;
    }

    .box-1 {
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
        padding: 20px;
    }

    #kesimhane_bilgileri {
        display: flex;

        justify-content: center;
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
            <ul>
                <li class="anasayfa">

                    <a href="anasayfa.php"><i class="fas fa-home"> </i> Anasayfa</a>
                </li>
                <li class="siparis">

                    <a href="kds_siparis.php"><i class="fas fa-shopping-cart"> </i> Sipariş</a>
                </li>
                <li class="kesimhane">
                    <a href="kds_kesimhane.php"><i class="fas fa-cut"> </i> Kesimhane</a>
                </li>
                <li class="makine_dikim">

                    <a href="kds_makine_dikim.php"><i class="fas fa-tshirt"> </i> Makine Dikim</a>
                </li>
                <li class="kalite_kontrol">
                    <a href="kds_kalite_kontrol.php"><i class="fas fa-thumbs-up"> </i> Kalite Kontrol</a>
                </li>
                <li class="performans">
                    <a href="kds_performans.php"><i class="fas fa-chart-line"> </i> Performans</a>
                </li>
                <li class="oturum_kapat">
                    <a href="signin_1.php"><i class="fas fa-sign-out-alt"></i> Oturum Kapat</a>
                </li>
            </ul>
        </div>
        <div class="content_container">

            <div class="ust_bar">

            </div>


            <div class="genel_bilgi_container_kesimhane">

                <div class="kesimhane_first_box">
                    <div class="siparis_bilgileri">
                        <h3 id="kesimhane_bilgileri">Kesimhane Bilgileri</h3>

                        <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                            <thead>
                                <tr>
                                    <th>Sipariş ID</th>
                                    <th>İstenen Parça Adeti</th>
                                    <th>Çıkan Parça Adeti</th>
                                    <th>Kesim Farkı</th>
                                    <th>Sipariş Tarihi</th>
                                    <th>Kesim Tarihi</th>
                                    <th>Kesim Süresi</th>
                                </tr>
                            </thead>
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