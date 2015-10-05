<!DOCTYPE html>
<?php
if (session_status () == PHP_SESSION_NONE) {
	session_start ();
}

if ($_SESSION ['user'] != 1) {
	header ( 'Location:login.php' );
}
if (! isset ( $_SESSION ['todaysTransactionID'] )) {
	$_SESSION ['todaysTransactionID'] = 1;
}

?>
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
	<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}

function addToCartFromSearch(val){
	var t = $(val).text();
	alert(t);

	//TODO
	// 1. We have the name of the item that user has selected.
	// 2. Search for the name of the item in all tables - starters / main course / desserts / beverages simultaneously
	// 3. Add the item from whereever you find it. 

	// JavaScript is asynchronous language . All calls go in independent fashion. They dont wait for previous call to complete.
	// Example 
	/*
		myfunction () {
			foo();
			goo();
			doo();
			hoo();
		}
		
		in myFunction() , all the 4 methods are called simultaneously . whether foo() completes it's execution or not, goo() will be called.
		we have to make use of this feature in JS and check in all the tables at one time without delay.

		So, you should write sometime like this 

		myFunctionAddToCart(itemname) {
			searchAndAddToCartFromStartersTable(itemName);
			searchAndAddToCartFromMainCourseTable(itemName);
			searchAndAddToCartFromBeveragesTable(itemName);
		}

		searchAndAddToCartFromStartersTable(itemName){
			search in DB using Ajax - like we did for Menu and add it to cart.

			when you search DB, we will get complete row in the table -- 'Mushroom Pepper Fry 120 yes	no' -- this result can be sent to AddToCart() 
			funtction after little formatting. 

			That way, we will re-use our code and make our functionality work.
		}
	*/
	
}

</script>
<style type="css/text">

