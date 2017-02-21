
function search() {

	var from = $("#from").val();
	var to = $("#to").val();
	var date = $("#date").val();
	var at = $("#at").val();
	var type = $("#type").val();

	// from = "Mt. Lavinia";
	// to = "Katubadda";
	// date = "2016-12-25";
	// at = "08:30";
	// type = "Any";
	
	if(from == 'select' || to == 'select') {
		alert("fill location names");
	} else {

	$("#search-results").load('../PHP_Files/search.php?', 
		{
			'from' : from, 
			'to' : to,
			'at' : at,
			'date' : date,
			'type' : type
		}
	);

	/*if(from == "select" || to == "select") {
		alert("please select locations");
		return;
	}

	if(at.search("-") != -1) {
		alert("please select time");
		return;
	}*/
	}
}