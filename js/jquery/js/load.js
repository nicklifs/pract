/* LOAD EXTERNAL PAGE*/
//= !!! ONLY SERVER RUN

var i = 0;
$("#blog h3").each(
	function(){
		// create div after header(h3)
		$(this).after('<div></div>');
		
		//var div = $(this).next();
		//div.data("key",i);
		//i++;

		//debugger;
		//var tt = div.data("key");
		//alert(tt);
	}
);

/* add event click (for header h3) for load data from  data/blog.html*/
$("#blog h3").click(function () {
		/* load data (content post), post store in tage href */
		$(this).next().load( "data/blog.html "+ $(this).find('a').attr("href") );		
});
