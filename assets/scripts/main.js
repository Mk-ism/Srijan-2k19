$(document).ready(function() {
    $(document).delegate('.open', 'click', function(event){
        $(this).toggleClass('oppenned');
        event.stopPropagation();
    })
    $(document).delegate('body', 'click', function(event) {
        $('.open').removeClass('oppenned');
    })

	document.getElementById('parallax-3').addEventListener('mousemove', function(event){
		document.getElementsByClassName('forest')[0].style.left = -event.clientX/25+'px';
		document.getElementsByClassName('layer-0')[0].style.left = +event.clientX/125+'px';
	});

	initialForestTranslate();
	window.addEventListener( 'resize', function(){
		initialForestTranslate();
	}, false );
});

function initialForestTranslate(){
	document.getElementsByClassName('forest')[0].style.left = -document.getElementsByClassName('forest')[0].offsetWidth/12+'px';
	document.getElementsByClassName('layer-0')[0].style.left = -document.getElementsByClassName('layer-0')[0].offsetWidth/12+'px';
}

// counter
var a = 0;
$(window).scroll(function() {

	var oTop = $('#parallax-4').offset().top - window.innerHeight/2;
	if (a == 0 && $(window).scrollTop() > oTop) {
		$('.counter-value').each(function() {
			var $this = $(this),
			countTo = $this.attr('data-count');
			$({
				countNum: $this.text()
			}).animate({
				countNum: countTo
			},
			{
				duration: 3000,
				easing: 'swing',
				step: function() {
					$this.text(Math.floor(this.countNum));
				},
				complete: function() {
					$this.text(this.countNum);
					//alert('finished');
				}
			});
		});
		a = 1;
	}

});
