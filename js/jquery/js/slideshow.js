/* CREATE SLIDESHOW */

/* renove elem #slideshow to top (body) */
$('#slideshow').prependTo('body');
//$('#slideshow').attr('height','500px');

/* hide all slides, show first*/
$('#slideshow li').hide();
$('#slideshow li:nth-child(1)').show();

/* func for next slide */
num = $('#slideshow li').size(), i = 2;
function fun() {
	
	$('#slideshow li').hide(); 
	//$('#slideshow li:nth-child('+i+')').animate({width:'toggle'},350);
	$('#slideshow li:nth-child('+i+')').show();
	i++;
	if (i==num+1) i=1;
}

//$("#slideshow").animate({width:'toggle'},350);

/* each 2s show next slide */
setInterval(fun, 5000);