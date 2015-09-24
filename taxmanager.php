<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

include "./pdo.php";
$db_file = "./restaurant.sqlite3";
PDO_Connect("sqlite:$db_file");


PDO_Execute("INSERT INTO tax(servicetax,vat,date) VALUES (:servicetax,:vat,:date )", array("servicetax"=>$_POST['servicetax'], "vat"=>$_POST['vat'], "date"=>$_POST['date']));
?>