var ORDER_Type = "";
var CurrTxnIdsForDelivery = [];
var CurrTxnIDDelivery;
var currentSelectedTransaction = 0; // 0 - Dine in , 1 - Delivery , 2 - Pickup

var currentDeliveryOrder = [];
var currentDineOrder = [] ;
var currentPickUpOder = [];
//var CurrentTransactionID = 0;
//var CurrTxnIdsForDelivery = [];
var CurrTxnIdsForPickup = []
//var CurrTxnIDDelivery;
var CurrTxnIDPickup;
var ips = {}; 
var staticTxnCounterDel = 1000;
var staticTxnCounterPickup = 5000;
var pendingOrders=[];
//var ORDER_Type="";
var rowId =[];
function OrderDetails(e) {
	var clickBtnValue = e;
	 var ajaxurl = 'handleOrder.php';
        data =  {'action': clickBtnValue };
	
	$.post(ajaxurl, data, function (response) {
            // Response div goes here.
            //alert("printed successfully");
			if(clickBtnValue == "OrderDetails") {
				$("#result").html(response);
			}
        });

}
  
function TypeOrderInfo(e) {
		//alert(e);
	    var clickBtnValue = e ;//$(this).val();
		
		if( (clickBtnValue == 'Delivery') ) {
			$("#Delivery").css("background-color", "green");
			$("#DineIn").css("background-color", "");
			$("#Pickup").css("background-color", "");
			
		} else if (clickBtnValue == "Dine In") {
			$("#DineIn").css("background-color", "green");
			$("#Delivery").css("background-color", "");
			$("#Pickup").css("background-color", "");
			
			
		}else if (clickBtnValue == "Pickup") {
			$("#Pickup").css("background-color", "green");
			$("#DineIn").css("background-color", "");
			$("#Delivery").css("background-color", "");
		}
		
		ORDER_Type = clickBtnValue;
		//alert("Order Type:"+ORDER_Type);
		//var totalcartvalue = $("#id").val();
		//alert(clickBtnValue);
        var ajaxurl = 'handleOrder.php';
        data =  {'action': clickBtnValue };
	
	$.post(ajaxurl, data, function (response) {
            // Response div goes here.
            //alert("printed successfully");
			if(clickBtnValue == "Delivery") {
				$("#OrderStatus").html(response);
			}else if (clickBtnValue == "Pickup") {
				$("#OrderStatus").html(response);
			}else {
				$("#result").html(response);
			
			}
        });
	
	}

  function handleAddToCart(id){
	  // alert(id);
	  rowId.push(id);
	 $("#"+id).css(	 "border", "3px solid red" )
	  
	  //get the table by ID. Id defined in php     
	  var table = document.getElementById('starters');
	  
	  // you can get total number of rows like this
	  var rowLength = table.rows.length;
	  
	  //Get the row, user has clicked. Since we know the Id of the row, we should compute the row from Id
	  // Id starts from 1. But row elements start from 0. 
	  // so, to get 1 st row , 
	  var rowClicked = id ;
	  var row = table.rows[rowClicked];
	  // looping over every row.
	  //cells are accessed as easy

	  var jtables=[];
	  var obj = new Object();
	  /*
	  * This is how we get each cell in the row of this table. we can run a loop over each cell and then get its value. 
	  *  */
	  var rowcount=0;
	  var cellLength = row.cells.length;
	  for(var y=0; y<cellLength; y+=1){
		var cell = row.cells[y];
		if(y == 1) {
			obj.itemname = String(cell.innerHTML); //"Raj"
		} else if ( y == 2) {
			 obj.price  = String(cell.innerHTML);
		} else {
			obj.nonveg = String(cell.innerHTML);
		}
		
	  }
	  AddtoCart(obj.itemname,obj.nonveg,obj.price);
	 ITEM_Id=id;
	 ITEM_Name= obj.itemname;
	 ITEM_Price = obj.price;
	 //alert(ITEM_Id+ITEM_Name+ITEM_Price);
	
	//alert('Hi');
	//sachin - do not push to db right way. 
	//pushDataToDB(ITEM_Name,ITEM_Price);
	
	//AddNewDevileryOrderTODb(obj.itemname, obj.price);
	//pushToDB(ITEM_Name,ITEM_Price);
	/*var jsonString= JSON.stringify(obj);
	//alert(jsonString);
	  
	//Save the already clicked in JSon. Then when user clicks another item, get the already stored item, then add newly selected item to already stored item.
	// The following code has to be fixed 
	var alreadyStoredItems = localStorage.getItem("selected");
	  
	// Join two JSon arrays http://stackoverflow.com/questions/433627/concat-json-objects
	if(typeof alreadyStoredItems !== 'undefined') {
		var finalobj={};
		for(var _obj in alreadyStoredItems) finalobj[_obj ]=alreadyStoredItems[_obj];
		for(var _obj in jsonString) finalobj[_obj ]=jsonString[_obj];

		//var finalObj = $.extend(alreadyStoredItems, jsonString);
		localStorage.setItem("selected", finalObj);
		 //alert('alreadyStoredItems ' + finalObj);
	} else {
		localStorage.setItem("selected", jsonString);
		// alert(jsonString);
	} */
  }
