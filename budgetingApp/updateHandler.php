<?php
	require('query_class.php');
	session_start();
	$newBudget = array();
	
	$newBudget["totalMonthlyIncome"] =  $_POST["income"];
	$newBudget["currentMonthlyIncome"] = $_POST["deduct"];
	$newBudget["entertainment"] = $_POST["ent"];
	$newBudget["housing"] = $_POST["hou"];
	$newBudget["recreation"] = $_POST["rec"];
	$newBudget["nutrition"] = $_POST["nut"];
	$newBudget["transportation"] = $_POST["trans"];
	$newBudget["workstudy"] = $_POST["worstu"];
	$newBudget["savings"] = $_POST["savinv"];
	$newBudget["other"] = $_POST["oth"];
	
	$updater = new Query();
	$redirect = $updater->updateBudget($_SESSION["email"], $newBudget);
	

	header("Location: index.php");
?>