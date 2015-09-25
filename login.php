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
					<li><a href="home.htm"><span class="glyphicon glyphicon-home"></span>
							Home</a></li>
					<li><a href="settings.htm"><span class="glyphicon glyphicon-cog"></span>
							Settings</a></li>
					<li><a href="#">Tools</a></li>
					<li><a href="#">Admin Options</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signup.htm"><span class="glyphicon glyphicon-user"></span>
							Sign Up</a></li>
					<li class="active"><a href="#"><span
							class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">

			<div class="col-sm-9" style="background-color: lavenderblush;">
				<div class="container">
					<form class="form-horizontal" method="POST"
						action="sessionmanager.php" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email:</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="email"
									name="emailsignin" placeholder="Enter email">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Password:</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="pwd"
									name="passwordsignin" placeholder="Enter password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<div class="checkbox">
									<label><input type="checkbox"> Remember me</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<button type="submit" name="signinbutton"
									class="btn btn-default">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
if (session_status () == PHP_SESSION_NONE) {
	session_start ();
}
?>