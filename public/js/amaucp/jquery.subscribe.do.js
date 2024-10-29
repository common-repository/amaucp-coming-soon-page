jQuery(document).ready(function( $ ) {
	$('.form-subscribe').submit(function(event) {
		var data = {
			action: 'amaucp_insert_subscriber',
			send_subscriber_security : amaucp.send_subscriber_security,
			email: $('input[name=email]').val()
		};
		$.ajax({
			type: 'POST',
			dataType: "json",
			url: amaucp.ajaxurl,
			data: data,
			success: function (response) { 
				
				if (response.success==true) {
					alert(response.message);
					$('#form-subscribe input').val('');
				} else 
				if (response.success==false) {
					alert(response.message);
				} 
				
				//alert(JSON.stringify(data));
				
			}
		});
		event.preventDefault();
	});
});