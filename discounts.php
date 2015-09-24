<!DOCTYPE html>
<html>
<head>
<title>Basic HTML File</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style type="css/text">

</style>
</head>
<body>
<nav class="navbar navbar-inverse" style=" background-color: #610000">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"> <b>E</b>ndurance</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"  >
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li class="active"><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li ><a href="admin.php"><span class="glyphicon glyphicon-user"></span> Admin </a>
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li ><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

   <div class="container">
  <div class="row">

    <div class="col-sm-3" >
<ul class="nav nav-pills nav-stacked">
  <li ><a href="settings.php" ><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
  <li><a href="manageitem.php" ><span class="glyphicon glyphicon-plus"></span> Manage Item</a></li>
  <li><a href="categories.php" ><span class="glyphicon glyphicon-list-alt"></span> Categories</a></li>
  <li><a href="tax.php" ><span class="glyphicon glyphicon-euro"></span> Tax</a></li>
  <li><a href="discounts.php" style= "color:#610000"><span class="glyphicon glyphicon-gift"></span> offers and discounts</a></li>
</ul>
    </div>
	
	<div class="col-sm-8" style="background-color:lavenderblush" > 
	</br>
     <form class="form-horizontal" role="form">
    <div class="form-group">
      <label class="control-label col-sm-3" for="date">From Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" id="date" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3" for="Category">Select Category</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="Category" placeholder="Category">
      </div>
	    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo3">>> Display items</button>
  <div id="demo3" class="collapse">
	     <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-6">
    <div class="checkbox">
      <label><input type="checkbox" value="">Main Course</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">Starters</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="">Beverages</label>
    </div>
      </div>
    </div>
  </div>
    </div>
	    <div class="form-group">
      <label class="control-label col-sm-3" for="Discount">Discount (%)</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="Discount" placeholder="Discount Percentage">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>
  </div>
</div>

</body>
</html>                                		