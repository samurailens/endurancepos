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
			
			case 'getTransID' :
				getLastTransactionIDFromDb ();
				break;
		}
	}
	
	if (isset ( $_POST ['json'] )) {
		saveTransactionToDb ();
	}
}
function getLastTransactionIDFromDb() {
	echo "getLastTransactionIDFromDb";
}
function saveTransactionToDb() {
	$transaction = json_decode ( $_POST ['json'] );
	$order_type = $_POST ['ordertype'];
	$traxn_id = $_POST ['transactionid'];
	$totalValue = $_POST ['totalVal'];
	$date = $_POST ['date'];
	
	$mydate = getdate ( date ( "U" ) );
	// echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	// "Aug 23 2015";
	// $date = $mydate[mday]."-".substr( $mydate[month],0,3 ) ."-".$mydate[year];
	$date = substr ( $mydate ['month'], 0, 3 ) . " " . $mydate ['mday'] . " " . $mydate ['year'];
	// echo $date;
	foreach ( $transaction as $eachitem ) {
		$str = "";
		$item_name = "";
		$item_price = "";
		
		foreach ( $eachitem as $key => $val ) {
			if ($key == "Name") {
				$item_name = $val;
			} else if ($key == "Price") {
				$item_price = $val;
			} else if ($key == "TypeOfOrder") {
				;
			}
			// $str = $str . $val ;
		}
		// echo $str. "</br>";
		// echo "Name " . $item_name . " Price " . $item_price ."</br>";
		PDO_Execute ( "INSERT INTO neworder (typeoforder,item,txnid,price ) VALUES (:typeoforder,:item,:txnid,:price)", array (
				"typeoforder" => $order_type,
				"item" => $item_name,
				"txnid" => $traxn_id,
				"price" => $item_price 
		) );
	}
	
	// save total value of transaction in dailytransactions
	PDO_Execute ( "INSERT INTO dailytransactions (transactionID,Items,totalValue,Date) VALUES (:transactionID, :Items, :totalValue , :Date)", array (
			"transactionID" => $traxn_id,
			"Items" => "",
			"totalValue" => $totalValue,
			"Date" => $date 
	) );
	
	saveTransactionToCloud();
	
	print ('{}') ;
}
function connectToDB() {
	$hostname = 'localhost';
	$dsn = 'endurance';
	$username = "root";//'samurai48';
	$password = '';//'sachin48';
	
	try {
		// $dbh = new PDO($dsn, $user, $password);
		$dbh = new PDO ( "mysql:host=$hostname;dbname=endurancepos", $username, $password );
		/*
		$sql = "SELECT * FROM endurance";
		foreach ( $dbh->query ( $sql ) as $row ) {
			echo $row ["collection_brand"] . " - " . $row ["collection_year"] . "<br/>";
		}*/
		return $dbh;
	} catch ( PDOException $e ) {
		echo 'Connection failed: ' . $e->getMessage ();
	}
}
function saveTransactionToCloud() {
	// TODO
	// Very similar to saveTransactionsToDb()/
	// But put data in Mysql DB.
	// Table => Store Specific
	/*
	 * Data to be saved = > "transactionID" => $traxn_id, "ItemsQty" => "", "OrderType" => "", "totalValue" => $totalValue, "Date" => $date
	 */
	
	print(' saveTransactionToCloud ->');
	
	$ordertype =  $_POST ['ordertype'];
	$totalValue =  $_POST ['totalVal'];
	$date = $_POST ['date'];
	$traxn_id = $_POST ['transactionid'];
	$transactionItems = serialize ( json_decode ( $_POST ['json'] ) );
	
	//$transactionItems = "items";
	
	$dbh  =  connectToDB();
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$ret = true;
	$device_specific_table = "rest_dev123";
	
	try {
	$statement = $dbh->prepare ( "INSERT INTO $device_specific_table (ordertype, totalvalue , orderdate , ordertime , itemdetails)
    VALUES(:ordertype, :totalvalue, :orderdate , :ordertime , :itemdetails )" );
	$ret = $statement->execute ( array (
			"ordertype" => $ordertype,
			"totalvalue" => $totalValue,
			"orderdate" => $date,
			"ordertime" => $date,
			"itemdetails" => $transactionItems,
			
	) );
	
	}	catch (PDOException $e) {
		echo $e->getMessage();//Remove or change message in production code
		print ($e->getMessage());
	}
	
	if($ret) {
		print('OK Execution');
	}else {
		print ('KO ');
	}
	print(' saveTransactionToCloud <-');
	/*
	"ordertime" => $date,
	"itemdetails" => $transactionItems,
	*/
}
?>