<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

include "./pdo.php";
$db_file = "./restaurant.sqlite3";
PDO_Connect("sqlite:$db_file");

if ($_SERVER['REQUEST_METHOD'] == 'POST'  ) {

	//check if the user is coming from signup or sign-in
	if( isset($_POST['signupsubmitbutton'] ) ) {
		/* 
		 * this is a signup request, because user clicked the signup submit button
		 * echo "singup";
		 */
		 handleSignup() ;

	}else if ( isset($_POST['signinbutton'] ) ) {
		//this is a signin request.
		//handle Signin();
		//echo "sigin <br/>";
		SignIn() ;
	}
	else  if (isset($_POST['logout'] ) ) {
		SignOut();
	}
	else {
		// Do not let the user access this script directly like by typing  www.ourPOS.com/email.php
		// he should not see our scripts.
		// So, whenever this script is called, we check if user submitted the form or now, if he did not submit, then we redirect the user to login page or signup page
		echo "error : not sign in or sign up";
		//header('Location: sign up.php');
	}

} else {
	// Do not let the user access this script directly like by typing  www.ourPOS.com/email.php
	// he should not see our scripts.
	// So, whenever this script is called, we check if user submitted the form or now, if he did not submit, then we redirect the user to login page or signup page
	echo "error : not sign in or sign up, not post ";
	//header('Location: sign up.php');
}

function handleSignup(){
	//Already checked the post is not empty
	//Get the required vars
	$email = $_POST['email'];
	$fname = $_POST['fname'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	PDO_Execute("INSERT INTO user(email,fname,password,phone) VALUES (:email,:fname,:password,:phone )", array("email"=>$email, "fname"=>$fname, "password"=>$password, "phone"=>$phone));
	$_SESSION['user'] = 0;
	header('Location: signin.php');
}
function SignOut(){
	$_SESSION['user'] =0;
	header('Location: signin.php');
}
function SignIn() {
	/*$val = $_POST['passwordsignin']; //"rasmuslerdorf";
	 $hash=password_hash($val, PASSWORD_DEFAULT);
	echo "HASH " . $hash;
	if (password_verify($val, $hash)) {
	echo 'Password is valid!';
	} else {
	echo 'Invalid password.';
	}*/

	$enteredpassword  = $_POST['passwordsignin'];
	$enteremail = $_POST['emailsignin'];

	$result=PDO_FetchAll("SELECT password FROM user WHERE email = :email", array("email"=>$enteremail));
	$hash ='';
	foreach ($result as $res){
		foreach($res as $key => $val){
			//echo $val;
			$hash=$val;
		}
	}


	if ( password_verify($enteredpassword, $hash)) {
		echo "<br>". $enteredpassword .' Password is valid!';
		$_SESSION['user'] =1;
		$_SESSION['email'] = $enteremail;
		header('Location:index.php');
	}
	else { // password match failed
		$_SESSION['error'] = 1;
		$_SESSION['user'] = 0 ;
		//echo "Invalid Password";
		header('Location: signin.php');
	}
}

function dbConnect($db="") {
	global $dbhost, $dbuser, $dbpass;
	 
	$dbcnx = @mysql_connect($dbhost, $dbuser, $dbpass)
	or die("The site database appears to be down.");
	 
	if ($db!="" and !@mysql_select_db($db))
		die("The site database is unavailable.");
	 
	return $dbcnx;
}
function cout($var = ""){
	echo $var."<br/>";
}
?>