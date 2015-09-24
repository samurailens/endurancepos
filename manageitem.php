<!DOCTYPE html>
<html>
<head>
<title>Basic HTML File</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- jQuery library -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/settingsmanager.js"></script>

<script type="text/javascript">
//  $(document).ready(function(argument) {
//  $('#save').click(function(){
//  // Get edit field value
//  $edit = $('#editor').html();
//  $.ajax({
//  url: 'get.php',
//  type: 'post',
//  data: {data: $edit},
//  datatype: 'html',
//  success: function(rsp){
//  alert(rsp);
//  }
//  });
//  });
//  });


 

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
				<a class="navbar-brand" href="#"> <b>E</b>ndurance
				</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>
							Home</a></li>
					<li class="active"><a href="settings.php"><span
							class="glyphicon glyphicon-cog"></span> Settings</a></li>
					<li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>
							Admin </a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span>
							Sign Up</a></li>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>
							Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">

			<div class="col-sm-3">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="settings.php"><span class="glyphicon glyphicon-user"></span>
							Manage Users</a></li>
					<li><a href="manageitem.php" style="color: #610000"><span
							class="glyphicon glyphicon-plus"></span> Manage Item</a></li>
					<li><a href="Categories.php"><span
							class="glyphicon glyphicon-list-alt"></span> Categories</a></li>
					<li><a href="tax.php"><span class="glyphicon glyphicon-euro"></span>
							Tax</a></li>
					<li><a href="discounts.php"><span class="glyphicon glyphicon-gift"></span>
							offers and discounts</a></li>
				</ul>
			</div>

			<div class="col-sm-8">

				<h3>
					<b>Items</b>
				</h3>

				<div class="input-group">
					<input type="text" class="form-control"> <span
						class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search"></span> Search
						</button>
					</span>
				</div>
				<br />
				<div>
					<div>
						<select id="manage-item-category">

							<option value="starters">Starters</option>
							<option value="maincourse">Main Course</option>
							<option value="desserts">Desserts</option>
							<option value="beverages">Beverages</option>

						</select>
						<!-- <ul class="dropdown-menu">
      <li><a href="#">Starters</a></li>
      <li><a href="#">Main Course</a></li>
      <li><a href="#">Beverages</a></li>
    </ul> -->
					</div>
					<table class="table table-striped" id="existing_items_list_in_db">

						<thead>
							<tr>
								<th>Name</th>
								<th>Cost</th>
								<!-- <th>Category</th>  -->
								<th>Discount(%)</th>
							</tr>
						</thead>
						<tbody id="table-body-exisiting-items">
							<tr>
								<td contenteditable="plaintext-only" id="editor">Biryani</td>
								<td contenteditable="true">Main Course</td>
								<td contenteditable="true">120</td>
								<td contenteditable="true">12</td>
							</tr>
							<tr>
								<td contenteditable="true">Burger</td>
								<td contenteditable="true">Starter</td>
								<td contenteditable="true">55</td>
								<td contenteditable="true">12</td>
							</tr>
							<tr>
								<td contenteditable="true">French Fries</td>
								<td contenteditable="true">Starter</td>
								<td contenteditable="true">60</td>
								<td contenteditable="true">17</td>
							</tr>
						</tbody>
					</table>
					<button id="save" class="btn btn-success"
						onclick="saveNewPrices();" type="button">
						<span class="glyphicon glyphicon-floppy-disk"></span> Save
					</button>
				</div>

			</div>
		</div>
	</div>
	<script>
$("select" )
.change(function () {
  var str = "";  
  $( "select option:selected" ).each(function() {
    str += $( this ).val() + " ";
  });
  //$( "div" ).text( str );
  manageitems(str);
})
.change();
 </script>
</body>
</html>
