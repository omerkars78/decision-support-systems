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
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <script src="https://kit.fontawesome.com/5c2368ed16.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <title>Anasayfa</title>
    <style>
        p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            padding-left: 12px;
            padding-top: 12px;
        }
        .h3 {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 1.2rem;
            padding-left: 12px;
            padding-top: 12px;
        }
        .box-2{
            width: 500px;
            height: 500px;
            align-items: center;
        }
        .activity-card{
            width: 500px;
            height: 500px;
            align-items: center;
        }
        .box-1{
            width: 500px;
            height: 500px;
            align-items: center;
        }
        .chart #myChart {
            width: 500px;
            height: 500px;
            align-items: center;
        }
        .anasayfa_main_container .content_container  .genel_bilgi_container_siparis .second_box_siparis {
            display: flex;
            flex-direction: column;
            width: 600px;
            height: 600px;
            border-radius: 15px;
            margin-right: 50px;
            margin-bottom: 75px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            align-items: center;

}
.anasayfa_main_container .content_container .genel_bilgi_container_siparis {
    display: flex;
    flex-direction: row;
    width: 1310px;
    height: 100%;
    margin: 5px;
    background-color: #f0f0f5;
    align-items: center;
}
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
.anasayfa_main_container .content_container .genel_bilgi_container_siparis .first_box_siparis {
    display: flex;
    flex-direction: column;
    width: 850px;
    height: 450px;
    border-radius: 15px;
    margin-left: 55px;
    margin-bottom: 75px;
    background-color: #cdcdcd;
    box-shadow: 0.5px 0.15rem 0.25rem #000;
    overflow: none;
    padding: 20px;
   

}
.anasayfa_main_container .content_container .genel_bilgi_container_siparis .first_box_siparis .siparis_bilgileri {
    display: flex;
    align-items: center;
    flex-direction: row;
    margin-left: 220px;
}
    </style>
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



            <div class="genel_bilgi_container_siparis">
                
                <div class="first_box_siparis">
                <div class="siparis_bilgileri"><p>Sipariş Bilgileri</p></div>
                    <table cellspacing="0" cellpadding="0" bordercolor="black" border="1">
                        <tr>
                            <th height="40">Sipariş ID</th>
                            <th>Tedarikçi Adı</th>
                            <th>Operasyon Sayısı</th>
                            <th>Sipariş Adeti</th>
                            <th>Sipariş Tarihi</th>
                        </tr>

                        <?php
                        include("../php/baglanti.php");

                        if ($con) {
                            $query = mysqli_query($con, "SELECT siparis.siparis_id , tedarikci.tedarikci_adi , siparis.siparis_adeti , COUNT(siparis_operasyon.operasyon_id) as operasyon_sayisi , siparis.siparis_tarihi 
FROM siparis , operasyon, siparis_operasyon , tedarikci
WHERE siparis.siparis_id=siparis_operasyon.siparis_id AND tedarikci.tedarikci_id = siparis.tedarikci_id AND operasyon.operasyon_id = siparis_operasyon.operasyon_id
GROUP BY siparis_operasyon.siparis_id;");
                            if (mysqli_num_rows($query) > 0) {
                                while ($rows = mysqli_fetch_array($query)) { ?>
                                    <tr bgcolor='#ffffff'>
                                        <td height="41" align="center"><?php echo $rows['siparis_id'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['tedarikci_adi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['operasyon_sayisi'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['siparis_adeti'] ?></td>
                                        <td height="41" align="center"><?php echo $rows['siparis_tarihi'] ?></td>

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

                <div class="second_box_siparis">
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


            </div>
        </div>






    </div>
    </div>
</body>

</html>