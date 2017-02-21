
function filter() {
	var wifi = document.getElementById('wificheck').checked;
	var curtain = document.getElementById('curtaincheck').checked;
	var priceub = document.getElementById('priceub').value;
	var timethresh = document.getElementById('timethreshold').value;
	var bustype = getRadioValue('bustyperadio');
	var from = $("#from").val();
	var to = $("#to").val();
	var date = $("#date").val();
	var at = $("#at").val();
	//from = "Mt. Lavinia";
	//to = "Katubadda";
	//date = "2016-12-16";
	//at = "09:30";
	//type = "Any";


	$("#ss").load('../PHP_Files/filterfunction.php?', 
	{
		'from' : from, 
		'to' : to,
		'at' : at,
		'date' : date,
		'wifi' : wifi, 
		'curtain' : curtain,
		'priceub' : priceub,
		'timethresh' : timethresh,
		'bustype' : bustype
	}
	);

	function getRadioValue(theRadioGroup) {
		var elements = document.getElementsByName(theRadioGroup);
		for (var i = 0, l = elements.length; i < l; i++) {
			if (elements[i].checked) {
				return elements[i].value;
			}
		}
	} 
}