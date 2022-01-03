<?php
include("../php/baglanti.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5c2368ed16.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
    <style>
        .box-1{
            width: 500px;
            height: 500px;
        }
        .box-2{
            width: 500px;
            height: 500px;
        }
        .activity-card{
            width: 500px;
            height: 500px;
        }
        .box-1{
            width: 500px;
            height: 500px;
        }
        .chart #myChart {
            width: 500px;
            height: 500px;
        }
    </style>
</head>
<body>
<div class="box-1">
<div class="box-2">
              <div class="activity-card">

              <!-- <div class="chart">
                <canvas id="myChart"></canvas>
              </div>
              <?php
                  $kahramanlar = [];
                  $sql = "SELECT siparis.siparis_id, siparis.siparis_adeti
                  FROM siparis
                  ;";
                  $result = $con->query($sql);

                  if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                          $kahramanlar[$row["siparis_id"]] += $row["siparis_adeti"];
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
                        foreach ($kahramanlar as $key => $value) {
                          echo "'". $key ."',";
                        }
                      ?>
                  ],
                  datasets: [{
                    label: 'My First Dataset',
                    data: [
                      <?php
                      foreach ($kahramanlar as $key => $value) {
                        echo $value .",";
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

                </script> -->
                <script>
                    window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title:{
                    text: "Car Parts Sold in Different States"
                    },
                    subtitles: [{
                    text: "Click Legend to Hide or Unhide Data Series"
                    }],
                    axisX: {
                    title: "States"
                    },
                    axisY: {
                    title: "Oil Filter - Units",
                    titleFontColor: "#4F81BC",
                    lineColor: "#4F81BC",
                    labelFontColor: "#4F81BC",
                    tickColor: "#4F81BC",
                    includeZero: true
                    },
                    axisY2: {
                    title: "Clutch - Units",
                    titleFontColor: "#C0504E",
                    lineColor: "#C0504E",
                    labelFontColor: "#C0504E",
                    tickColor: "#C0504E",
                    includeZero: true
                    },
                    toolTip: {
                    shared: true
                    },
                    legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                    },
                    data: [{
                    type: "column",
                    name: "Oil Filter",
                    showInLegend: true,
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                    { label: "New Jersey", y: 19034.5 },
                    { label: "Texas", y: 20015 },
                    { label: "Oregon", y: 25342 },
                    { label: "Montana", y: 20088 },
                    { label: "Massachusetts", y: 28234 }
                    ]
                    },
                    {
                    type: "column",
                    name: "Clutch",
                    axisYType: "secondary",
                    showInLegend: true,
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                    { label: "New Jersey", y: 210.5 },
                    { label: "Texas", y: 135 },
                    { label: "Oregon", y: 425 },
                    { label: "Montana", y: 130 },
                    { label: "Massachusetts", y: 528 }
                    ]
                    }]
                    });
                    chart.render();

                    function toggleDataSeries(e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                    } else {
                    e.dataSeries.visible = true;
                    }
                    e.chart.render();
                    }

                    }
            </script>
              </div>
            </div>
          </div>
            </div>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                <?php

                include("../php/baglanti.php");
                ?>
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['ariza_turu', 'ariza_sikligi'],
                        <?php
                        require_once("baglanti.php");
                        if ($con) {
                            $sql = "SELECT ariza.ariza_turu, COUNT(ariza.ariza_turu) as ariza_sikligi
                            FROM makina , ariza 
                            WHERE makina.makina_id = ariza.makina_id 
                            GROUP BY ariza.ariza_turu;";
                            $result = mysqli_query($con, $sql);
                            $rowResult = mysqli_fetch_array($result);

                            $chart_data = "";
                            while ($row = mysqli_fetch_array($result)) {

                                echo "['" . $row["ariza_turu"] . "'," . $row["ariza_sikligi"] . "],";
                            }
                        } else {
                            echo "<h1>Bağlantı başarısız.</h1>";
                        }
                        ?>
                    ]);




                    var options = {
                        title: 'Arızaların Ortalama Tamir Süresi',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('pie'));

                    chart.draw(data, options);
                }
            </script>
</html>


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
                        <script>
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
                    </div>


                </div>