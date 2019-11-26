/* This file includes code for handling and displaying the menu's in the header */
$( document ).ready(function() {
	var currentEnd = 5;
	
	if($('#broadcastContainer').length!=0)
		checkBroadcastPosts();
	
	$( "#broadcastNext" ).click(function() {
		
		$.post('/broadcast/next', { date: $('#currentDateTime')[0].value }, function(data) {
		    var posts = $(data).find('#posts');
		    $('#posts').append(data);
		    currentEnd = currentEnd + 5;
		    checkBroadcastPosts();
		    
		});		
			
	});
	
	function checkBroadcastPosts(){
		$.post('/broadcast/getTotalBroadcastPosts', { date: $('#currentDateTime')[0].value },function(data) {
		    if(data>10&&data>currentEnd)
		    	$('#broadcastNext').show();
		    else
		    	$('#broadcastNext').hide();
		});			
	}
	
	
});