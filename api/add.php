<?php
    $conn = new mysqli('localhost', 'root', '', 'pizzitalia');
    
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false, 'alias' => false, 'psw' => false, 'fullname' => false,
                 'phone' => false, 'address' => false);

    $alias = $data->alias;
    $psw = $data->psw;
    $fullname = $data->fullname;
    $phone = $data->phone;
    $address = $data->address;

    if(empty($alias)){
        $out['alias'] = true;
        $out['message'] = 'Alias is required'; 
    } 
    elseif(empty($psw)){
        $out['psw'] = true;
        $out['message'] = 'Password is required'; 
    }
    elseif(empty($fullname)){
        $out['fullname'] = true;
        $out['message'] = 'Fullname is required'; 
    }
    elseif(empty($phone)){
        $out['phone'] = true;
        $out['message'] = 'Mobile Phone No. is required'; 
    }
    elseif(empty($address)){
        $out['address'] = true;
        $out['message'] = 'Address is required'; 
    }
    else{
        $sql = "INSERT INTO custprofile (custAlias, custPsw, custName, phoneNo, custAddress) 
                VALUES ('$alias', '$psw', '$fullname', '$phone', '$address')";
        $query = $conn->query($sql);

        if($query){
            $out['message'] = 'Member Added Successfully';
        }
        else{
            $out['error'] = true;
            $out['message'] = 'Cannot Add Member';
        }
    }
        
    echo json_encode($out);
?>