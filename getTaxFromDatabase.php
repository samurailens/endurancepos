<?php
if (session_status () == PHP_SESSION_NONE) {
	session_start ();
}

include "./pdo.php";
$db_file = "./restaurant.sqlite3";
PDO_Connect ( "sqlite:$db_file" );

$result = PDO_FetchAll ( "SELECT servicetax, vat FROM tax ORDER BY date DESC LIMIT 1" );

$serviceTax = 0;
$vat = 0;

foreach ( $result as $res ) {
	foreach ( $res as $key => $val ) {
		// echo "vav" . $val . "<br>";
		
		if ($key == "servicetax") {
			$serviceTax = $val;
		}
		
		if ($key == "vat") {
			$vat = $val;
		}
	}
}

echo " { " . '"servicetax":' . "$serviceTax" . "," . '"vat":' . $vat . " } ";

?>