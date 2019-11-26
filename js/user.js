/* This file includes code for handling and displaying the user alerts and information */

function checkContactRequests() {
	userAlertActive = 0;
	
	$.post('/user/checkContactRequests', { userId: $('#userId')[0].value }, function(data) {
		if(data!=''){
		    $('#userMessageContainer').append(data);
		    $('#userMessageContainer').show();

		    userAlertActive = 1;

			$('#userAlertContactDecline').on( "click", function() {
				
				$.post('/user/declineContactRequest', { contactRequestId: $('#contactRequestId')[0].value }, function(data) {
					$('#userMessageContainer').html(data);

					$('#userAlertContactDismiss').on( "click", function() {
						
						$('#userMessageContainer').hide();
						userAlertActive = 0;
						
						setTimeout(function() {
							checkContactRequests();
						}, 60000);	
						
					});							
					
					setTimeout(function() {
						checkContactRequests();
					}, 60000);							

				});					
				
			});	
			

			$('#userAlertContactAccept').on( "click", function() {
				
				$.post('/user/acceptContactRequest', { contactRequestId: $('#contactRequestId')[0].value }, function(data) {
					$('#userMessageContainer').html(data);

					$('#userAlertContactDismiss').on( "click", function() {
						
						$('#userMessageContainer').hide();
						userAlertActive = 0;
						
						setTimeout(function() {
							checkContactRequests();
						}, 60000);	
						
					});							
					
					setTimeout(function() {
						checkContactRequests();
					}, 60000);							

				});	
				
			});				
			
			setTimeout(function() {
				fadeOutAlert();
			}, 60000);			    
		    
		}
		else{
			
			setTimeout(function() {
				checkContactRequests();
			}, 60000);
			
		}
		
	});		
		
}	

function fadeOutAlert(){
	if(userAlertActive){
		$('#userMessageContainer').fadeTo( "slow", 0 );
	}

	setTimeout(function() {
		checkContactRequests();
	}, 60000);	
	
	
}

$( document ).ready(function() {
	
	var userAlertActive = 0;
	
	$( "#contactRemove" ).click(function() {
		
		$.post('/contacts/AJAXConfirmRemoveRequest/', { userId: $('#userId')[0].value, contactId: $('#contactId')[0].value }, function(data) {
			$('#userMessageContainer').html(data);
			$('#userMessageContainer').show();
			
		    userAlertActive = 1;

			$('#userAlertRemoveDecline').on( "click", function() {
				
				$('#userMessageContainer').hide();
				userAlertActive = 0;
				
				setTimeout(function() {
					checkContactRequests();
				}, 60000);	
				
			});	
			

			$('#userAlertRemoveAccept').on( "click", function() {
				
				$.post('contacts/AJAXContactRemove', { contactId: $('#contactId')[0].value }, function(data) {
					$('#userMessageContainer').html(data);

					$('#userAlertContactDismiss').on( "click", function() {
						
						$('#userMessageContainer').hide();
						userAlertActive = 0;
						
						setTimeout(function() {
							checkContactRequests();
						}, 60000);	
						
					});							
					
					setTimeout(function() {
						checkContactRequests();
					}, 60000);							

				});	
				
			});				
			
			setTimeout(function() {
				fadeOutAlert();
			}, 60000);		
			
		});	
		
	});	
	
	checkContactRequests();
	
	setTimeout(function() {
		checkContactRequests();
	}, 60000);

	
});