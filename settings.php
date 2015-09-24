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
<script src="js/settingsmanager.js"></script>
<style type="css/text">

</style>
</head>
<body onload="getExistingUserFromDatabase()">
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
					<li><a href="settings.php" style="color: #610000"><span
							class="glyphicon glyphicon-user"></span> Manage Users</a></li>
					<li><a href="manageitem.php"><span class="glyphicon glyphicon-plus"></span>
							Manage Item</a></li>
					<li><a href="categories.php"><span
							class="glyphicon glyphicon-list-alt"></span> Categories</a></li>
					<li><a href="tax.php"><span class="glyphicon glyphicon-euro"></span>
							Tax</a></li>
					<li><a href="discounts.php"><span class="glyphicon glyphicon-gift"></span>
							offers and discounts</a></li>
				</ul>
			</div>

			<div class="col-sm-8">
				<h3>Users</h3>
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
					<table class="table table-striped" id="table_for_existing_userlist">
						<thead>
							<tr>
								<th>Firstname</th>
								<th>email</th>
							</tr>
						</thead>
						<tbody id="existing_userlist">
							<!--       <tr>
        <td contenteditable="true" >John</td>
        <td contenteditable="true" >Doe</td>
		<td contenteditable="true" >Doe@gmail.com</td>
      </tr>
      <tr>
        <td contenteditable="true">Mary</td>
        <td contenteditable="true">Moe</td>
		<td contenteditable="true">Moe@gmail.com</td>
      </tr>
      <tr>
        <td contenteditable="true">July</td>
        <td contenteditable="true">Dooley</td>
		<td contenteditable="true">Dooley@gmail.com</td>
      </tr> -->
						</tbody>
					</table>
					<button id="save" class="btn btn-success" onclick="saveUserMods();"
						type="button">
						<span class="glyphicon glyphicon-floppy-disk"></span> Save
					</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