/*function dineDelvPick() {
	var buttonClicked = $(this).val(); // this will contain  the value of the buttion that is clicked
	// <button value="MyButton" > Button1< /button>, it will contain MyButton
	if( (clickBtnValue == "Delivery") ) {
			$(this).css("background-color", "green");
			$("#dine").css("background-color", "");
			$("#pickup").css("background-color", "");
			
		} else if (clickBtnValue == "Dine In") {
			$(this).css("background-color", "green");
			$("#delivery").css("background-color", "");
			$("#pickup").css("background-color", "");
			
			
		}else if (clickBtnValue == "Pickup") {
			$(this).css("background-color", "green");
			$("#dine").css("background-color", "");
			$("#delivery").css("background-color", "");
		}
		
	var ajaxurl = 'handleOrder.php';
    data =  {'action': clickBtnValue };
	
	//Handle the css calls for each button 
	/*$(this).css("background-color", "green");
			$("#dine").css("background-color", "");
			$("#pickup").css("background-color", "");
	*/
//}

function setCurrTxnIDsForDelivery(txnID) {
	//CurrTxnIdForDelivery [  1, 2, 3 ..]
	//CurrTxnIDDelivery = txnID;
	CurrentTransactionID = txnID;
	CurrTxnIdsForDelivery.push(CurrentTransactionID);
	//CurrentTransactionID = CurrTxnIDDelivery;
	return CurrentTransactionID;
}

function setCurrTxnIDsForPickup(txnID) {
	//CurrTxnIdForDelivery [  1, 2, 3 ..]
	//CurrTxnIDDelivery = txnID;
	CurrentTransactionID = txnID;
	CurrTxnIdsForPickup.push(CurrentTransactionID);
	//CurrentTransactionID = CurrTxnIDDelivery;
	return CurrentTransactionID;
}

function showPickupPendingOrders(){
	//pendingOrders.push(CurrTxnIdsForDelivery);
	pendingOrders=CurrTxnIdsForPickup;
	alert(pendingOrders);
}
function showDeliveryPendingOrders(){
	//pendingOrders.push(CurrTxnIdsForDelivery);
	pendingOrders=CurrTxnIdsForDelivery;
	alert(pendingOrders);
}





function setCurrTxnIDsForPickup ( txnID) {
	//CurrTxnIdForDelivery [  1, 2, 3 ..]
	CurrTxnIDPickup = txnID;
	CurrTxnIdsForPickup.push(CurrTxnIDPickup);
	CurrentTransactionID = txnID;
	//document.getElementById("Tid").innerHTML=CurrentTransactionID;
}

function getCurrTxnForDelivery() {
	return CurrTxnIDDelivery ;
}

function getCurrTxnForPickup() {
	return CurrTxnIDPickup ;
}

function setcurrentSelectedTransaction(i){
	currentSelectedTransaction = i;
	ORDER_Type = currentSelectedTransaction;
}

function getcurrentSelectedTransaction() { 
	return currentSelectedTransaction;
}
function getCurrentDeliveryOrder () {
	return currentDeliveryOrder;
}

function getCurrentPickupOrder () {
	return currentPickUpOder;
}

function setItemToCurrentDeliveryOrder (item, price) {
	
	//currentDeliveryOrder
	var currentDeliveryTxnID = 123;
    if (!currentDeliveryOrder[currentDeliveryTxnID]) currentDeliveryOrder[currentDeliveryTxnID] = {};
    var entries = currentDeliveryOrder[currentDeliveryTxnID];
    // you could add a check to ensure the name-value par's not already defined here
    //var entries[item] = price;

}
var strshoppingCart;
function onLoadFunc() {
	//alert("OnLoadFunc");
	var shoppingcartJSON = localStorage.getItem("2");
	strshoppingCart = JSON.parse(shoppingcartJSON);
	displayShoppingCart();
}

