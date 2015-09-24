<?php
	include "./pdo.php"; 
	$db_file = "./restaurant.sqlite3";
	PDO_Connect("sqlite:$db_file");
	
	
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'report':
            generateReport();
            break;
			}
		}
function generateReport()
{
	$dateFrom =  $_POST['fromDate'];
	$dateTo = $_POST['toDate'];
	
	$dateFrom = substr($dateFrom, 4, 11);
	$dateTo = substr($dateTo, 4, 11);
	/*
	var_dump($dateFrom);
	if("Aug 14 2015" == $dateFrom ){
		echo "14th Aug";
	}else {
		echo "fail";
	}
	echo $dateFrom ."</br>" . $dateTo;*/
	//Mon Sep 14 2015 00:57:14 GMT+0530 (India Standard Time)
	//Mon Sep 14 2015 00:57:14 GMT+0530 (India Standard Time)
	
	$mydate=getdate(date("U"));
	//echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	//"Aug 23 2015";
	//$date = $mydate[mday]."-".substr( $mydate[month],0,3 ) ."-".$mydate[year];
	//$date = substr( $mydate['month'],0,3 )." ".$mydate['mday']." ".$mydate['year'];
	
	//echo "[12, 11, 15, 56 ,54, 45]";
	//$dateFrom = "Sep 10 2015" ;//$date ;//"Aug 23 2015";
	//$dateTo = $date ;//"Aug 30 2015";
	computeTotalValueForEachDate($dateFrom, $dateTo);
	computeAndDisplayEachDayTotalSalesAsGraph($dateFrom, $dateTo);
}

/*
Create dailytransactions table 
	id transactionID Items totalValue Date
Between given dates, compute the total value for each day 
For each day, 
	- Get all transactions for a day
	- Add the totalValue column 
	- put the totalValue computed for a day in transantionsTable
Now, you will be ready with Totalvalue for each day in transactionsTable 
*/
function computeTotalValueForEachDate($dateFrom, $dateTo) {
	
	//Todo
	//1. Get the total number of days between DateFrom and DateTo
	//2. Write a For each day loop. 
	//3. Inside the For each day loop, put the below working code. 
	//4. With this loop, you will have totalvalue of sales for each day computed.
	
	// Step #1
	$allDaysInGivenDates=PDO_FetchAll("SELECT Date FROM  dailytransactions WHERE Date BETWEEN :Date AND :Date2 ", array("Date"=>$dateFrom  , "Date2"=>$dateTo ) );
	
	$listOfUniqueDates = array();
	$listOfAllDatesAsArray = array();
	
	//Remove duplicate dates 
	if ( is_array ($allDaysInGivenDates) ) {
		//echo "Is array true";
		
		foreach ($allDaysInGivenDates as $eachDay ) {
			foreach ($eachDay as $key1 => $value1){
				$listOfAllDatesAsArray[] = $value1;
			}
		}
	} else {
		echo "Is not Array ";
	}
	
	$listOfUniqueDates = array_unique($listOfAllDatesAsArray) ;
	//print_r($listOfUniqueDates);
	
	//Step #2
	foreach ($listOfUniqueDates as $eachDay ) {
		//echo $eachDay . "<br>";
		//$dateFrom = $eachDay;
		
		//Step #3
		$allTransactionsForDay=PDO_FetchAll("SELECT  * FROM  dailytransactions WHERE Date =:Date", array("Date"=>$eachDay));
		$sum =0;
		foreach ($allTransactionsForDay as $eachTransaction) {
			// for each in array $v , take $k as key and $var as value. 
			foreach ($eachTransaction as $key => $value){
			if( $key == "totalValue" ) {
				$sum =  $sum  +  $value ;
				}			
			}
		}
		//Now insert this sum in the transactions table or update the existing 
		//echo "Sum " . $sum;
		updateTransactionsTable($eachDay, $sum);
	}
}

function updateTransactionsTable($dateFrom, $sum) {
	//Check if the date exists in the transactions table
	$dateInTable = PDO_FetchAll("SELECT * FROM transactions WHERE OrderDate =:Date" , array("Date"=>$dateFrom) ); 
	if( count($dateInTable) > 0) {
		//Do an update 
		PDO_Execute("UPDATE transactions SET OrderValue =:OrderValue WHERE OrderDate =:OrderDate", array("OrderDate"=>$dateFrom, "OrderValue"=>$sum));
	}else {
		//Do insert 
		PDO_Execute("INSERT INTO transactions (OrderDate,OrderValue) VALUES (:OrderDate, :OrderValue)", array("OrderDate"=>$dateFrom, "OrderValue"=>$sum));
	}
}

function srinu_ComputeTotalValueForEachDate() {
	//This is giving values for each day but not computing :(
	$stmt = "[";
	//$All=PDO_FetchAll("SELECT  totalValue FROM  dailytransactions WHERE Date BETWEEN :Date AND :Date2 ", array("Date"=>$dateFrom  , "Date2"=>$dateTo ) );
	$allTransactionsForDay=PDO_FetchAll("SELECT  * FROM  dailytransactions WHERE Date =:Date", array("Date"=>$dateFrom));
	//print_r($All);
	$sum =0;
	foreach ($allTransactionsForDay as $eachTransaction) {
		// for each in array $v , take $k as key and $var as value. 
		foreach ($eachTransaction as $key => $value){
		//echo intval("$value",0),"\n";
		//print_r($v);
		//echo "Count " . count($v);
		if( $key == "totalValue" ) {
			//echo $var;
			//echo $var . "<br>";
			$stmt =  $stmt  . $value . "," ;
			}			
		}
	}
	$stmt=substr_replace($stmt ,"",-1);
	$stmt = $stmt . "]";
	echo $stmt;
}

function computeAndDisplayEachDayTotalSalesAsGraph($dateFrom, $dateTo) {
		
	
	$All=PDO_FetchAll("SELECT  * FROM  transactions WHERE OrderDate BETWEEN :Date AND :Date2 ", array("Date"=>$dateFrom  , "Date2"=>$dateTo ) );
	//print_r($All);
	$index = 0;
	$stmt = "[";
	//For each element in $all, take one as $v
	foreach ($All as $v) {
		// for each in array $v , take $k as key and $var as value. 
		foreach ($v as $k => $var){
			//print_r($v);
			//echo "Count " . count($v);
			if( $k == "OrderValue" ) {
				//echo $var;
				//echo $var . "<br>";
				$stmt =  $stmt  . $var . "," ;
			}
		}
	}
	$stmt=substr_replace($stmt ,"",-1);
	//$stmt=trim($stmt, ",");
	$stmt = $stmt . "]";
	
	
	echo $stmt;
	// Compute for each date, the order value 
	// now, put these values in the array for Two selected dates. 
	// 1st day , 2nd day, 3rd day .. 
	//[100 , 1222, 33344, ]
}



?>		