<?php
session_start();

$_SESSION["email"] = "php@test.com"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Charts</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  
  <!--JQuery-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <!--jsPDF-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" 
crossorigin="anonymous"></script>
  <!--html2canvas-->
  <script src="js/html2canvas.min.js"></script>
 
</head>

<body>
<?php if($_SESSION['email'] != NULL) { ?>
	<header>
		<div class="row jumbotron container-fluid">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<h1>Percent Budget</h1>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-11">
				<h1><span id="email"></span>'s Dashboard</h1>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1">
				<a href="logout.php" style="font-size: 3em">
					<i class="fas fa-sign-out-alt"></i>
				</a>
			</div>
		</div>
		
	</header>
	<div class="container-fluid main">
		<div class="row">
			<span id="totalIncome"></span>
		</div>
		<div class="row">
			<span id="currentIncome"></span>
			<canvas id="donutChart"></canvas>
			<div class="container-fluid text-left">
				<button type="submit" class="btn btn-primary" onclick="generatePDF()">Generate Report</button>
				<button type="submit" class="btn btn-primary" onclick="window.location.href = 'updateInfo.php'">Update Information</button>
			</div> 
		</div>
	</div>
	
	
	<footer>
		<div class="row jumbotron container-fluid">
			<p>Legal Stuff?</p>
		</div>
	</footer>
  <!-- Start your project here-->
	
  
  <!-- /Start your project here-->
  

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.js"></script>
  <!-- JS JSON -->
  <script type="text/javascript" src="js/JSONvars.js"></script>
  <!-- Report Generator -->
  <script type="text/javascript" src="js/reportGenerator.js"></script>

  
</script>

<?php
echo "<script>", 
	 "$(updateInfo('",	
	 $_SESSION["email"],
	 "'));",
	 "</script>"
?>

<script>


//Get Chart Data
console.log(chartInfo);
$(document).load("js/JSONvars.js", chartInfo, makeChart());
console.log(chartInfo);
console.log(chartInfo.categoryPercentage[0]);
console.log(chartInfo.categoryPercentage[1]);

function makeChart(){
  //doughnut
  var ctxD = document.getElementById("donutChart").getContext('2d');
  var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
      labels: ["Entertainment", "Housing", "Recreation", "Nutrition", "Transportation", "Work/Study", "Savings/Investments", "Other"],
      datasets: [{
        data: [chartInfo.categoryPercentage[0], chartInfo.categoryPercentage[1], chartInfo.categoryPercentage[2], chartInfo.categoryPercentage[3], chartInfo.categoryPercentage[4], 
chartInfo.categoryPercentage[5], chartInfo.categoryPercentage[6], chartInfo.categoryPercentage[7]],
        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#FF0000", "#00FF00", "#0000FF"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
      }]
    },
    options: {
      responsive: true
    }
  });
}
$(function(){
	$("#email").html(chartInfo.email);
	$("#totalIncome").html("Total Income: $" + chartInfo.totalIncome);
	$("#currentIncome").html("Current Income: $" + chartInfo.totalIncome);
	makeChart();
	});
	
	

</script>
  
<?php } else { ?>
	<script>
		window.location.href = 'login.php';
	</script>
<?php } ?>
  
  
</body>

</html>
