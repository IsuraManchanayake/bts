
function foso() {
	var name = $("#nameh").val();
	$("#gona").load('some.php?', {'name': name});
}

function test() {
	var from = $("#from").val();
	alert(from);
}