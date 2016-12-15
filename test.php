<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>



function foo() {
	var name = $("#name").val();
	$("p").load('some.php?', {'name': name});
}

</script>
</head>
<body>

<h2>This is a heading</h2>

<p>This is a paragraph.</p>
<p>This is another paragraph.</p>

<input type="text" id="name">
<button id = "shit" onclick= "foo()">Click me to hide paragraphs</button>

</body>
</html>
