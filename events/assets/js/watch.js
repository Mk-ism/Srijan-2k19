$(document).ready(function() {
	function watch() {
		// Get the time
		var now = new Date();
		var time = now.getHours() * 3600 +
					    now.getMinutes() * 60 +
					    now.getSeconds() * 1 +
					    now.getMilliseconds() / 1000;

		// Change the time into degrees
		var hours = time / 60 / 12 * 6;
		var minutes = time / 60 * 6;
		var seconds = time * 6;
		var date = now.getDate();
		  var month = now.getMonth() +1;

		// Modify classes
		$('.hour').css('transform', 'rotate(' + hours + 'deg)');
		$('.minute').css('transform', 'rotate(' + minutes + 'deg)');
		$('.second').css('transform', 'rotate(' + seconds + 'deg)');
		$('.date').html(date + '/' + month);
	}

	// Get new time every 50ms
	setInterval(watch, 50);
});