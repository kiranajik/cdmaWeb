<?php

// // $conn = new mysqli("localhost","root","","covid");
// $conn = new mysqli("localhost","root","","covid");
$conn = new mysqli("localhost","u307892079_kiranajik","Kiran@#123","u307892079_covid");


if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}
$sql = "SELECT pDistrict, COUNT(*) AS freq FROM patient GROUP BY pDistrict";
$result = $conn->query($sql);
$Taluk_labels=[];
$Taluk_frequency=[];


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $Taluk_labels[] = $row["pDistrict"];
      $Taluk_frequency[] = $row["freq"];
    }
  } 
else 
{
    echo "0 results";
}


$sql2 = "SELECT pGender, COUNT(*) AS freq FROM patient GROUP BY pGender";
$result2 = $conn->query($sql2);
$gender_labels=[];
$gender_frequency=[];
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
      $gender_labels[] = $row["pGender"];
      $gender_frequency[] = $row["freq"];
    }
  } 
else 
{
    echo "0 results";
}

$sql3 = "SELECT pAge, COUNT(*) AS freq FROM patient GROUP BY pAge";
$result3 = $conn->query($sql3);
$age_labels=[];
$age_frequency=[];


if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
      $age_labels[] = $row["pAge"];
      $age_frequency[] = $row["freq"];
    }
  } 
else 
{
    echo "0 results";
}

$sql4 = "SELECT pSymptom, COUNT(*) AS freq FROM patient GROUP BY pSymptom";
$result4 = $conn->query($sql4);
$symp_labels=[];
$symp_frequency=[];


if ($result4->num_rows > 0) {
    while($row = $result4->fetch_assoc()) {
      $symp_labels[] = $row["pSymptom"];
      $symp_frequency[] = $row["freq"];
    }
  } 
else 
{
    echo "0 results";
}
  $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDMA</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
          }

        body{
          background-color:#e2e1e0;
        }

        .dark{
          background-color:#121212;
        }


        @media screen and (min-width: 650px) {
      .container {
        width:60vw;
        height:60vh;
        margin: 0 auto;
        
      }
      }
     
     
     
     
      @media screen and (max-width: 650px) {
      .container {
        width:87vw;
        margin: 0 auto;
        
      }
 }

    .item{
      background-color:white;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      padding:20px;
      border-radius:10px;
    }

    .item-dark{
      background-color:#1f1f1f;
     }
    .space{
      height:1em;
    }
    .container{
      margin-top:2em;
    }

</style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">


    <section class="covid-cases">
        <div class="item">
        <canvas id="histogram"></canvas>
        </div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="item">
        <canvas id="myChart"></canvas>
        </div>
        <div class="space"></div>
        <div class="item">
        <canvas id="line-chart"></canvas>
        </div>
        <div class="space"></div>
        <div class="item">
        <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>
        </div>
    </section>
</div>

<script>


const ctx = document.getElementById('histogram').getContext('2d');
const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels:["ALP","EKM","IDK","KNR","KGD","KLM","KTM","KKD","MLP","PKD","PT","TVM","TSR","WAD"],
    datasets: [{
      label: 'Covid Total Cases District-Wise  Distribution',
      data: <?php echo json_encode($Taluk_frequency); ?>,
      backgroundColor: [

      '#F54748',
      '#ff96ad',
      '#005a8d',
      '#022e57',
      "#95a5a6",
        "#2b59b6",
        "#f1c40f",
        "#fe9c8f",
        "#34495e",
        "#851e3e",
        "#63ace5",
        "#009688",
        "#96ceb4",
        "#76b4bd"
      ],
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1.0,
        ticks: {
          max: 3,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 4,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          autoskip:true
        }
      }]
    }
  },
});

var btx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(btx, {
  type: 'pie',
  data: {
    labels: <?php echo json_encode($gender_labels); ?>,
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db"
      ],
      data: <?php echo json_encode($gender_frequency); ?>
    }]
  }
});

var dtx = document.getElementById("line-chart").getContext('2d');
var lineChart = new Chart(dtx, {
  type: 'line',
  data: {
    labels: ["0-10", "10-20", "20-30", "30-40", "40-50", "50-60", "60-70", "70-80", "80-90", "90-100", "100+"],
    datasets: [
      {
        label: "Covid Age Wise Distribution",
        data: <?php echo json_encode($age_frequency); ?>,
        backgroundColor:'#F54748',
        borderColor: 'rgb(75, 192, 192)'
      }
    ],
    options: {
  	scales: {
    	yAxes: [{
        ticks: {
					reverse: false
        }
      }]
    }
  }
  }
});


new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: <?php echo json_encode($symp_labels); ?>,
      datasets: [
        {
          label: "Reported Covid Cases(patients)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#95a5a6",
        "#2b59b6",
        "#f1c40f",
        "#fe9c8f",],
          data: <?php echo json_encode($symp_frequency); ?>
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'All Reported cases and their symptoms'
      }
    }
});



$(document).ready(function(){


            $('.theme-toggle').click(function(){
                var element = document.body;  
                var url = $('#mode').attr('src');       
                element.classList.toggle("dark");
                $('header').toggleClass('header-dark');
                $('.item').toggleClass('item-dark');

                if(url=="moon.png")
                {
                dark="false";
                $('#mode').attr('src','sun.png');
                }
                else if(url=="sun.png")
                {
                dark="true";
                $('#mode').attr('src','moon.png');
                }
           
            });
        }); 



    </script>

</body>
</html>