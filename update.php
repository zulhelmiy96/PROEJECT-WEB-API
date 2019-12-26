<?php
    require 'database.php';
    // Get the posted data.
    $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        // Extract the data.
        $request = json_decode($postdata);
        // Validate.
        if ((int)$request->pizzaID < 1 || trim($request->pizzaName) == '' || (float)$request->pizzaPrice < 0 || (int)$request->pizzaStock < 1) {
            return http_response_code(400);
        }
        // Sanitize.
        $pizzaID = mysqli_real_escape_string($con, (int)$request->pizzaID);
        $pizzaName = mysqli_real_escape_string($con, trim($request->pizzaName));
        $pizzaPrice = mysqli_real_escape_string($con, (float)$request->pizzaPrice);
        $pizzaStock = mysqli_real_escape_string($con, (int)$request->pizzaStock);
        // Update.
        $sql = "UPDATE `pizzamenu` SET `pizzaName`='$pizzaName',`pizzaPrice`='$pizzaPrice', `pizzaStock`='$pizzaStock' 
        WHERE `pizzaID` = '{$pizzaID}' LIMIT 1";
        if(mysqli_query($con, $sql)) {
            http_response_code(204);
        }
        else {
            return http_response_code(422);
        }  
    }