<?php
    $conn = new mysqli('localhost', 'root', '', 'pizzitalia');
    
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false, 'orderID' => false, 'custAlias' => false, 'psw' => false,
                 'pizzaName' => false, 'quantity' => false, 'totalPay' => false);

    $chartID = $data->orderID;
    $custAlias = $data->custAlias;
	$pizzaID = $data->pizzaName;
    $orderQuantity = $data->quantity;
    $totalPay = $data->totalPay;
    $psw = $data->psw;
	$sql = "SELECT custprofile.custAlias, custprofile.custPsw, custchart.status, pizzamenu.pizzaStock 
			FROM custprofile, custchart, pizzamenu
			WHERE custprofile.custAlias = '$custAlias' AND custprofile.custPsw = '$psw' AND custchart.status = 'PENDING ORDER' AND pizzaStock > 0";
	$query=$conn->query($sql);
	if($query->num_rows > 0) {
		$sql = "INSERT INTO orderlist (chartID, custAlias, pizzaName, orderQuantity, totalPay) 
      	        VALUES ('$chartID', '$custAlias', '$pizzaID', '$orderQuantity', '$totalPay')";
		$query = $conn->query($sql);
		$sql = "UPDATE `custchart` SET `status` = 'PENDING DELIVERY' WHERE orderID = '$chartID'";
		$query = $conn->query($sql);
	}
	else {
		$out['message'] = 'Authentication Failed!, Invalid Password!.';
	}    
    echo json_encode($out);
?>