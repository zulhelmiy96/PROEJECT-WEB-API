<?php
    require 'database.php';
    $orderList = [];
    $sql = "SELECT `orderID`, `chartID`, `custAlias`, `pizzaName`, `orderQuantity`, `totalPay`, `status` FROM `orderlist`";
    if($result = mysqli_query($con,$sql)) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $orderList[$i]['orderID'] = $row['orderID'];
            $orderList[$i]['chartID'] = $row['chartID'];
            $orderList[$i]['custAlias'] = $row['custAlias'];
            $orderList[$i]['pizzaName'] = $row['pizzaName'];
            $orderList[$i]['orderQuantity'] = $row['orderQuantity'];
            $orderList[$i]['totalPay'] = $row['totalPay'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }
        echo json_encode($orderList);
    }
    else {
        http_response_code(404);
    }