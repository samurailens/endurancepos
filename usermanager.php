<?php
if (session_status () == PHP_SESSION_NONE) {
	session_start ();
}

include "./pdo.php";
$db_file = "./restaurant.sqlite3";
PDO_Connect ( "sqlite:$db_file" );

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	if (isset ( $_POST ['action'] )) {
		switch ($_POST ['action']) {
			
			case 'updateuserDatabase' :
				updateUserDetails ();
				break;
			case 'showexistinguserlist' :
				sendUserList ();
				break;
			case 'showexisting_items_inDB' :
				showExistingItemsInDb ();
				break;
			case 'updateitemsWithNewPrices' :
				updateitemsWithNewPrices ();
				break;
		}
	}
}
function updateitemsWithNewPrices() {
	$itemname = $_POST ['name'];
	$itemprice = $_POST ['price'];
	$selectdCategory = $_POST ['selectedcategory'];
	// echo $itemname . $itemprice . $selectdCategory; "category"=>$selectdCategory,
	PDO_Execute ( "UPDATE $selectdCategory SET price=:price WHERE name=:name  ", array (
			"price" => $itemprice,
			"name" => $itemname 
	) );
}
function updateUserDetails() {
	$fname = $_POST ['fname'];
	$enteremail = $_POST ['email'];
	PDO_Execute ( "UPDATE user SET fname=:fname WHERE email=:email", array (
			"fname" => $fname,
			"email" => $enteremail 
	) );
}
function showExistingItemsInDb() {
	$category = $_POST ['selectedcategory']; // '"starters";
	if ($category == 0) {
		// return ;
	}
	
	$result = PDO_FetchAll ( "SELECT name , price FROM $category" );
	$name = "";
	$price = "";
	$str = "";
	foreach ( $result as $resultObject ) {
		$str = "<tr>";
		foreach ( $resultObject as $key => $val ) {
			if ($key == "name") {
				// echo "Email :" .$val;
				$name = "<td contenteditable=false >" . $val . "</td>";
			} elseif ($key == "price") {
				// echo "fname :" . $val;
				$price = "<td contenteditable=true >" . $val . "</td >";
			}
		}
		$str = $str . $name . $price . "</tr>";
		echo $str;
		// echo $_POST['selectedcategory'] ;
	}
}
function sendUserList() {
	$result = PDO_FetchAll ( "SELECT email , fname FROM user" );
	
	// var_dump($result);
	$email = "";
	$fname = "";
	
	$str = "";
	foreach ( $result as $resultObject ) {
		$str = "<tr>";
		foreach ( $resultObject as $key => $val ) {
			if ($key == "email") {
				// echo "Email :" .$val;
				$email = "<td contenteditable=false >" . $val . "</td>";
			} elseif ($key == "fname") {
				// echo "fname :" . $val;
				$fname = "<td contenteditable=true >" . $val . "</td >";
			}
		}
		$str = $str . $fname . $email . "</tr> <br>";
		echo $str;
	}
}

?>