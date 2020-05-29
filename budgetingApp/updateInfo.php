<?php
require("query_class.php");

session_start();
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <!--html2canvas-->
  <script src="js/html2canvas.min.js"></script>
 
</head>

<body>
<?php if($_SESSION['email'] != NULL) { ?>

<!-- ================================================== -->
<!-- Here is the form for changing/updating budget info -->
<!-- ================================================== -->

<div class="container">
	<h2>Change/Update Budget</h2>
	<form name="updateForm" action="updateHandler.php" onsubmit="return validateForm()" method="post">		<!-- Uhhh, link something here to make stuff happen -->
		
		<div class="form-group">
			<label for="deduct">Current Income:</label>
			<input type="number" step="0.01" min="0" class="form-control" id="deduct" placeholder="Enter deduction amount" value="" name="deduct">
		</div>
		
		<!-- The bootstrap form-group for the total monthly income field -->
		<div class="form-group">
			<label for="income">Total Monthly Income:</label>
			<input type="number" step="0.01" min="0" class="form-control" id="income" placeholder="Enter total monthly income" value="" name="income">
		</div>

		<!-- THE FOLLOWING FORM ELEMENTS RELY ON PERCENTAGES (VALUES BETWEEN 0 AND 100)-->
		<!-- AS SUCH, WE WILL NEED A WAY TO CHECK TO ENSURE THAT A USER HASN'T PUT IN -->
		<!-- VALUES THAT ADD UP TO MORE THAN 100% WHEN COMBINED TOGETHER! -->
		
		<p>Please input what percentage of your total monthly income above you would like to dedicate to each category. </p>

		<!-- The bootstrap form-group for the entertainment percentage field -->
		<div class="form-group">
			<label for="ent">Entertainment:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="ent" placeholder="Entertainment percentage" value="" name="ent">
		</div>

		<!-- The bootstrap form-group for the housing percentage field -->
		<div class="form-group">
			<label for="hou">Housing:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="hou" placeholder="Housing percentage" value="" name="hou">
		</div>

		<!-- The bootstrap form-group for the recreation percentage field -->
		<div class="form-group">
			<label for="rec">Recreation:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="rec" placeholder="Recreation percentage" value="" name="rec">
		</div>

		<!-- The bootstrap form-group for the nutrition percentage field -->
		<div class="form-group">
			<label for="nut">Nutrition:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="nut" placeholder="Nutrition percentage" value="" name="nut">
		</div>
		
		<!-- The bootstrap form-group for the transportation percentage field -->
		<div class="form-group">
			<label for="trans">Transportation:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="trans" placeholder="Transportation percentage" value="" name="trans">
		</div>

		<!-- The bootstrap form-group for the work/study percentage field -->
		<div class="form-group">
			<label for="worstu">Work/Study:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="worstu" placeholder="Work/study percentage" value="" name="worstu">
		</div>

		<!-- The bootstrap form-group for the savings/investments percentage field -->
		<div class="form-group">
			<label for="savinv">Savings/Investments:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="savinv" placeholder="Savings/investments percentage" value="" name="savinv">
		</div>

		<!-- The bootstrap form-group for the other percentage field -->
		<div class="form-group">
			<label for="oth">Other:</label>
			<input type="number" step="1" min="0" max="100" class="form-control" id="oth" placeholder="Other percentage" value="" name="oth">
		</div>

		<button type="submit" class="btn btn-primary">Update</button>
	</form>
		<button class="btn btn-primary" onclick="window.location.href = 'index.php'" style="margin-top:2px">Return to Dashboard</button>
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
	 "$(updateInfoChange('",	
	 $_SESSION["email"],
	 "'));",
	 "</script>"
?>  
	<script>/*
	$(function(){
		$(document).load("js/JSONvars.js", chartInfo, fillForm());
		console.log(chartInfo);
		
		function fillForm(){
				//verify that info was updated
				if(chartInfo.email == "test")
					location.reload();
			
				$("#income").attr('value', chartInfo.totalIncome);
				$("#deduct").attr('value', chartInfo.currentIncome);
				$("#ent").attr('value', chartInfo.categoryPercentage[0]);
				$("#hou").attr('value', chartInfo.categoryPercentage[1]);
				$("#rec").attr('value', chartInfo.categoryPercentage[2]);
				$("#nut").attr('value', chartInfo.categoryPercentage[3]);
				$("#trans").attr('value', chartInfo.categoryPercentage[4]);
				$("#worstu").attr('value', chartInfo.categoryPercentage[5]);
				$("#savinv").attr('value', chartInfo.categoryPercentage[6]);
				$("#oth").attr('value', chartInfo.categoryPercentage[7]);
		}
	});
*/	
	function validateForm(){
		var x = parseInt(document.forms["updateForm"]["ent"].value);
		x += parseInt(document.forms["updateForm"]["hou"].value);
		x += parseInt(document.forms["updateForm"]["rec"].value);
		x += parseInt(document.forms["updateForm"]["nut"].value);
		x += parseInt(document.forms["updateForm"]["trans"].value);
		x += parseInt(document.forms["updateForm"]["worstu"].value);
		x += parseInt(document.forms["updateForm"]["savinv"].value);
		x += parseInt(document.forms["updateForm"]["oth"].value);
		
		if(x != 100){
			alert("Percents do not add to 100! Current total:" + x);
			return false;
		}
	}
	</script>
  
  
<?php } else { ?>
	<script>
		window.location.href = 'login.php';
	</script>
<?php } ?>
  
  
</body>

</html>
