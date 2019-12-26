<?php
	$conn = new mysqli('localhost', 'root', '', 'pizzitalia');
	
	$out = array();
	$sql = "SELECT * FROM pizzamenu";
	$query=$conn->query($sql);
	while($row=$query->fetch_array()){
		$out[] = $row;
	}

	echo json_encode($out);
?>