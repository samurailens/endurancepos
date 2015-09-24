/**
 * 
 */
	function getmenuitems(menucategory){
		
	     var ajaxurl = 'getmenuitemsfromserver.php';
	     data =  {'menutofetch': menucategory };
		
	    //$("#result").html(menucategory);
		$.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            //alert("printed successfully");
					$("#result").html(response);
				
	        });
	}