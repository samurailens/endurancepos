<?php
//exec('mode com1: baud=9600 data=8 stop=1 parity=n xon=on');
// execute 'help mode' in command line of Windows for help

$transaction = json_decode($_POST['json']);
$string = "";
foreach ($transaction as $eachitem) {
	$str = "";
	$item_name = "";
	$item_price = "";
	$item_q = 0;	
	foreach($eachitem as $key => $val){
		if($key == "Name"){
			$item_name = $val;
		}else if($key == "Price"){
			$item_price = $val;
		}else if($key == "TypeOfOrder") {
			;
		}else if($key == "Qty"){
			$item_q = $val;
		}
		//$str = $str . $val ;
	}
	
	//echo "Name " . $item_name . " Price " . $item_price ."</br>";
	$string = $item_name . " " . $item_q ." " .$item_price . "\r\r";
	read_port($string);
}

print('{}');
//read_port();

function read_port( $string ) {
	$port='COM3:';
	 $length=17; $setmode=TRUE;
	  $simulate='';
	
	if ($simulate){
		//$buffer = '"'.strval(rand(1000, 2000));
		;//return $buffer;
	}
	if ($setmode){
		shell_exec('mode com3: baud=9600 parity=n data=8 stop=1 '); //to=on xon=off odsr=on octs=on dtr=on rts=on idsr=on
	}
	$fp = fopen($port, "rb+");
	if (!$fp) {
		file_put_contents('debug1.log','COM3: could not open'."\n",FILE_APPEND);
	} else {
		//$buffer = fgets($fp, $length); // <-- IT JUST HANGS HERE DOING NOTHING !
		//$string = "this is one line \r \r";
		fwrite($fp, $string);
		fclose ($fp);
	}

}
?>