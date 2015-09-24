<!DOCTYPE html>
<html>
<head>
<title>Basic HTML File</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="js/Chart.js"></script>

<style type="text/css">
.box {
	display: none;
}
</style>

<script type="text/javascript">
var responseData = [] ;
var labelData = [];

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="daterange"){
            $(".box").not(".daterange").hide();
            $(".daterange").show();
            
        }
        if($(this).attr("value")=="6months"){
            $(".box").not(".6months").hide();
            $(".6months").show();
            populateLabel6MonthsData();
            generateReport("sixmonths");
        }
        if($(this).attr("value")=="lastmonth"){
            $(".box").not(".lastmonth").hide();
            $(".lastmonth").show();
            populateLabelForLastMonth();
            generateReport("lastmonth");
        }

		if($(this).attr("value")=="pastweek"){
            $(".box").not(".pastweek").hide();
            $(".pastweek").show();
            pastWeekLabelData();
            generateReport("lastweek");
        }
    });

		var currentDate = new Date();
		var pastDate = new Date();
		var pastDatelastmonth = new Date();
		var pastDatelastweek = new Date();
		pastDate.setMonth(pastDate.getMonth() - 6);
		pastDatelastmonth.setMonth(pastDatelastmonth.getMonth() - 1);
		pastDatelastweek.setDate(pastDatelastweek.getDate() - 7);
		document.getElementById("from").innerHTML = pastDate.toDateString();
		document.getElementById("to").innerHTML = currentDate.toDateString();
		document.getElementById("lastmonthfrom").innerHTML = pastDatelastmonth.toDateString();
		document.getElementById("lastmonthto").innerHTML = currentDate.toDateString();
		document.getElementById("lastweekfrom").innerHTML = pastDatelastweek.toDateString();
		document.getElementById("lastweekto").innerHTML = currentDate.toDateString();
		
});

</script>


</head>
<body onload="generateReport();">
	<nav class="navbar navbar-inverse" style="background-color: #610000">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Endurance</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>
							Home</a></li>
					<li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span>
							Settings</a></li>
					<li class="active"><a href="admin.php"><span
							class="glyphicon glyphicon-user"></span> Admin </a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signup.htm"><span class="glyphicon glyphicon-user"></span>
							Sign Up</a></li>
					<li><a href="login.htm"><span class="glyphicon glyphicon-log-in"></span>
							Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">



			<div class="col-sm-2" style="background-color: lavenderblush;">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="admin.htm" style="color: #610000"><span
							class="glyphicon glyphicon-user"></span> Sales</a></li>
					<li><a href="Profit.htm"><span class="glyphicon glyphicon-plus"></span>
							Profit</a></li>
					<li><a href="admin_tax.htm"><span
							class="glyphicon glyphicon-list-alt"></span> Tax</a></li>
					<li><a href="users.htm"><span class="glyphicon glyphicon-user"></span>
							Users</a></li>
					<li><a href="Items.htm"><span class="glyphicon glyphicon-th"></span>
							Items</a></li>
					<li><a href="Categories.htm"><span
							class="gglyphicon glyphicon-list"></span> Categories</a></li>
				</ul>
			</div>

			<div class="col-sm-10">
				<div class="container">
					</br>
					<form role="form">
						<label class="radio-inline"> <input type="radio" name="colorRadio"
							value="daterange">By Date Range
						</label> <label class="radio-inline"> <input type="radio"
							name="colorRadio" value="6months">6 Months
						</label> <label class="radio-inline"> <input type="radio"
							name="colorRadio" value="lastmonth">Last Month
						</label> <label class="radio-inline"> <input type="radio"
							name="colorRadio" value="pastweek">Past week
						</label>
					</form>
					<br />
					<div class="daterange box">
						<form role="form">
							<div class="form-group">
								<label for="datefrom">From:</label> <input type="date"
									id=dateinputstart name="datefrom"> <label for="dateto">To:</label>
								<input type="date" id=dateinputend name="dateto">
							</div>
						</form>
					</div>

					<div class="6months box">
						<span>From</span>
						<p id="from"></p>
						<span>To</span>
						<p id="to">To</p>
					</div>
					<div class="lastmonth box">
						<span>From</span>
						<p id="lastmonthfrom"></p>
						<span>To</span>
						<p id="lastmonthto">To</p>
					</div>
					<div class="pastweek box">
						<span>From</span>
						<p id="lastweekfrom"></p>
						<span>To</span>
						<p id="lastweekto">To</p>
					</div>

					<!-- Charts are displayed here  -->
					<div id="canvas-holder">
						<canvas id="canvas" height="400" width="350"></canvas>
					</div>

					<form class="form-horizontal" role="form">
						<div class="form-group">
							<div class="col-sm-6">
								<button type="button" class="btn btn-default col-sm-offset-2">
									<span class="glyphicon glyphicon-th-list"></span> View Table
								</button>
								<button type="button" class="btn btn-default col-sm-offset-1">
									<span class="glyphicon glyphicon-print"></span> Print
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>

		<!--  <div> <input type="date" id=dateinputstart value="2014-09-11" ></div>
