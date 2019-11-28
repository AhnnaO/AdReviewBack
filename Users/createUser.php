<?php

include '../dataConfig.php';
include '../Classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->company_name) &&
    !empty($data->password)
) {
    $user->company_name = $data->company_name;
    $user->password = $data->password;

    if($user->create()) {
        echo "READ";
        echo json_encode(array("message" => $db->lastInsertId()));
    }
    //     // If unable to create new user
    //     else{

    //         // Set response code - 503
    //         http_response_code(503);
    //         echo "not READ";
    //         // Notify user
    //         echo json_encode(array("message" => "Unable to create new user."));
    //         }
    
    //     }
    
    // // Incomplete data
    // else{
    
    //     // Set response code - 400
    //     http_response_code(400);
    //     echo "no data";
    //     var_dump($data);
    //     // Notify user
    //     echo json_encode(array("message" => "Unable to create new user. Data is incomplete."));
    }



