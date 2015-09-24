/**
 * 
 */

var selectedCategory = "";
function getExistingUserFromDatabase(){
	
	 var ajaxurl = 'usermanager.php';
	 var clickBtnValue = "showexistinguserlist";
     data =  {'action': clickBtnValue };
	
	$.post(ajaxurl, data, function (response) {
		$("#existing_userlist").html(response);
	 });
	
	
}

function saveUserMods() {
	 //alert('hi');
	 var table = document.getElementById('table_for_existing_userlist');
	 var rowLength = table.rows.length; 
	 var rowClicked = 0;
	 var row = table.rows[rowClicked];
	 var cellLength = row.cells.length;
	 
	 var obj = new Object();
	 for (var i=1 ; i <rowLength ; i++ ){ 
		 row = table.rows[i];
		 for(var y=0; y<cellLength; y++){
				var cell = row.cells[y];
				if(y == 0) {
					obj.fname = String(cell.innerHTML); 
				} else if ( y == 1) {
					 obj.email  = String(cell.innerHTML);
				} 
				
		 }
		 //alert(obj.fname + obj.email);
		 updateDatabase(obj.fname, obj.email);
	 }
	
}

function updateDatabase(fname, email) {
	
	 var ajaxurl = 'usermanager.php';
	 var clickBtnValue = "updateuserDatabase";
     data =  {'action': clickBtnValue , 'fname' : fname, 'email' : email };
	
	$.post(ajaxurl, data, function (response) {
		//$("#existing_userlist").html(response);
		//Alert Success
	 });
	
}

function manageitems(str){
	//var e = document.getElementById("manage-item-category");
	//var selectedCategory = e.options[e.selectedIndex].value;
	//alert(str);
	selectedCategory = str;
	
	var ajaxurl = 'usermanager.php';
	var clickBtnValue = "showexisting_items_inDB";
    data =  {'action': clickBtnValue , 'selectedcategory':selectedCategory };
	
	$.post(ajaxurl, data, function (response) {
		$("#table-body-exisiting-items").html(response);
	 });
}

function saveNewPrices(){
	 //alert('hi');
	 var table = document.getElementById('existing_items_list_in_db');
	 var rowLength = table.rows.length; 
	 var rowClicked = 0;
	 var row = table.rows[rowClicked];
	 var cellLength = row.cells.length;
	 
	 var obj = new Object();
	 for (var i=1 ; i <rowLength ; i++ ){ 
		 row = table.rows[i];
		 for(var y=0; y<cellLength; y++){
				var cell = row.cells[y];
				if(y == 0) {
					obj.itemname = String(cell.innerHTML); 
				} else if ( y == 1) {
					 obj.itemprice  = String(cell.innerHTML);
				} 
				
		 }
		 //alert(obj.fname + obj.email);
		 //alert(obj.itemname, obj.itemprice);
		 updateDatabaseWithNewPrices(obj.itemname, obj.itemprice);
	 }
}

function updateDatabaseWithNewPrices(itemname, itemprice){
	 var ajaxurl = 'usermanager.php';
	 var clickBtnValue = "updateitemsWithNewPrices";
     data =  {'action': clickBtnValue , 'selectedcategory':selectedCategory , 'name' : itemname, 'price' : itemprice };
	
	$.post(ajaxurl, data, function (response) {
		//$("#existing_userlist").html(response);
		//Alert Success
		//alert(response);
	 });
}

function saveTaxChanges(){
	//alert('hi');
	//console.log( $("#ServiceTax").val() );
	//console.log( $("#vat").val() );
	var date1 = new Date($("#date").val());
	//console.log(date1);
	
	var ajaxurl = 'taxmanager.php';

    data =  {'servicetax':$("#ServiceTax").val() , 'vat':$("#vat").val() ,  'date':date1};
	
	$.post(ajaxurl, data, function (response) {
		//$("#table-body-exisiting-items").html(response);
	 })
	 .done(function() {
		 alert( "success" );
	 }).fail(function() {
		 alert( "error saving tax details" );
	 }) ;
}