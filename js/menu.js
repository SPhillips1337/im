/* This file includes code for handling and displaying the menu's in the header */
$( document ).ready(function() {
	
	var menuState = 0;
	var settingsState = 0;
	
// Handler for .ready() called.
	
	$("html").click(function(e) {
		console.log(e);
		if(e.target.id==""||(e.target.id!="menuMenu"&&e.target.id!="menuSettings")){
			$( "#settingsContainer" ).hide();
			settingsState = 0;
			$( "#menuContainer" ).hide();
			menuState = 0;				
		}
			
	});	
	
	$( "#menu" ).click(function() {
		if(menuState==0){
			$( "#menuContainer" ).show();
			menuState = 1;
			$( "#settingsContainer" ).hide();
			settingsState = 0;
		}
		else{
			$( "#menuContainer" ).hide();
			menuState = 0;	
		}
	});
	
	$( "#settings" ).click(function() {
		if(settingsState==0){
			$( "#settingsContainer" ).show();
			settingsState = 1;
			$( "#menuContainer" ).hide();
			menuState = 0;	
		}
		else{
			$( "#settingsContainer" ).hide();
			settingsState = 0;
		}
			
	});
});