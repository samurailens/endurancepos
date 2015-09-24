<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if($_SESSION['user'] != 1)
{
	header('Location:login.php');
}

include "./pdo.php";
$db_file = "./restaurant.sqlite3";
PDO_Connect("sqlite:$db_file");

if (isset($_POST['menutofetch'])) {
	switch ($_POST['menutofetch']) {

		case 'starters':
			getStarters();
			break;
		case 'maincourse':
			getMainCourse();
			break;
		case 'desserts':
			getDesserts();
			break;
		case 'beverages':
			getBeverages();
			break;
		case 'chats':
			getChats();
			break;
	}
}
function getStarters(){
	$allStarters = PDO_FetchAll("SELECT * FROM starters");
	$ItemPrice = "";
	$ItemName = "";
	$desc = "";
	$completerow = "";
	$i = 1;
	$str = "<ul class=list-group >";

	echo "<table id='fetchedTable' class='table table-hover' > <tbody>";
	foreach ($allStarters as $eachItem) {
		//print_r($eachItem);
		foreach ($eachItem as $k => $var) {	
				$completerow = $completerow . "<td>". $var. "</td>";
		}
		//echo "<li  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'> <tr>". $completerow . "</tr></li>";
		echo "<tr  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'> ". $completerow . "</tr>";
		$completerow = "";
		$i++;
	}
	echo "</tbody> </table>";
// 	<li class=list-group-item>Lassi</li>
// 	<li class=list-group-item>Lime Soda </li>
// 	</ul>";
	
	//echo $str;
}

function getMainCourse(){
	$allStarters = PDO_FetchAll("SELECT * FROM maincourse");
	$ItemPrice = "";
	$ItemName = "";
	$desc = "";
	$completerow = "";
	$i = 1;
	$str = "<ul class=list-group >";
	echo "<table id='fetchedTable' class='table table-hover' > <tbody>";
	foreach ($allStarters as $eachItem) {
		foreach ($eachItem as $k => $var) {
			if(!strpos($var,'yes')|| !strpos($var,'no') ) {
				$completerow = $completerow . "<td>". $var. "</td>";
			}
		}
		echo "<tr  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'> ". $completerow . "</tr>";
		$completerow = "";
		$i++;
	}
	echo "</tbody> </table>";

}

function getDesserts(){
	$allStarters = PDO_FetchAll("SELECT * FROM desserts");
	$ItemPrice = "";
	$ItemName = "";
	$desc = "";
	$completerow = "";
	$i = 1;
	$str = "<ul class=list-group >";
	echo "<table id='fetchedTable' class='table table-hover' > <tbody>";
	foreach ($allStarters as $eachItem) {
		foreach ($eachItem as $k => $var) {
			if(!strpos($var,'yes')|| !strpos($var,'no') ) {
				$completerow = $completerow . "<td>". $var. "</td>";
			}
		}
		//echo "<li  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'>". $completerow . "</li>";
		echo "<tr  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'> ". $completerow . "</tr>";
		$completerow = "";
		$i++;
	}
	echo "</tbody> </table>";
}

function getBeverages(){
	$allStarters = PDO_FetchAll("SELECT * FROM beverages");
	$ItemPrice = "";
	$ItemName = "";
	$desc = "";
	$completerow = "";
	$i = 1;
	$str = "<ul class=list-group >";
	echo "<table id='fetchedTable' class='table table-hover' > <tbody>";

	foreach ($allStarters as $eachItem) {
		foreach ($eachItem as $k => $var) {
			if(!strpos($var,'yes')|| !strpos($var,'no') ) {
				$completerow = $completerow . "<td>". $var. "</td>";
			}
		}
		//echo "<li  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'>". $completerow . "</li>";
		echo "<tr  class=list-group-item id=".$i ." onClick='return handleAddToCart(this.id)'> ". $completerow . "</tr>";
		$completerow = "";
		$i++;
	}
	echo "</tbody> </table>";
}
?>