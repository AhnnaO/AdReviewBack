<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/AdReviewBack/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

include '../dataConfig.php';
include '../Classes/User.php';

$database = new Database();
$db = $database->getConnection();
$data = $_GET['company_name'];
$data2 = $_GET['password'];
$data3 = $_GET['admin'];
$data4 = $_GET['id'];
$user =  new User($db);
$user->company_name = $data;
$user->password = $data2;
$user->admin = $data3;
$user->id = $data4;
$fetchedUsers = $user->readAll();
    echo $fetchedUsers;