<div> <input type="date" id=dateinputend value="2015-09-11" ></div> -->
		<script>
	var monthNames = ["January", "February", "March", "April", "May", "June",
                  "July", "August", "September", "October", "November", "December"
                ];
    var weekDayNames = ["Sunday", "Monday" , "Tuesday" , "Wednesday" ,"Thursday", "Friday", "Saturday"];

    var myLineChart ;
	
	function showReport() {

	$('#canvas').remove(); // this is my <canvas> element
    $('#canvas-holder').append('<canvas id="canvas" height="400" width="350"><canvas>');
    /*
    canvas = document.querySelector('#results-graph');
    ctx = canvas.getContext('2d');
    ctx.canvas.width = $('#graph').width(); // resize to parent width
    ctx.canvas.height = $('#graph').height(); // resize to parent height

    var x = canvas.width/2;
    var y = canvas.height/2;
    ctx.font = '10pt Verdana';
    ctx.textAlign = 'center';
    ctx.fillText('This text is centered on the canvas', x, y);
    */
		
	var mydata = []; //[100,2,50,50,40,30,80]
	mydata = getData();
	var lineChartData = {
			labels : labelData , //["January","February","March","April","May","June","July"],
			//labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : mydata 
				}/*,
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					//data : [28,48,40,19,96,27,100]
					data : mydata 
				}*/
			]
		}

	myLineChart = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
	
	}
	
	function getData() {
		//alert(responseData);
		return  responseData;
	}
	
	function generateReport(str){
		 var clickBtnValue = "report";
		 var ajaxurl = 'reports.php';

		 var currentDate = new Date();
		 var pastDate = new Date();
		
		 if (str == "sixmonths"){
			 var it = pastDate.getMonth() - 6;
			 pastDate.setMonth(it);
			}else if (str == "lastmonth") {
				var it = pastDate.getMonth() - 1;
				pastDate.setMonth(it);
			}else if (str == "lastweek") {
				var it = pastDate.getDay();
				pastDate.setDate( pastDate.getDate() - 7);
			}else {
				pastDate = new Date($("#dateinputstart").val());
				currentDate = new Date($("#dateinputend").val());
		}
		 
	    data =  {'action': clickBtnValue , 'fromDate':pastDate , 'toDate':currentDate};
		 $.post(ajaxurl, data, function (response) {
			 responseData = JSON.parse( response );
			 showReport();
			 //$("#res").html(response);
			 try {
			    JSON.parse(response);
			} catch (e) {
			    return false;
			}
			 
			 
		 });
	}

	function populateLabelForLastMonth(){
		var currentDate = new Date();
		var pastDate = new Date();
		labelData = [];
		var it = pastDate.getMonth() - 1;
		pastDate.setMonth(it);

		labelData.push(monthNames[currentDate.getMonth()]);
		labelData.push(monthNames[pastDate.getMonth()]);
		
	}
	function populateLabel6MonthsData(){
		 var currentDate = new Date();
		 var pastDate = new Date();
		 labelData = [];
		 //console.log( $("#dateinput").val() );
		 //console.log( new Date($("#dateinput").val()) );

		 
		 for( var i = 0; i < 6 ; i++ ) {
			 var it = pastDate.getMonth() - 1;
			 pastDate.setMonth(it);
			 console.log(pastDate);
			 console.log(monthNames[pastDate.getMonth()]);
			 labelData.push(monthNames[pastDate.getMonth()]);
			 }
		 console.log(labelData);
		
	}

	function pastWeekLabelData(){
		 var currentDate = new Date();
		 var pastDate = new Date();
		 labelData = [];
		 
		 console.log( new Date($("#dateinputstart").val()) );
		 console.log( new Date($("#dateinputend").val()) );
		 
		 for( var i = 0; i < 7 ; i++ ) {
			 var it = pastDate.getDay();
			 pastDate.setDate( pastDate.getDate() - 1);
			 console.log(pastDate);
			 console.log(weekDayNames[pastDate.getDay()]);
			 labelData.push(weekDayNames[pastDate.getDay()]);
			 }
	}

	function getDateDiffForCustomDates(){

		 console.log( new Date($("#dateinputstart").val()) );
		 console.log( new Date($("#dateinputend").val()) );
		 
		var date1 = new Date($("#dateinputstart").val());
		var date2 = new Date($("#dateinputend").val());

		
		var diff = new Date(date2.getTime() - date1.getTime());
		// diff is: Thu Jul 05 1973 04:00:00 GMT+0300 (EEST)

		console.log(diff.getUTCFullYear() - 1970); // Gives difference as year
		if( ( diff.getUTCFullYear() - 1970 ) > 1 ) {
				return ( diff.getUTCFullYear() - 1970 );
		}
		// 3

		console.log(diff.getUTCMonth()); // Gives month count of difference
		if( diff.getUTCMonth() > 0){
			return 
		}
		// 6

		console.log(diff.getUTCDate() - 1); // Gives day count of difference
		// 4
		}
		
	</script>

</body>
</html>
