document.body.addEventListener('mousemove', function(event){
	document.getElementsByClassName('forest')[0].style.left = -event.clientX/25+'px';
	document.getElementsByClassName('layer-0')[0].style.left = +event.clientX/125+'px';
});

initialForestTranslate();
window.addEventListener( 'resize', function(){
	initialForestTranslate();
}, false );

function initialForestTranslate(){
	document.getElementsByClassName('forest')[0].style.left = -document.getElementsByClassName('forest')[0].offsetWidth/12+'px';
	document.getElementsByClassName('layer-0')[0].style.left = -document.getElementsByClassName('layer-0')[0].offsetWidth/12+'px';
}
