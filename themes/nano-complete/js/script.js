jQuery(document).ready(function( $ ) {
	
	// Same Height	
	$('.col-eq').colequalizer_mod();
		
	// Animation
	$('#typed-strings').textSlider({

		timeout: 7000,
		slideTime: 2750,
		loop: 0

	});

	// Countdown
	var liftoffTime = new Date(amaucp.till_year,(amaucp.till_month-1),amaucp.till_date,amaucp.till_hour,amaucp.till_minute); 
	$('#defaultCountdown').countdown({ 
		  labels: ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'], 
		  labels1: ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'],
		until: liftoffTime, 
		format: 'DHMS', 
		onTick: watchCountdown,
		layout: '<div class="string_dl">{dl}</div><div class="string_hl">{hl}</div><div class="string_ml">{ml}</div><div class="string_sl">{sl}</div>'
	}); 
	function watchCountdown(periods) { 
		$('.timer-unit:nth-child(1) .text-timer').text(periods[3]); 
		$('.timer-unit:nth-child(2) .text-timer').text(periods[4]); 
		$('.timer-unit:nth-child(3) .text-timer').text(periods[5]); 
		$('.timer-unit:nth-child(4) .text-timer').text(periods[6]);	
		$('.timer-unit:nth-child(1) .text').text($('.string_dl').text()); 
		$('.timer-unit:nth-child(2) .text').text($('.string_hl').text()); 
		$('.timer-unit:nth-child(3) .text').text($('.string_ml').text()); 
		$('.timer-unit:nth-child(4) .text').text($('.string_sl').text()); 
	}
});