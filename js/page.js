/* This file includes general page code */
	/* function to hide url bar on iphone */
	if (navigator.userAgent.indexOf('iPhone') != -1) {
		addEventListener("load", function() {
		setTimeout(hideURLbar, 0);
		}, false);
	}
	
	function hideURLbar() {
		window.scrollTo(0, 1);
	}
	 
	$( document ).ready(function() {
		$('#landscapeWarning').hide();
		
		// check to see if we are using a mobile device
		if($('#device')[0].value=='mobile'){
		
			var pageWidth = $( window ).width();
			/* function to handle what happens when the device is changes orientation */
			$( window ).resize(function() {
				var orientation='portrait';
				if($( window ).width()!=pageWidth){
					if($( window ).height()<$( window ).width())
						orientation='landscape';
					
					if(orientation=='landscape'){
						$('#wrapper').hide();
						$('#landscapeWarning').show();
					}
					else{
						$('#landscapeWarning').hide();
						$('#wrapper').show();
					}
				}
				else{
					$('#landscapeWarning').hide();
					$('#wrapper').show();
				}			
			});
			
		}
	
	});	