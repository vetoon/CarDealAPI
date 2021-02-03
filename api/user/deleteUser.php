<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/User.php";



$database=new Database();
$db=$database->connect();
$user= new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;
$user->password_ = $data->password_;
$userExists = $user->userExists();

if($userExists) {
    if ($user->deleteUser()) {
        echo json_encode(
            array('message' => 'User is deleted successfully')
        );
    }
    else{
        echo json_encode(
            array('message' => 'User is not deleted!')
        );
    }} else  {
          echo json_encode(
             array('message' => 'User does not exist!')
         );
      }






?>