jQuery(document).ready(function( $ ) {
	
	var liftoffTime = new Date(amaucp.till_year,(amaucp.till_month-1),amaucp.till_date); 
	$('#defaultCountdown2').countdown({ 
		  labels: ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'], 
		  labels1: ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'],
		until: liftoffTime, 
		format: 'DHMS', 
		onTick: watchCountdown,
		layout: '<div class="string_dl">{dl}</div><div class="string_hl">{hl}</div><div class="string_ml">{ml}</div><div class="string_sl">{sl}</div>'
	}); 
	
	function watchCountdown(periods) { 
		$('.timer_unit:nth-child(1) .text_timer').text(periods[3]); 
		$('.timer_unit:nth-child(2) .text_timer').text(periods[4]); 
		$('.timer_unit:nth-child(3) .text_timer').text(periods[5]); 
		$('.timer_unit:nth-child(4) .text_timer').text(periods[6]);	
		
		$('.timer_unit:nth-child(1) .text').text($('.string_dl').text()); 
		$('.timer_unit:nth-child(2) .text').text($('.string_hl').text()); 
		$('.timer_unit:nth-child(3) .text').text($('.string_ml').text()); 
		$('.timer_unit:nth-child(4) .text').text($('.string_sl').text()); 
		
		
	}
});