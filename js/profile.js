/* This file includes code for handling and displaying the profile functions */

function checkContactRequestStatus(){
	
	$.post('/profile/checkContactRequestStatus', { userId: $('#userId')[0].value, profileId: $('#profileId')[0].value }, function(data) {
		
		if(data=='declined'){
			$( "#profileAddFriendPending" ).hide();
			$( "#profileRetryFriendDeclined" ).show();
		}
		else if(data=='pending'||data==''){
			setTimeout(function() {
				checkContactRequestStatus();
			}, 5000);				
		}
		
	});	
	
}

$( document ).ready(function() {
	
	$( "#profileBackButton" ).click(function() {
		history.go('-1');
	});
	
	$( "#profileAddFriend" ).click(function() {

		setTimeout(function() {
			checkContactRequestStatus();
		}, 5000);		
		
		$.post('/profile/addFriend', { userId: $('#userId')[0].value, profileId: $('#profileId')[0].value }, function(data) {
			$( "#profileAddFriend" ).hide();
			$( "#profileAddResult" ).show();
			
		});	
		
	});	

});