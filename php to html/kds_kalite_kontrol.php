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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        table {
            border: 1px solid black;
            width: 500px;
            height: 400px;
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

        p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            width: 305px;
            font-weight: bold;
        }

        .kalite_bilgileri {
            display: flex;
            align-items: center;
            margin-left: 100px;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_kalite .first_box_kalite {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 450px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_kalite .second_box_kalite {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 450px;
            border-radius: 15px;
            margin-left: 50px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

        }

        .anasayfa_main_container .content_container .genel_bilgi_container_kalite_2 {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .anasayfa_main_container .content_container .genel_bilgi_container_kalite_3 {
            display: flex;
            flex-direction: row;
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .kalite_chart_1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 450px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
        }

        .kalite_chart_2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 450px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
        }

        .kalite_chart_3 {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 650px;
            border-radius: 15px;
            margin-left: 50px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
        }

        .box-2 {
            width: 500px;
            height: 500px;
        }

        .activity-card {
            width: 500px;
            height: 500px;
        }

        .chart #myChart {
            width: 500px;
            height: 300px;
        }
        .chart #myChart_2 {
            width: 500px;
            height: 300px;
        }
        .chart #myChart_3 {
            width: 500px;
            height: 300px;
        }

        .fourth_box {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 600px;
            height: 450px;
            border-radius: 15px;
            margin-left: 30px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

        }

        form {
            background: var(--color-gradient-dark);
            padding: 2.5rem 0.625rem;
            border-radius: 1rem;
            backdrop-filter: blur(20px);
        }

        @media (min-width: 480px) {
            form {
                padding: 2.5rem;
            }
        }

        #form-group {
            margin: 0 auto 0.625rem auto;
            padding: 0.25rem;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 2.375rem;
            padding: 0.375rem 0.75rem;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: none;
            border-radius: 0.4rem;
        }


        .submit-button {
            display: block;
            position: static;
            background: var(--color-button);
            color: #fff;
            padding: 0.75rem;
            border-radius: 0.75rem;
            margin: auto;
            width: 150px;
            height: 50px;
            cursor: pointer;
            transition: padding, font-size 1s;
            backdrop-filter: blur(20px);
        }

        label {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .kayit_ol_text {
            margin-left: 150px;
        }

        .kalite_title {
            margin-left: 100px;
        }
    </style>
    <title>Kalite Kontrol</title>
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



            <div class="genel_bilgi_container_kalite">


                <div class="first_box_kalite">
                    <div class="kalite_bilgileri">
                        <p>Kalite Kontrol Bilgileri</p>
                    </div>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>
                            <th height="40">Sipariş ID</th>
                            <th>Sipariş Adeti</th>
                            <th>Sağlam Adet</th>
                            <th>Defolu Adet</th>
                            <th>Tamir Adet</th>
                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT siparis.siparis_id , siparis.siparis_adeti, kalite_kontrol.saglam_adet , kalite_kontrol.defolu_adet , kalite_kontrol.tamir_adet 
                            FROM kalite_kontrol , siparis 
                            WHERE kalite_kontrol.siparis_id = siparis.siparis_id;");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['siparis_id'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['siparis_adeti'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['saglam_adet'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['defolu_adet'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['tamir_adet'] ?></td>

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
                <div class="second_box_kalite">
                    <div class="kalite_bilgileri">
                        <p>Kalite Yüzde Bilgileri</p>
                    </div>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>
                            <th height="40">Sipariş ID</th>
                            <th>Sağlam Adeti Yüzdesi</th>
                            <th>Defolu Adeti Yüzdesi</th>
                            <th>Tamir Adeti Yüzdesi</th>
                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT siparis.siparis_id ,round((kalite_kontrol.saglam_adet / siparis.siparis_adeti)*100,2) as saglam_yuzde , 
                            round((kalite_kontrol.defolu_adet / siparis.siparis_adeti)*100,2) as defolu_yuzde , 
                            round((kalite_kontrol.tamir_adet / siparis.siparis_adeti)*100,2) as tamir_yuzde 
                            FROM 
                            siparis , kalite_kontrol 
                            WHERE siparis.siparis_id = kalite_kontrol.siparis_id
                            GROUP BY siparis.siparis_id;");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['siparis_id'] ?></td>
                                        <td height="41" align="center"><?php echo '%', $rows['saglam_yuzde'] ?></td>
                                        <td height="41" align="center"><?php echo '%', $rows['defolu_yuzde'] ?></td>
                                        <td height="41" align="center"><?php echo '%', $rows['tamir_yuzde'] ?></td>


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

            <div class="genel_bilgi_container_kalite_2">
                <div class="kalite_chart_1">
                    <div class="kalite_title">
                        <p>Sağlam Çıkan Ürün Listesi</p>
                    </div>
                    <div class="box-2">
                    
                        <div class="activity-card">

                            <div class="chart">
                                <canvas id="myChart"></canvas>
                            </div>
                            <?php

                        include("../php/baglanti.php");
                    ?>
                            <?php
                            $kalite_kontrol = [];
                            $sql = "SELECT siparis.siparis_id, round((kalite_kontrol.saglam_adet / siparis.siparis_adeti)*100,2) as saglam_yuzde , 
                    round((kalite_kontrol.defolu_adet / siparis.siparis_adeti)*100,2) as defolu_yuzde , 
                    round((kalite_kontrol.tamir_adet / siparis.siparis_adeti)*100,2) as tamir_yuzde
                    FROM 
                    siparis , kalite_kontrol 
                    WHERE siparis.siparis_id = kalite_kontrol.siparis_id
                    GROUP BY siparis.siparis_id;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $kalite_kontrol[$row["siparis_id"]] += $row["saglam_yuzde"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>


                        </div>


                    </div>
                </div>
                <div class="fourth_box">
                    <div class="kalite_title">
                        <p>Defolu Çıkan Ürün Listesi</p>
                    </div>
                    <div class="box-2">
                    <?php

                        include("../php/baglanti.php");
                    ?>
                        <div class="activity-card">

                            <div class="chart">
                                <canvas id="myChart_2"></canvas>
                            </div>
                            <?php
                            $kalite_kontrol_defolu = [];
                            $sql = "SELECT siparis.siparis_id, round((kalite_kontrol.saglam_adet / siparis.siparis_adeti)*100,2) as saglam_yuzde , 
                    round((kalite_kontrol.defolu_adet / siparis.siparis_adeti)*100,2) as defolu_yuzde , 
                    round((kalite_kontrol.tamir_adet / siparis.siparis_adeti)*100,2) as tamir_yuzde
                    FROM 
                    siparis , kalite_kontrol 
                    WHERE siparis.siparis_id = kalite_kontrol.siparis_id
                    GROUP BY siparis.siparis_id;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $kalite_kontrol_defolu[$row["siparis_id"]] += $row["defolu_yuzde"];
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
            <div class="genel_bilgi_container_kalite_3">
                <div class="kalite_chart_2">
                    <div class="kalite_title">
                        <p>Tamire Çıkan Ürün Listesi</p>
                    </div>
                    <div class="box-2">
                        <div class="activity-card">

                            <div class="chart">
                                <canvas id="myChart_3"></canvas>
                            </div>
                            <?php

                        include("../php/baglanti.php");
                    ?>
                            <?php
                            $kalite_kontrol_tamir = [];
                            $sql = "SELECT siparis.siparis_id, round((kalite_kontrol.saglam_adet / siparis.siparis_adeti)*100,2) as saglam_yuzde , 
                    round((kalite_kontrol.defolu_adet / siparis.siparis_adeti)*100,2) as defolu_yuzde , 
                    round((kalite_kontrol.tamir_adet / siparis.siparis_adeti)*100,2) as tamir_yuzde
                    FROM 
                    siparis , kalite_kontrol 
                    WHERE siparis.siparis_id = kalite_kontrol.siparis_id
                    GROUP BY siparis.siparis_id;";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $kalite_kontrol_tamir[$row["siparis_id"]] += $row["tamir_yuzde"];
                                }
                            } else {
                                echo "0 results";
                            }
                            $con->close();


                            ?>


                        </div>


                    </div>
                </div>

                <div class="kalite_chart_3">
                    <form action="" method="post" id="survey-form">

                        <div class="kayit_ol">
                            <p class="kayit_ol_text">Güncelleme Yap</p>
                        </div>

                        <div id="form-group">
                            <label id="email-label" for="email">Kalite ID: </label>
                            <input class="form-control" type="number" name="kalite" id="kalite" required placeholder="Kalite İd Giriniz">
                        </div>

                        <div id="form-group">
                            <label id="password-label" for="password">Sipariş ID: </label>
                            <input class="form-control" type="number" name="siparis" id="siparis" required placeholder="Sipariş İd Giriniz">
                        </div>

                        <div id="form-group">
                            <label id="password-label" for="password">Sağlam Adeti: </label>
                            <input class="form-control" type="number" name="saglam" id="saglam" required placeholder="Sağlam Adeti Giriniz">
                        </div>

                        <div id="form-group">
                            <label id="password-label" for="password">Defolu Adeti: </label>
                            <input class="form-control" type="number" name="defolu" id="defolu" required placeholder="Defolu Adeti Giriniz">
                        </div>

                        <div id="form-group">
                            <label id="password-label" for="password">Tamir Adeti: </label>
                            <input class="form-control" type="number" name="tamir" id="tamir" required placeholder="Tamir Adeti Giriniz">
                        </div>

                        <div id="form-group">
                            <button id="submit" class="submit-button" type="submit" name="submit" value="Register">
                                Güncelle
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
    </div>

    <?php
    require('../php/baglanti.php');
    // Form gönderildiğinde, değerleri veritabanına ekleyin.
    if (isset($_REQUEST['kalite'])) {
        // ters eğik çizgileri kaldırır
        $kalite = stripslashes($_REQUEST['kalite']);
        //bir dizedeki özel karakterlerden kaçar
        $kalite = mysqli_real_escape_string($con, $kalite);

        $siparis = stripslashes($_REQUEST['siparis']);
        $siparis = mysqli_real_escape_string($con, $siparis);

        $saglam = stripslashes($_REQUEST['saglam']);
        $saglam = mysqli_real_escape_string($con, $saglam);

        $defolu = stripslashes($_REQUEST['defolu']);
        $defolu = mysqli_real_escape_string($con, $defolu);

        $tamir = stripslashes($_REQUEST['tamir']);
        $tamir = mysqli_real_escape_string($con, $tamir);

        $query    = "UPDATE  `kalite_kontrol` SET  
        kalite_kontrol.siparis_id = '" . $siparis . "' , 
        kalite_kontrol.saglam_adet = '" . $saglam . "' , kalite_kontrol.defolu_adet = '" . $defolu . "',
        kalite_kontrol.tamir_adet = '" . $tamir . "'
        WHERE kalite_kontrol.kalite_id = '" . $kalite . "'  ";
        $result   = mysqli_query($con, $query);
        if ($result) {
            header("Location: ../php to html/kds_kalite_kontrol.php");
            echo "<div class='form'>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Gerekli Alanlar Eksik Tekar Dene.</h3><br/>
                  <p class='link'>Buraya Tıkla <a href='signup_1.php'>Tekrar Dene</a> </p>
                  </div>";
        }
    } else {
    ?>
    <?php
    }
    ?>
    <script>
        // Sağlam Ürün Çıktıları Grafiği
        const data = {
            labels: [
                <?php
                foreach ($kalite_kontrol as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Kalite Kontrol Grafiği',
                data: [
                    <?php
                    foreach ($kalite_kontrol as $key => $value) {
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

        const config = {
            type: 'line',
            data: data,
        };


        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, config);
        // Defolu Ürün Çıktıları Grafiği
        const data_2 = {
            labels: [
                <?php
                foreach ($kalite_kontrol_defolu as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Kalite Kontrol Grafiği',
                data: [
                    <?php
                    foreach ($kalite_kontrol_defolu as $key => $value) {
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

        const config_2 = {
            type: 'line',
            data: data_2,
        };


        const ctx_2 = document.getElementById('myChart_2');
        const myChart_2 = new Chart(ctx_2, config_2);
        // Tamir Ürün Çıktıları Grafiği
        const data_3 = {
            labels: [
                <?php
                foreach ($kalite_kontrol_tamir as $key => $value) {
                    echo "'" . $key . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Kalite Kontrol Grafiği',
                data: [
                    <?php
                    foreach ($kalite_kontrol_tamir as $key => $value) {
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

        const config_3 = {
            type: 'line',
            data: data_3,
        };


        const ctx_3 = document.getElementById('myChart_3');
        const myChart_3 = new Chart(ctx_3, config_3);
    </script>
</body>

</html>