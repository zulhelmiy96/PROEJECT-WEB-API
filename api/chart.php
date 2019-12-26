<?php
	$conn = new mysqli('localhost', 'root', '', 'pizzitalia');
	
	$out = array();
	$sql = "SELECT * FROM custchart,pizzamenu WHERE custchart.pizzaID = pizzamenu.pizzaID";
	$query=$conn->query($sql);
	while($row=$query->fetch_array()){
		$out[] = $row;
	}

	echo json_encode($out);
?>