</style>
</head>
<body>
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
					<li class="active"><a href="index.php"><span
							class="glyphicon glyphicon-home"></span> Home</a></li>
					<li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span>
							Settings</a></li>
					<li><a href="admin.php">Admin Options</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signup.htm"><span class="glyphicon glyphicon-user"></span>
							Sign Up</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-in"></span>
							Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">

			<div class="col-sm-9" style="background-color: lavenderblush;">
				<div class="input-group">
					<form role="form" id="form-order-type-radio-selector">
						<label class="radio-inline"> <input type="radio" id="dinein-radio"
							name="optradio" value="ordertype_dinein"><span
							class="glyphicon glyphicon-cutlery"></span> Dine in
						</label> <label class="radio-inline"> <input type="radio"
							id="delivery-radio" name="optradio" value="ordertype_delivery"><span
							class="glyphicon glyphicon-gift"></span> Delivery
						</label> <label class="radio-inline"> <input type="radio"
							id="pickup-radio" name="optradio" value="ordertype_pickup"><span
							class="glyphicon glyphicon-phone-alt"></span> Pickup
						</label>
					</form>
				</div>
				<br />
				<div class="input-group">
					
					<input type="text" class="form-control" onkeyup="showResult(this.value)">
				
					 <span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search"></span> Search
						</button>
					</span>
						
					
				</div>
				<!-- SEARCH RESULTS are shown here -->
					<div id="livesearch"></div>
				<br />
				<ul class="nav nav-tabs">
					<li id="starters" onclick="activateMenu(this);"><a href="#"
						style="color: #660000">Starters</a></li>
					<li id="maincourse" onclick="activateMenu(this);"><a href="#"
						style="color: #660000">Main Course</a></li>
					<li id="desserts" onclick="activateMenu(this);"><a href="#"
						style="color: #660000">Desserts</a></li>
					<li id="beverages" onclick="activateMenu(this);"><a href="#"
						style="color: #660000">Beverages</a></li>
				</ul>
				<ul class="list-group">
					<div id="result"></div>
				</ul>
				<p>
					<b> <span class="glyphicon glyphicon-bookmark"></span> Recent
						Orders
					</b>
				</p>
				<div class="list-group">
					<table class="">
						<tbody id="recent-orders-table">
							<tr>
								<td></td>
							</tr>
						</tbody>

					</table>
					<!--  <a href="#" class="list-group-item list-group-item-success">11233 - Idly, Vada, Coffee - Rs 120</a>
  <a href="#" class="list-group-item list-group-item-success">11232 - Masal Dosa, Vada, Coffee - Rs 150</a>
  <a href="#" class="list-group-item list-group-item-success">11231 - Kharabath, Coffee, Tea - Rs 80</a> -->
				</div>

			</div>
			<div class="col-sm-3" style="background-color: lavender;">
				<br />
				<p>
					<b> <span class="glyphicon glyphicon-plane"></span> Quick Order
					</b>
				</p>
				<ul class="list-group">
					<li class="list-group-item">Nuggets</li>
					<li class="list-group-item">Pizza</li>
					<li class="list-group-item">Pasta</li>
					<li class="list-group-item">Idly</li>
				</ul>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Items</th>
							<th>Qty</th>
							<th>P/U</th>
							<th>Cost</th>
						</tr>
					</thead>
					<tbody id="orderedProductsTblBody">
						<tr>
							<td>Add Items</td>
							<td>0</td>
						</tr>


					</tbody>

				</table>
				<div class="input-group col-xs-offset-6">
					<span class="input-group-btn">
						<button class="btn btn-primary" id="checkoutBtn" type="button"
							onclick="checkOutOrder()">
							<span class="glyphicon glyphicon-shopping-cart"></span> Check Out
						</button>
						<button class="btn btn-success" id="confirmOrderBtn"
							style="display: none" type="button" onclick="confirmOrder()">
							<span class="glyphicon glyphicon-shopping-cart"></span> Confirm
							Order
						</button> <br />
						<button class="btn btn-warning	" id="cancelOrderBtn"
							style="display: none" type="button" onclick="cancelOrder()">
							<span class="glyphicon glyphicon-shopping-cart"></span> Cancel
							Order
						</button>
					</span>
				</div>
			</div>
		</div>
	</div>

	<script src="js/getmenu.js"></script>
	<script src="js/cartmanager.js"></script>
	<script src="js/constants.js"></script>
	<script src="js/recentorders.js"></script>
	<script>
function activateMenu(e) {
	//alert($(this));
	if( $(e)[0].id == "starters" ){
		$("#maincourse-menu").hide();
		$("#starters-menu").show();
		$("#desserts-menu").hide();
		$("#beverages-menu").hide();
		
		$("#starters").addClass('active');
		$("#maincourse").removeClass('active');
		$("#desserts").removeClass('active');
		$("#beverages").removeClass('active');

		getmenuitems('starters');
	}else if ($(e)[0].id == "maincourse") {
		$("#maincourse-menu").show();
		$("#starters-menu").hide();
		$("#desserts-menu").hide();
		$("#beverages-menu").hide();
		
		$("#maincourse").addClass('active');
		$("#starters").removeClass('active');
		$("#desserts").removeClass('active');
		$("#beverages").removeClass('active');
		
		getmenuitems('maincourse');
	}else if ($(e)[0].id == "desserts") {
		$("#maincourse-menu").hide();
		$("#starters-menu").hide();
		$("#desserts-menu").show();
		$("#beverages-menu").hide();
		
		$("#maincourse").removeClass('active');
		$("#starters").removeClass('active');
		$("#desserts").addClass('active');
		$("#beverages").removeClass('active');
		
		getmenuitems('desserts');
	}else if ($(e)[0].id == "beverages") {
		$("#maincourse-menu").hide();
		$("#starters-menu").hide();
		$("#desserts-menu").hide();
		$("#beverages-menu").show();
		
		$("#maincourse").removeClass('active');
		$("#starters").removeClass('active');
		$("#desserts").removeClass('active');
		$("#beverages").addClass('active');
		
		getmenuitems('beverages');
	}
	
	
	//alert($(e)[0].id);
	
}
</script>
</body>
</html>
