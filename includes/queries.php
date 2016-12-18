
<?php

	function get_all_location_names() {
		$db = new DB();
		return $db->select('select townname from location order by townname');
	}

	function get_all_bus_types() {
		$db = new DB();
		return $db->select('select bustype from costperkm order by costperkm');
	}

	function get_townid($townname) {
		$db = new DB();
		$townname = $db->quote($townname);
		$result = $db->select('select townid from location where townname = '.$townname);
		$row = $result->fetch_assoc();
		return $row['townid'];
	}

	function get_townname($townid) {
		$db = new DB();
		$townid = $db->quote($townid);
		$result = $db->select('select townname from location where townid = '.$townid);
		$row = $result->fetch_assoc();
		return $row['townname'];
	}

?>