function fkey(e){
        e = e || window.event;
       if( wasPressed ) return; 

        if (e.keyCode == 116) {
            //alert("f5 pressed");
            saveCart();
        }else {
            //alert("Window closed");
        }
 }

function generateNewTxnID(e){
	var clickvalue = e;
	//alert(clickvalue);
	 if ( clickvalue == 'newDelOrders') {
		 var TxnType = "Delivery";
		 var TxnID = staticTxnCounterDel;
		 staticTxnCounterDel+= 1;
		 setcurrentSelectedTransaction("Delivery");
		 
		 //CurrentTransactionID =
		 setCurrTxnIDsForDelivery(TxnID);
		 //alert(TxnID);
		 //alert(CurrentTransactionID + ORDER_Type );
		 //return CurrentTransactionID;
	 }
	 else if ( clickvalue == 'newPickupOrders' ) {
		 var TxnType = "Pickup";
		 //alert(staticTxnCounterPickup);
		 var TxnID = staticTxnCounterPickup;
		 staticTxnCounterPickup+= 1;
		 setcurrentSelectedTransaction("Pickup");
		 
		 setCurrTxnIDsForPickup(TxnID);
		 //alert(CurrentTransactionID);
		 //return TxnID;
		 //CurrentTransactionID = CurrTxnIDPickup;
		 //document.getElementById(CTxnID).html(CurrentTransactionID);
	 }
	document.getElementById("CurrentTXnID").innerHTML=CurrentTransactionID;
 }
 
function checkOut() {
	$("#"+rowId).css(	 "border", "none" )
	var orderedProductsTblBody=document.getElementById("orderedProductsTblBody");
	//ensure we delete all previously added rows from ordered products table
	while(orderedProductsTblBody.rows.length>0) {
		orderedProductsTblBody.deleteRow(0);
		document.getElementById("cart_total").innerHTML=0;
		strshoppingCart = "";
	}
	document.getElementById("result").innerHTML="";
	onCheckoutPushToDatabase();
	//alert(shoppingCart);
	shoppingCart.splice(0);
	resetOrderParamsOnCheckout();
	
	//while(cart_total.rows.length=0) {
	//cart_total.deleteRow(0);
	//}
	//cart_total_price=0;
	//Delete the total amount also.
	//Delete all the variables that we used for current transaction
	// put all the variables to null here
	
	
	//Fire a print for the bill 
	//Do not implement this. We have code ready for this to integrate.
}



function pushDataToDB(name,price){
	//var clickBtnValue = $(this).val();
	var clickBtnValue = "Checkout";
	//alert(clickBtnValue);
	var ajaxurl = 'handleOrder.php';
	var item_id = ITEM_Id;
	var item_name = name;
	var item_price = price;
	var order_type = ORDER_Type;
	var tID = CurrentTransactionID;
	//alert(ITEM_Id+name+price+RDER_Type+urrentTransactionID);
	 data =  {'actionnew': clickBtnValue,'id':item_id,'Item_name':item_name,'Item_price':item_price,'Order_type':order_type,'txnId':tID};
	 $.post(ajaxurl, data, function (response) {
		 //alert(response);
	});
	 
	
}
 
function onCheckoutPushToDatabase(){
	  for(var product in shoppingCart){
            var name = shoppingCart[product].Name;
            var price = parseInt(shoppingCart[product].Price);
            pushDataToDB(name,price);
        }
  }
  
function resetOrderParamsOnCheckout() {
	var ORDER_Type = "";
	var CurrTxnIdsForDelivery = [];
	var CurrTxnIDDelivery = 0;
	var currentSelectedTransaction = 0; // 0 - Dine in , 1 - Delivery , 2 - Pickup

	var currentDeliveryOrder = [];
	var currentDineOrder = [] ;
	var currentPickUpOder = [];
	//var CurrentTransactionID = 0;
	//var CurrTxnIdsForDelivery = [];
	var CurrTxnIdsForPickup = []
	//var CurrTxnIDDelivery;
	var CurrTxnIDPickup= 0;
	var ips = {}; 
	//var staticTxnCounterDel = 1000;
	//var staticTxnCounterPickup = 5000;
	var pendingOrders=[];
	
}