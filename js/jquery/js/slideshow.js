/* CREATE SLIDESHOW */

/* move elem #slideshow to top (body) */
$('#slideshow').prependTo('body');
//$('#slideshow').attr('height','500px');

var h = $('#slideshow li').height();
$('#slideshow').height(h);

/* hide all slides, show first*/
$('#slideshow li').hide();
//$('#slideshow li:nth-child(1)').show();

/* func for next slide */
num = $('#slideshow li').size(), i = 1;
fun();
function fun() {
	$('#slideshow li:nth-child('+i+')').delay(200).fadeIn(2000); //.show()
	$('#slideshow li').delay(4000).fadeOut(2000);//.hide(); 
	
	i++;
	if (i==num+1) i=1;
}

/* each 2s show next slide */
setInterval(fun, 8000);
