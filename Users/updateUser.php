<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/ad-review/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");


include '../dataConfig.php';
include '../Classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

// set id to be updated
$user->id = $data->id;

$user->company_name = $data->company_name;
$user->password = $data->password;

if($user->update()) {
    echo json_encode(array("message" => "Updated user"));
} else {
    echo json_encode(array("message" => "Unable to upade user"));
}