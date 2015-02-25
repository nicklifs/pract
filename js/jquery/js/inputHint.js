/* CREATE HELP FOR SEARCH FIELD */

/*	get text for search, delete label*/
var label = $("#search label");
var text = label.text();
label.remove();

/* set text for search in input, add class 'hint' */
var search = $(".input_text");
search.attr('value', text);
search.addClass("hint");

/* add event focus, which delete text for search and class 'hint' */
search.focus(function() {
	$(this).removeClass('hint');
	$(this).attr('value', '');
});
/* add event blur, which backup text for search and class 'hint'*/	
search.blur(function() {
	if ($(this).text() == '')
	{
		$(this).addClass('hint');
		$(this).attr('value', text);
	}
});