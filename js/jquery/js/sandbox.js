/* SELECTION */
var selected1 = $("div.module");
var selected2 = $("#myList li:nth-child(2)");
var selected3 = $("#search label");
var selected4 = $(":hidden"), count4 = selected4.size();
var selected5 = $("img[alt]"), count5 = selected5.size();
var selected6 = $("tbody tr:even"), count6 = selected5.size();
//alert(count6);


/* GO ROUND */

/* print attr 'alt' elem img */
var msg = "";
$("img").each(
	function(){
		msg += $(this).attr("alt") + "   ";
	});
alert(msg);

/* add class in parent element (form) */
$(".input_text").parent().attr('class', 'form');

/* delete class in current elem and add class in next*/
var tmp = $("#myList li.current");
tmp.removeClass('current');
tmp.next().addClass("current");

/* find(select) button submit throught elem select */
$("#specials select").parent().next().find('input.input_submit');//.text('qq');

/* select first elem in list and add class 'current', add class 'disabled' to prev, next elem */
tmp = $("#slideshow li:first");
tmp.addClass("current");
tmp.next().addClass("disabled");
tmp.prev().addClass("disabled");


/* MANIPULTIONS */

/* add new 5 elem in end marker list #myList */
$("#myList").append("<li>new1</li><li>new2</li><li>new3</li><li>new4</li><li>new5</li>");

/* delete even elements in list */
$('#myList li:even').remove();

/* add p, h2 in last div.module */
var tmp = $("div.module:last").append("<h2></h2><p>PARAGRAPH</p>"); //IN TOP - prepend

/* add in select new elem option with text 'Wednesday' */
$("select").append("<option>Wednesday</option>");

/*	add after last div.module copy of any existing img */
$("div.module:last").after('<div class="module" id="newmodule"> <h2>newMODULE</h2> </div>');
$("div.module:last").append( $("img:first").clone() );
