/* This file includes specific code for PC dekstops */

	$( document ).ready(function() {

		// check to see if we are using a mobile device
		if($('#device')[0].value=='desktop'){
		
			var pageHeight 			= $( window ).height();
			var pageContentHeight   = pageHeight - 126;
			$(".pageContainer").height(pageContentHeight);
			$(".itemContainer").height(pageContentHeight);
			
			/* function to handle what happens when the device is changes orientation */
			$( window ).resize(function() {
				var pageHeight 			= $( window ).height();
				var pageContentHeight   = pageHeight - 126;
				$(".pageContainer").height(pageContentHeight);	
				$(".itemContainer").height(pageContentHeight);
			});
			
		}
	
	});	