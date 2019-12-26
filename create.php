<?php
    require 'database.php';
    // Get the posted data.
    $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        // Extract the data.
        $request = json_decode($postdata);
        // Validate.
        if(trim($request->pizzaName) === '' || (float)$request->pizzaPrice < 0) {
            return http_response_code(400);
        }
        // Sanitize.
        $pizzaName = mysqli_real_escape_string($con, trim($request->pizzaName));
        $pizzaPrice = mysqli_real_escape_string($con, (float)$request->pizzaPrice);
        $pizzaStock = mysqli_real_escape_string($con, (int)$request->pizzaStock);
        // Create.
        $sql = "INSERT INTO `pizzamenu`(`pizzaID`,`pizzaName`,`pizzaPrice`, `pizzaStock`) VALUES (null,'{$pizzaName}','{$pizzaPrice}', '{$pizzaStock}')";
        if(mysqli_query($con,$sql)) {
            http_response_code(201);
            $policy = [
                'pizzaName' => $pizzaName,
                'pizzaPrice' => $pizzaPrice,
                'pizzaStock' => $pizzaStock,
                'pizzaID'    => mysqli_insert_id($con)
            ];
            echo json_encode($policy);
        }
        else {
            http_response_code(422);
        }
    }