jQuery(document).ready(function( $ ) {
	
	var liftoffTime = new Date(2021, 4 , 18); // Launching Date. (0:January,1:Febuary,2:March,3:April,4:May etc)
	$('#defaultCountdown').countdown({ 
		  labels: ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'], 
          labels1: ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'],
		  until: liftoffTime, format: 'DHMS',
		  layout: '<div class="timer_unit timer_first"><div class="timer_circle"><div class="text_timer">{dn}</div></div><div class="text">{dl}</div></div><div class="timer_unit"><div class="timer_circle"><div class="text_timer">{hn}</div></div><div class="text">{hl}</div></div><div class="timer_unit"><div class="timer_circle"><div class="text_timer">{mn}</div></div><div class="text">{ml}</div></div><div class="timer_unit"><div class="timer_circle"><div class="text_timer">{sn}</div></div><div class="text">{sl}</div></div>'}); 
});