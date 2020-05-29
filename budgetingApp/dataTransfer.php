<?php 
include("query_class.php");
session_start();
header("Content-Type: application/json; charset=UTF-8");
$userEmail = $_SESSION['email'];

$query = new Query();
$userData = $query->getUserBudget($userEmail);

$dataGetter = new stdClass();

$dataGetter->email = $userData["email"];
$dataGetter->totalIncome = $userData["totalMonthlyIncome"];
$dataGetter->currentIncome = $userData["currentMonthlyIncome"];
$dataGetter->categoryPercentage[0] = $userData["entertainment"];
$dataGetter->categoryPercentage[1] = $userData["housing"];
$dataGetter->categoryPercentage[2] = $userData["recreation"];
$dataGetter->categoryPercentage[3] = $userData["nutrition"];
$dataGetter->categoryPercentage[4] = $userData["transportation"];
$dataGetter->categoryPercentage[5] = $userData["workstudy"];
$dataGetter->categoryPercentage[6] = $userData["savings"];
$dataGetter->categoryPercentage[7] = $userData["other"];


//$chartData = json_encode($dataGetter);
//echo $chartData;
echo json_encode($dataGetter);
?>
