/* LOAD CONTENT USE JSON*/
//= !!! ONLY SERVER RUN

// add div after form
$("#specials form").after('<div id="result"></div>');

// delete button "submit" from form
$( ".buttons" ).remove();

// add event change element for select
$( "select" ).change(function() {
	$( "select option:selected" ).each(function() {
		//get text form select and convert to lower case
		var text = $(this).text().toLowerCase() ;
		$.getJSON( "data/specials.json", function( data ) {
			// clear result div
			$("#result").html("");
			
			//find data
			for(var obj in data) {
				//if found data
				if (obj === text) {
					//for DENVER (img src	../jquery )		ELSE USE NEXT LINE
					var result = result = data[obj].title + " <br>" + data[obj].text + "<br><img src='../jquery" + data[obj].image + "'><br> " + data[obj].color;
					//var result = result = data[obj].title + " <br>" + data[obj].text + "<br><img src='" + data[obj].image + "'><br> " + data[obj].color;
					$("#result").html(result);
					break;
				}
			}
		});
	});
});


