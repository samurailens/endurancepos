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
					<li><a href="manageitem.php"><span class="glyphicon glyphicon-plus"></span>
							Manage Item</a></li>
					<li><a href="categories.php" style="color: #610000"><span
							class="glyphicon glyphicon-list-alt"></span> Categories</a></li>
					<li><a href="tax.php"><span class="glyphicon glyphicon-euro"></span>
							Tax</a></li>
					<li><a href="discounts.php"><span class="glyphicon glyphicon-gift"></span>
							offers and discounts</a></li>
				</ul>
			</div>

			<div class="col-sm-8">
				<p>
					<b>Edit Categories:</b>
				</p>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Category Name</th>
							<th>No of Items</th>
							<th>Discount(%)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td contenteditable="true">Main Course</td>
							<td>15</td>
							<td contenteditable="true">12</td>
						</tr>
						<tr>
							<td>2</td>
							<td contenteditable="true">Starter</td>
							<td>12</td>
							<td contenteditable="true">10</td>
						</tr>
						<tr>
							<td>3</td>
							<td contenteditable="true">Beverages</td>
							<td>9</td>
							<td contenteditable="true">0</td>
						</tr>
					</tbody>
				</table>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<button type="button" class="btn btn-default col-sm-offset-1">
							<span class="glyphicon glyphicon-trash"></span> Discard
						</button>
						<button type="button" class="btn btn-default  ">
							<span class="glyphicon glyphicon-ok"></span> Save
						</button>
					</div>
				</form>
				<p>
					<b>Add Existing Item to Category:</b>
				</p>
				<p>Uncategorized items</p>
				<select multiple class="form-control" id="sel2">
					<option>Milk</option>
					<option>coffee</option>
					<option>Coke</option>
					<option>Boost</option>
					<option>Complan</option>
				</select> <br />
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button"
						data-toggle="dropdown">
						Select Category <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="#">Starters</a></li>
						<li><a href="#">Main Course</a></li>
						<li><a href="#">Beverages</a></li>
					</ul>
				</div>
				<br />
				<div class="form-group">
					<button type="submit" class="btn btn-default ">
						<span class="glyphicon glyphicon-floppy-disk"></span> Save
					</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
