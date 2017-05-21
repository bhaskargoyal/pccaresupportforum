window.onload = function() {
	var scrollImage = document.getElementById('scroll-image'); 
	if(scrollImage != undefined )
		setInterval(function() {moveImage(scrollImage) } , 50);
}

function moveImage(scrollImage) {
	scrollImage.style.position = "relative";
	var newMargin = Number(scrollImage.style.top.slice(0,-2)) + -0.5;
	if(newMargin <= -10) newMargin = 0;
	scrollImage.style.top = newMargin + "px";
}