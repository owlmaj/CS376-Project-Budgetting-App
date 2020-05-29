//JS JSON vars

var chartInfo = [];
chartInfo = {
	"email": "test", 
	"totalIncome": 0, 
	"currentIncome": 0, 
	"categoryPercentage": [ 
		0,		//1 Entertainment
		0,		//2 Housing
		0,		//3 Recreation
		0,		//4 Nutrition
		0,		//5 Transportation
		0,		//6 Work/Study
		0,     	//7 Savings/Investments
		0		//8 Other
	]
};

var avePerc = [];
avePerc = {"entertainment": 0, "housing" : 0, "recreation": 0, "nutrition": 0, "transportation": 0, "workstudy": 0, "savings": 0, "other": 0};


function updateInfo(email){
	//make an AJAX call to get user info
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
			var newInfo = JSON.parse(this.responseText);
			setInfo(newInfo);
		}
	};
	xmlhttp.open("POST", "dataTransfer.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" + email);
	
	
}

function updateInfoChange(email){
	//make an AJAX call to get user info
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
			var newInfo = JSON.parse(this.responseText);
			setInfoChange(newInfo);
		}
	};
	xmlhttp.open("POST", "dataTransfer.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" + email);
	
	
}
function setInfoChange(newInfo){
		chartInfo.email = newInfo.email;
		chartInfo.totalIncome = newInfo.totalIncome;
		chartInfo.currentIncome = newInfo.currentIncome;
		for(var i = 0; i <= 7; i++){
			chartInfo.categoryPercentage[i] = newInfo.categoryPercentage[i];
		}
		
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

function setInfo(newInfo){
		chartInfo.email = newInfo.email;
		chartInfo.totalIncome = newInfo.totalIncome;
		chartInfo.currentIncome = newInfo.currentIncome;
		for(var i = 0; i <= 7; i++){
			chartInfo.categoryPercentage[i] = newInfo.categoryPercentage[i];
		}
		
		$("#email").html(chartInfo.email);
		$("#totalIncome").html("Total Income: $" + chartInfo.totalIncome);
		$("#currentIncome").html("Current Income: $" + chartInfo.currentIncome);
		
		var ctxD = document.getElementById("donutChart").getContext('2d');
		var myLineChart = new Chart(ctxD, {
		type: 'doughnut',
		data: {
		labels: ["Entertainment", "Housing", "Recreation", "Nutrition", "Transportation", "Work/Study", "Savings/Investments", "Other"],
		datasets: [{
			data: [chartInfo.categoryPercentage[0], chartInfo.categoryPercentage[1], chartInfo.categoryPercentage[2], chartInfo.categoryPercentage[3], chartInfo.categoryPercentage[4], chartInfo.categoryPercentage[5], chartInfo.categoryPercentage[6], chartInfo.categoryPercentage[7]],
			backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#FF0000", "#00FF00", "#0000FF"],
			hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
		}]
		},
		options: {
		responsive: true
		}
	});
	
	$("#perList1").html(
			"<ul class='list-group'><li class='list-group-item'>Entertainment: " + chartInfo.categoryPercentage[0] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[0])/100) + "</li><li class='list-group-item'>Housing: " + chartInfo.categoryPercentage[1] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[1])/100) + "</li><li class='list-group-item'>Recreation: " + chartInfo.categoryPercentage[2] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[2])/100) + "</li><li class='list-group-item'>Nutrition: " + chartInfo.categoryPercentage[3] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[3])/100) + "</li><li class='list-group-item'>Transportation: " + chartInfo.categoryPercentage[4] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[4])/100) + "</li><li class='list-group-item'>Work/Study: " + chartInfo.categoryPercentage[5] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[5])/100) + "</li><li class='list-group-item'>Savings/Investments: " + chartInfo.categoryPercentage[6] + "% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[6])/100) + "</li><li class='list-group-item'>Other: " + chartInfo.categoryPercentage[7] +"% - $" + ((chartInfo.totalIncome*chartInfo.categoryPercentage[7])/100) + "</li></ul>"
		);
		//console.log(chartInfo.categoryPercentage);
		//console.log(newInfo.categoryPercentage);
}

function getAverageArray(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			console.log("parsing data");
			var newInfo = JSON.parse(this.responseText);
			setAvg(newInfo);
		}
	};
	xmlhttp.open("POST", "average_calculator.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send();
}

function setAvg(newInfo){
	avePerc.entertainment = newInfo.entertainment;
	avePerc.housing = newInfo.housing;
	avePerc.recreation = newInfo.recreation;
	avePerc.nutrition = newInfo.nutrition;
	avePerc.transportation = newInfo.transportation;
	avePerc.workstudy = newInfo.workstudy;
	avePerc.savings = newInfo.savings;
	avePerc.other = newInfo.other;
	console.log(avePerc);
	
	console.log(avePerc + "just about to build");
		console.log(avePerc.entertainment);
		$("#perList2").html(
			"<ul class='list-group'><li class='list-group-item'>Entertainment: " + avePerc.entertainment + "%</li><li class='list-group-item'>Housing: " + avePerc.housing + "%</li><li class='list-group-item'>Recreation: " + avePerc.recreation + "%</li><li class='list-group-item'>Nutrition: " + avePerc.nutrition + "%</li><li class='list-group-item'>Transportation: " + avePerc.transportation + "%</li><li class='list-group-item'>Work/Study: " + avePerc.workstudy + "%</li><li class='list-group-item'>Savings/Investments: " + avePerc.savings + "%</li><li class='list-group-item'>Other: " + avePerc.other +"%</li></ul>"
		);
}