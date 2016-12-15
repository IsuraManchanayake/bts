
function foo() {
	var name = $("#name").val();
	$("p").load('some.php?', {'name': name});
}