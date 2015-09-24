/**
 * 
 */

var maxRecentOrders = 3;
var currentRecentOrder = 0;


function updateRecentOrdersTab(){
	shoppingCart;
	orderType;
	TxnID;
	Total;
	var itemsordered = "";
	
	for(var product in shoppingCart){
		 itemsordered = itemsordered + shoppingCart[product].Name + ", ";
	}
	
	//first keep creating the rows and append in the end.
	//After the rows limit is reached, we will push the remove the top
	
    var orderedProductsTblBody=document.getElementById("recent-orders-table");
    
    if(currentRecentOrder <  maxRecentOrders) {
		for( ; currentRecentOrder<=maxRecentOrders ; currentRecentOrder++){
	        var row=orderedProductsTblBody.insertRow();
	        var cellName = row.insertCell(0);
	        cellName.innerHTML = ' <a href="#" class="list-group-item list-group-item-success">'+ TxnID +' - ' + itemsordered + ' - Rs ' + Total + '</a>';
	        currentRecentOrder++;
			break;
		}
    }else {
    	//orderedProductsTblBody.replaceChild(newChild, oldChild)
		orderedProductsTblBody.deleteRow(0);
		var row=orderedProductsTblBody.insertRow();
        var cellName = row.insertCell(0);
        cellName.innerHTML = ' <a href="#" class="list-group-item list-group-item-success">'+ TxnID +' - ' + itemsordered + ' - Rs ' + Total + '</a>';
    }

	
	//$("#recent-orders-table").html(' <a href="#" class="list-group-item list-group-item-success">'+ TxnID +' - ' + itemsordered + ' - Rs ' + Total + '</a>');
}