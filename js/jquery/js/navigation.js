/* CREATE DROP-DOWN MENU */

$("#nav li").hover(
	function () {    $(this).addClass("hover"); 	$(this).find('ul').show(); 	},
	function () {    $(this).removeClass("hover");	$(this).find('ul').hide(); 	}
);
	
//$("nav ul li").show(); 	

	/*	function () {
		alert('test');
		$(this).addClass('hover');
		//$(this).parent().next().removeClass('excerpt');
	}*/