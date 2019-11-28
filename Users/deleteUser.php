<?php

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