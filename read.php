<?php
    require 'database.php';
    $pizzaList = [];
    $sql = "SELECT pizzaID, pizzaName, pizzaPrice, pizzaStock FROM pizzamenu";
    if($result = mysqli_query($con,$sql)) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $pizzaList[$i]['pizzaID'] = $row['pizzaID'];
            $pizzaList[$i]['pizzaName'] = $row['pizzaName'];
            $pizzaList[$i]['pizzaPrice'] = $row['pizzaPrice'];
            $pizzaList[$i]['pizzaStock'] = $row['pizzaStock'];
            $i++;
        }
        echo json_encode($pizzaList);
    }
    else {
        http_response_code(404);
    }