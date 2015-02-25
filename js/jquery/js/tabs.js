/* ADD NAVIGATION TABS */

/* hide all module */
$("div.module").hide();

/* create elem ul before first div.module*/
$("div.module:first").before('<ul style="list-style-type:none" id="tabModule"></ul>');

/* create elems li with text module*/
$("div.module").each(function () {
	var text = $(this).find('h2').text();
	$("#tabModule").append('<li>' + text + '</li>');
	
	/* add event click */
	var tmp = this;
	$("#tabModule li:last").click(function () {
		/* hide all modules and delete class 'current' */
		$("div.module").hide();
		$("#tabModule li").removeClass('current');
		
		/*add class 'current' and show suitable module*/
		$(this).addClass("current");
		$(tmp).show();
	});
});

/* setect first module */
$("#tabModule li:first").addClass("current");
$("div.module:first").show();