<?php


$conn = new mysqli("localhost","root","","covid");
// $conn = new mysqli("localhost","u307892079_kiranajik","Kiran@#123","u307892079_covid");


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



$sql5a = "SELECT pDistrict, COUNT(*) AS freq FROM patient WHERE pStatus='P' GROUP BY pDistrict";
$sql5b = "SELECT pDistrict, COUNT(*) AS freq FROM patient WHERE pStatus='N' GROUP BY pDistrict";
$sql5c = "SELECT pDistrict, COUNT(*) AS freq FROM patient WHERE pStatus='D' GROUP BY pDistrict";
$sql6a = "SELECT pDistrict, COUNT(*) AS freq FROM patient WHERE pGender='F' GROUP BY pDistrict";
$sql6b = "SELECT pDistrict, COUNT(*) AS freq FROM patient WHERE pGender='M' GROUP BY pDistrict";

$sql7a = "SELECT pStatus, COUNT(*) AS freq FROM patient WHERE pGender='F' GROUP BY pStatus";
$sql7b = "SELECT pStatus, COUNT(*) AS freq FROM patient WHERE pGender='M' GROUP BY pStatus";



$result5a = $conn->query($sql5a);
$result5b = $conn->query($sql5b);
$result5c = $conn->query($sql5c);
$result6a = $conn->query($sql6a);
$result6b = $conn->query($sql6b);
$result7a = $conn->query($sql7a);
$result7b = $conn->query($sql7b);





$status_labels=[];
$status_frequency_P=[];
$status_frequency_N=[];
$status_frequency_D=[];
$male_district_frequency=[];
$female_district_frequency=[];
$male_status_frequenncy=[];
$female_status_frequency=[];


if ($result5a->num_rows > 0) {
    while($row = $result5a->fetch_assoc()) {
      $status_labels[] = $row["pDistrict"];
      $status_frequency_P[] = $row["freq"];
    }
  } 
else 
{
    echo "0 results";
}
if ($result5b->num_rows > 0) {
  while($row = $result5b->fetch_assoc()) {
    $status_frequency_N[] = $row["freq"];
   
  }
} 

else 
{
  echo "0 results";
}
if ($result5c->num_rows > 0) {
  while($row = $result5c->fetch_assoc()) {
    $status_frequency_D[] = $row["freq"];
  }
} 
else 
{
  echo "0 results";
}

if ($result6a->num_rows > 0) {
  while($row = $result6a->fetch_assoc()) {
    $female_district_frequency[] = $row["freq"];
  }
} 
if ($result6b->num_rows > 0) {
  while($row = $result6b->fetch_assoc()) {
    $male_district_frequency[] = $row["freq"];
  }
} 

if ($result7a->num_rows > 0) {
  while($row = $result7a->fetch_assoc()) {
    $female_status_frequency[] = $row["freq"];
  }
} 
if ($result7b->num_rows > 0) {
  while($row = $result7b->fetch_assoc()) {
    $male_status_frequency[] = $row["freq"];
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
    /* .container{
      margin-top:2em;
    } */

</style>
</head>
<body>

<?php include "header.php"; ?>
<?php include "nav.php"; ?>
<div class="container">


    <section class="covid-cases">
        <div class="item">
        <canvas id="histogram"></canvas>
        </div>
        <div class="space"></div>      
        <div class="item">
        <canvas id="pnchart"></canvas>
        </div>
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
        <div class="space"></div>
        <div class="item">
        <canvas id="district-gender-chart" width="800" height="450"></canvas>
        </div>
        <div class="space"></div>
        <div class="item">
        <canvas id="status-gender-chart" width="800" height="450"></canvas>
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
        text: 'Total covid Cases - District Wise Distribution',
        fontSize:10
      }
  },
});

var btx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(btx, {
  type: 'pie',
  data: {
    labels: ["Male","Female"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db"
      ],
      data: <?php echo json_encode($gender_frequency); ?>
    }]
  },
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
    },

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


var ltx = document.getElementById('pnchart').getContext('2d');
var myChart = new Chart(ltx, {
          type: 'bar',
          data: {
            labels: ["ALP","EKM","IDK","KNR","KGD","KLM","KTM","KKD","MLP","PKD","PT","TVM","TSR","WAD"],
            datasets: [{ 
                data:  <?php echo json_encode($status_frequency_N);?>,
                label: "-Ve",
                borderColor: "rgb(62,149,205)",
                backgroundColor: "rgb(62,149,205)",
                borderWidth:2
              }, { 
                data: <?php echo json_encode($status_frequency_P);?>,
                label: "+ve",
                borderColor: "rgb(255,165,0)",
                backgroundColor:"rgb(255,165,0)",
                borderWidth:2
              }, { 
                data: <?php echo json_encode($status_frequency_D);?>,
                label: "Death",
                borderColor: "rgb(196,88,80)",
                backgroundColor:"rgb(196,88,80)",
                borderWidth:2
              }
            ]
          },
});


new Chart(document.getElementById("district-gender-chart"), {
  type: 'line',
  data: {
    labels: ["ALP","EKM","IDK","KNR","KGD","KLM","KTM","KKD","MLP","PKD","PT","TVM","TSR","WAD"],
    datasets: [{ 
        data: <?php echo json_encode($male_district_frequency);?>,
        label: "Male",
        borderColor: "#3e95cd",
        backgroundColor:"#3e95cd",
        fill: false
      }, 
      { 
        data:  <?php echo json_encode($female_district_frequency);?>,
        label: "Female",
        borderColor: "#3cba9f",
        backgroundColor:"#3cba9f",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'District Wise Gender Analysis',
      fontSize: 10
    },
    legend: {
      position : 'bottom',
      labels:{
        usePointStyle:true,
        pointStyle: 'circle',
        fontSize:8

      }
    },
  }
});

new Chart(document.getElementById("status-gender-chart"), {
  type: 'line',
  data: {
        labels: ["Death","-Ve","+Ve"],
        datasets: [
      {
        data:  <?php echo json_encode($male_status_frequency);?>,
        label: "Male",
        borderColor: "#022e57",
        backgroundColor:"#022e57",
        fill: false
      }, 
      { 
        type: 'bar',
        label: 'Female',
        data: <?php echo json_encode($female_status_frequency);?>,
        borderColor: 'rgb(255,99,132)',
        backgroundColor: 'rgb(255,99,132,0.3)'
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Gender Wise Patient Status',
      fontSize: 10
    },
    legend: {
      position : 'bottom',
      labels:{
        usePointStyle:true,
        pointStyle: 'circle',
        fontSize:8

      }
    },
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