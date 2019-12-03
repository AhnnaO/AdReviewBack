<?php

include '../dataConfig.php';
include '../Classes/User.php';

$database = new Database();
$db = $database->getConnection();
$data = $_GET['id'];
$user =  new User($db);
$user->id = $data;
$fetchedCompany = $user->read();
echo ($fetchedCompany);


// $stmt = $user->read();

// $num = $stmt->rowCount();

// if($num > 0) {
//     // Users array
//     $users_arr = [];
//     $users_arr["user"]=array();
    
//     // Retrieve user_registration table data
//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//         extract($row);

//         $user_object = array(
//             "id" => $id,
//             "company_name" => $company_name,           
//             "password" => $password
//         );

//         array_push($users_arr["user"], $user_object);
//     }

//     // Set response - 200
//     http_response_code(200);
    
//     // Data in json format
//     echo json_encode($users_arr);
// }
// else {
//     // Set response - 404
//     http_response_code(200);
    
//     // Notify user no users
//     echo json_encode(array("message" => "No users found."));
// }
