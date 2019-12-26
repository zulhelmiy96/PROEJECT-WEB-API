<?php
    $conn = new mysqli('localhost', 'root', '', 'pizzitalia');
    
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false, 'quantity' => false, 'alias' => false);

	$custAlias = $data->alias;
	$pizzaID = $data->pizzaID;
	$pizzaPrice = $data->pizzaPrice;
    $orderQuantity = $data->quantity;
	$sql = "SELECT custAlias FROM custprofile WHERE custAlias = '$custAlias'";
	$query=$conn->query($sql);
	if($query->num_rows > 0) {
		$totalPay = $pizzaPrice * $orderQuantity;  
		 $sql = "INSERT INTO custchart (custAlias, pizzaID, quantity, totalPay) 
          	    VALUES ('$custAlias', '$pizzaID', '$orderQuantity', '$totalPay')";
		$query = $conn->query($sql);
	}
	else {
		$out['message'] = 'Alias ID does not exist!';
	}    
    echo json_encode($out);
?>