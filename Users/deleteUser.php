<?php
session_start();

// This file will not be used until Isobar moves forward with the project
// required headers
header("Access-Control-Allow-Origin: http://localhost/ad-review/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");


include '../dataConfig.php';
include '../Classes/User';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize user
$user = new User($db);

// get user id
$data = json_decode(file_get_contents("php://input"));

// set id to be deleted
$user->id = $data->id;

if($user->delete()) {
    echo json_encode(array("message" => "User deleted"));
}else {
    echo json_encode(array("message" => "Unable to delete user"));
}