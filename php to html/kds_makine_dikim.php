<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
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
            width: 1310px;
            height: 100%;
            margin: 5px;
            background-color: #f0f0f5;
            align-items: center;
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
            margin-left:10px;
            border-radius: 15px;
            
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;
            /* overflow-y: scroll; */

        }


        .anasayfa_main_container .content_container .genel_bilgi_container_makina_2 #thirth_box_makina {
            display: flex;
            flex-direction: column;
            width: 950px;
            height: 350px;
            border-radius: 15px;
            margin-left: 175px;
            background-color: #cdcdcd;
            box-shadow: 0.5px 0.15rem 0.25rem #000;

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
            margin-top: 50px;
        }
    </style>
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
                        <p id="makina_igne_bilgileri">Makina Arıza Bilgileri</p>
                    </div>
                    <table id="ariza"  bordercolor="black" border="1">
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


            </div>

            <div class="genel_bilgi_container_makina_2">
                <div id="thirth_box_makina">

                </div>


            </div>


        </div>

    </div>
    </div>
</body>

</html>