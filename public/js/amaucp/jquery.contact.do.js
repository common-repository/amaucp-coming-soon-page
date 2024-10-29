jQuery(document).ready(function( $ ) {
	$('#form-contact').submit(function(event) {
		var data = {
			action: 'amaucp_send_contact',
			send_contact_security : amaucp.send_contact_security,
			name: $('#form-contact input[name=name]').val(),
			email: $('#form-contact input[name=email]').val(),
			message: $('#form-contact textarea').val()			
			
		};
		$.ajax({
			type: 'POST',
			dataType: "json",
			url: amaucp.ajaxurl,
			data: data,
			success: function (response) { 
				
				if (response.success==true) {
					alert(response.message);
					$('#form-contact input').val('');
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