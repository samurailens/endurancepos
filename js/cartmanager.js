/**
 * 
 */
 var shoppingCart = [];
 var showTaxesOnceInCart = true;
 var Tax = 0;
 var Vat = 0;
 var Total = 0; 
 var TxnID = 0;
 var orderType = "";
 
 var ServiceChargePercentage = 14.5;
 var VATPercentage = 10.5;
 
 function getTaxPercentageFromDatabase(){
	 $.ajax({
			type: 'POST',
			url: 'getTaxFRomDatabase.php',
			data: { "action" : "nothing"},
			
		}).done( function( data ) {
	    console.log('done');
	    //console.log(data);
	    
	    var obj = JSON.parse(data);
	    ServiceChargePercentage = obj.servicetax ;
	    VATPercentage = obj.vat ;
	    //alert(obj.servicetax);
	    //alert(obj.vat);
	    
		})
		.fail( function( data ) {
			console.log('fail');
			console.log(data);
		});
	 
 }
 
  function handleAddToCart(id){
	
	  // alert(id);
	  //$("#"+id).css(	 "border", "3px solid red" )
	  //get the table by ID. Id defined in php     
	  var table = document.getElementById('fetchedTable');
	  // you can get total number of rows like this
	  //var rowLength = table.rows.length;
	  //Get the row, user has clicked. Since we know the Id of the row, we should compute the row from Id
	  // Id starts from 1. 
	  // so, to get 1 st row , 
	  var rowClicked = id - 1;
	  var row = table.rows[rowClicked];
	  // looping over every row.
	  //cells are accessed as easy

	  var obj = new Object();
	  /*
	  * This is how we get each cell in the row of this table. we can run a loop over each cell and then get its value. 
	  *  
	  * */
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

  }
  
  function AddtoCart(name,description,price){
      //Below we create JavaScript Object that will hold three properties you have mentioned:    Name,Description and Price
      var singleProduct = {};
      //Fill the product object with data
      singleProduct.Name=name;
      //singleProduct.Description=description;
      singleProduct.Price=price; 
      singleProduct.Qty = 1;
      //Add newly created product to our shopping cart 
	  shoppingCart = shoppingCart ||[];
	  checkIfItemExistsInCart(singleProduct);
      //call display function to show on screen
      //alert(singleProduct);
      displayShoppingCart();
	  //var $itemPrice (140) =  $("#1").attr("price");
  }  
  
  var init = true;
  function checkIfItemExistsInCart(singleProduct){
	  
	  if( containsObject(singleProduct, shoppingCart) ) {
		  for(var product in shoppingCart){
			  if( shoppingCart[product].Name == singleProduct.Name ){
				  shoppingCart[product].Qty = shoppingCart[product].Qty + 1;
				  //alert( shoppingCart[product].Qty);
			  }else {
			  }
		  }
	  }else {
		  shoppingCart.push(singleProduct);
	   }
  }
  function containsObject(obj, list) {
	    var i;
	    for (i = 0; i < list.length; i++) {
	        //alert(list[i]);
	    	if (list[i].Name === obj.Name) {
	            return true;
	        }
	    }
	    return false;
	}
  
  function displayShoppingCart(){
	  getTaxPercentageFromDatabase();
      var orderedProductsTblBody=document.getElementById("orderedProductsTblBody");
      //ensure we delete all previously added rows from ordered products table
      var tableRowCount = orderedProductsTblBody.rows.length;
      
      /*if(showTaxesOnceInCart) {
          while(orderedProductsTblBody.rows.length>0) {
              orderedProductsTblBody.deleteRow(0);
          }
      }else {
    	  //delete till the last 3 rows
    	  while((orderedProductsTblBody.rows.length-3)>0) {
              orderedProductsTblBody.deleteRow(0);
          }
      }*/
      while((orderedProductsTblBody.rows.length)>0) {
          orderedProductsTblBody.deleteRow(0);
      }
      
      //variable to hold total price of shopping cart
      var cart_total_price=0;
      //iterate over array of objects
      for(var product in shoppingCart){
          //add new row      
          var row=orderedProductsTblBody.insertRow();
          //create three cells for product properties 
          var cellName = row.insertCell(0);
          var cellDescription = row.insertCell(1);
          var cellPrice = row.insertCell(2);
          var cellSubTotal = row.insertCell(3);
          
          cellPrice.align="right";
          //fill cells with values from current product object of our array
          cellName.innerHTML = shoppingCart[product].Name;
          cellDescription.innerHTML = shoppingCart[product].Qty;
          cellPrice.innerHTML = shoppingCart[product].Price;
          var price = parseInt(shoppingCart[product].Price) * parseInt(shoppingCart[product].Qty);
          
          cellSubTotal.innerHTML = price;
          cart_total_price = cart_total_price +price;
          Tax = cart_total_price * ( ServiceChargePercentage * 0.01 );       
          //alert(Tax);
 
          Vat = (cart_total_price +Tax) * ( VATPercentage * 0.01) ;
          Total = cart_total_price +Tax +Vat; 
           //alert(Total);
      }
     showTaxes();
 	 var shoppingcartJSON = JSON.stringify(shoppingCart);
	 localStorage.setItem(LOCSTORAGE_CART_ITEMS, shoppingcartJSON);
  }
  
  function checkOutOrder(){
	  var cartJSON = localStorage.getItem(LOCSTORAGE_CART_ITEMS);
	  var cartItems = JSON.parse(cartJSON);
	  
	  if (document.getElementById('dinein-radio').checked) {
		  orderType = document.getElementById('dinein-radio').value;
		  
		  
	  }else if (document.getElementById('delivery-radio').checked){
			  orderType = document.getElementById('delivery-radio').value;
			  
			  
	  }else if (document.getElementById('pickup-radio').checked){
			  orderType = document.getElementById('pickup-radio').value;	  
	  } 
	 
	  if(orderType == ""){
		  //alert("Order type not specified");
	  }
	  
	  //we have to update the UI and show the tax details.
	  //Confirm print and order once again
	  //onConfirm, print the order and send to DB.
	  var orderedProductsTblBody=document.getElementById("orderedProductsTblBody");
	  var cart_total_price=0;
	  if(showTaxesOnceInCart ) {
		  showTaxesOnceInCart = false;
		  showTaxes();
	  }

	  
	  $("#checkoutBtn").hide();
	  $("#confirmOrderBtn").show();
	  $("#cancelOrderBtn").show();
  }
  
  function confirmOrder(){
	  TxnID = generateTxnID();
	  var shoppingcartJSON = JSON.stringify(shoppingCart);
	  //alert(shoppingcartJSON);
	  print();
	  saveTransactionToDB();
	  updateRecentOrdersTab();
	  cancelOrder(); //To clear items from Cart
  }
  
  function cancelOrder(){
	  //clear all variables and reset the cart
	  var orderedProductsTblBody=document.getElementById("orderedProductsTblBody");
      while((orderedProductsTblBody.rows.length)>0) {
          orderedProductsTblBody.deleteRow(0);
      } 
	  Tax = 0;
	  Vat = 0;
	  Total = 0;
	  TxnID = 0;
	  shoppingCart = [];
	  localStorage.removeItem(LOCSTORAGE_CART_ITEMS);
	  $("#checkoutBtn").show();
	  $("#confirmOrderBtn").hide();
	  $("#cancelOrderBtn").hide();
  }
  
  function generateTxnID() {
	//get the last transaction id from db.
	  var lastTxnID = 0;
	 if(localStorage.getItem(LOCSTORAGE_TXNID_LAST) == null ){
		 localStorage.setItem(LOCSTORAGE_TXNID_LAST, 0); 
	 }else {
		 lastTxnID = localStorage.getItem(LOCSTORAGE_TXNID_LAST );
		 lastTxnID = +lastTxnID + 1;
		 localStorage.setItem(LOCSTORAGE_TXNID_LAST, lastTxnID); 
	 }
	  
	d = new Date();
	var Txn = d.yyyymmdd();
	var strTxn = Txn.toString();
	strTxn = strTxn + lastTxnID;
	return strTxn;
  }
  
  function saveTransactionToDB(){
	  var shoppingcartJSON = JSON.stringify(shoppingCart);
	  //TODO get which checkbox is selected
	 var date = new Date().toISOString().substring(0, 10),field = document.querySelector('#date');
	 //alert(date);
	$.ajax({
		type: 'POST',
		url: 'transactionsmanager.php',
		data: {json: shoppingcartJSON, ordertype: orderType , transactionid:TxnID , totalVal:Total,date:date},
		//dataType: 'json'
	}).done( function( data ) {
    console.log('done');
    console.log(data);
	})
	.fail( function( data ) {
		console.log('fail');
		console.log(data);
	});
  }
  
  function print() {
	var shoppingcartJSON = JSON.stringify(shoppingCart);
	  //TODO get which checkbox is selected
	var date = new Date().toISOString().substring(0, 10),field = document.querySelector('#date');
	//alert(date);
	$.ajax({
		type: 'POST',
		url: 'printer.php',
		data: {json: shoppingcartJSON},
		//dataType: 'json'
	}).done( function( data ) {
    console.log('done');
    console.log(data);
	})
	.fail( function( data ) {
		console.log('fail');
		console.log(data);
	});
  }
  
  Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]); // padding
  };
  
  function showTaxes(){

	  showTaxesOnceInCart = false;
	  var orderedProductsTblBody=document.getElementById("orderedProductsTblBody");
	  var cart_total_price=0;
	  
	  var row=orderedProductsTblBody.insertRow();
	  var cellServiceCharge = row.insertCell(0);
	  cellServiceCharge.innerHTML="";
	  
	  var cellServiceChargeDescription = row.insertCell(1);
	  cellServiceChargeDescription.innerHTML="<b>Service Charge " + ServiceChargePercentage  + "%</b>";
	  
      var Tax_new = Tax.toFixed(2);
	  var cellServiceChargeValue = row.insertCell(2);
	  cellServiceChargeValue.innerHTML = Tax_new;
	  
	  //VAT
	  var row=orderedProductsTblBody.insertRow();
	  var cellVat = row.insertCell(0);
	  cellVat.innerHTML="";
	  
	  var cellVatDescription = row.insertCell(1);
	  cellVatDescription.innerHTML="<b>VAT "+VATPercentage  +"%</b>";
	  
      var Vat_new = Vat.toFixed(2); 
	  var cellVatValue = row.insertCell(2);
	  cellVatValue.innerHTML = "<b id=vatChargeValue ></b>" + Vat_new;
	  
	  //Total
	  var row=orderedProductsTblBody.insertRow();
	  var cellTotal = row.insertCell(0);
	  cellTotal.innerHTML="";
	  
	  var cellTotalDescription = row.insertCell(1);
	  cellTotalDescription.innerHTML="<b>Total </b>";
	  var GrandTotal = Total.toFixed(2);
	  var cellTotalValue = row.insertCell(2);
	  cellTotalValue.innerHTML = "<b id=totalCartValue ></b>"+ GrandTotal;
  }