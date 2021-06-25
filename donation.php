<?php


$conn = new mysqli("localhost","root","","covid");
// $conn = new mysqli("localhost","u307892079_kiranajik","Kiran@#123","u307892079_covid");


if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$sql1 = "SELECT SUM(dAmount) AS 'Total Amount' FROM donation;";
$sql2 = "SELECT dDistrict, COUNT(*) AS freq FROM donation GROUP BY dDistrict";
$sql3 = "SELECT dBank, COUNT(*) AS freq FROM donation GROUP BY dBank";


$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);


$totalAmount=[];
$districtFrequecy=[];
$bankFrequency=[];
$bankLabels=[];


if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
      $totalAmount[]= $row["Total Amount"];
    }
} 
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
      $districtFrequecy[]= $row["freq"];
    }
} 
if ($result3->num_rows > 0) {
  while($row = $result3->fetch_assoc()) {
    $bankFrequency[] = $row["freq"];
    $bankLabels[]=$row['dBank'];
  }
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
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>




<style>
        
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
          }

        body{
          background-color:#121212;
        }

        .light{
          background-color:#e2e1e0;
        }


        @media screen and (min-width: 650px) {
      .container {
        width:60vw;
        height:60vh;
        margin: 0 auto;
        
      }
              
    
      .space{
      height:2em !important;
      }
      }
     
     
     
     
      @media screen and (max-width: 650px) {
      .container {
        width:87vw;
        margin: 0 auto;
        
      }
      .space{
      height:1em;
    }
 }

 .item{
      background-color:#1f1f1f;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      padding:20px;
      border-radius:10px;
    }

    .item-light{
      background-color:white;
     }
    .space{
      height:1em;
    }
    /* .container{
      margin-top:2em;
    } */

    .amt-banner-head{
        text-align: center;
        font-size: 2vh;
        background-color: palegoldenrod;
        padding: 5px;
        border-radius: 10px;
    }
    .amt-banner{
        text-align: center;
        padding: 10px;
        font-size: 3vh;
        color: white;
        background-color: #a52a2a;
        border-radius: 20px;
    }
    .donor{
        background-image: url(bg.webp);
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;
    }

</style>

</head>
<body>

<?php include "header.php"; ?>
<?php 
$page="donation";
include "nav.php"; ?>
<div class="container">


    <section class="relief-fund">
        <div class="item donor">
            <table style="margin:0 auto;border-spacing: 1ems;">
                <tr>
                <th class="amt-banner-head">Total Relief Fund Contribution</th>
                </tr>
                <tr>
                <td class="amt-banner"><?php echo "Rs. ". $totalAmount[0]; ?> </td>
                </tr>
            </table>
        </div>
        <div class="space"></div>
        <div class="item">
        <canvas id="histogram"></canvas>
        </div>
        <div class="space"></div>
        <div class="item">
        <canvas id="line-chart"></canvas>
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
      label: 'Donations District-Wise  Distribution',
      data: <?php echo json_encode($districtFrequecy); ?>,
      backgroundColor: [

      '#005a8d',
      "#009688",
      "#96ceb4",
      "#76b4bd",
      "#95a5a6",
      "#2b59b6",   
      "#34495e",
      "#851e3e",
      '#F54748',
      "#FFEEDB",
      '#ff96ad',
      '#022e57',
      "#f1c40f",
      "#fe9c8f",
      "#63ace5"

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
      }, 
      {
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
    },
    legend :  { display: false },
    title: {
        display: true,
        text: 'Donations - District Wise Distribution',
        fontSize:10
      }
  },
});

var dtx = document.getElementById("line-chart").getContext('2d');
var lineChart = new Chart(dtx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($bankLabels); ?>,
    datasets:[
      {
        label: "Contibutions - Bank Wise Distribution",
        data: <?php echo json_encode($bankFrequency); ?>,
        backgroundColor:'rgb(245, 71, 72,0.3)',
        borderColor: 'rgb(245, 71, 72)'
      }
    ],
    options: {
  	scales: {
    	yAxes: [{
        ticks: {
					reverse: false
        }
      }]
    },

  }
  }
});

$(document).ready(function(){


        $('.theme-toggle').click(function(){
            var element = document.body;  
            var url = $('#mode').attr('src');       
            element.classList.toggle("light");
            $('header').toggleClass('header-light');
            $('.item').toggleClass('item-light');

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