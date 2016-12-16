
function search() {

	var from = $("#from").val();
	var to = $("#to").val();
	var date = $("#date").val();
	var at = $("#at").val();
	var type = $("#type").val();

	if(from == "select" || to == "select") {
		alert("please select locations");
		return;
	}

	alert(at);
	if(at.search("-") != -1) {
		alert("please select time");
		return;
	}

	
}