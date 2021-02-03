<?php
/* The purpose of this API is is to create a user, get the inputs as json and it is designed for POST HTTP request */
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/User.php";

$database=new Database();
$db=$database->connect();
$user= new User($db);


// set product property values
$user->username = $_POST['username'];
$user->nameAndSurname = $_POST['nameAndSurname'];
$user->address = $_POST['address'];
$user->email = $_POST['email'];
$user->password_ = $_POST['password'];
$user->phone = $_POST['phone'];

$userExists = $user->userExists();


if(!$user->userExists()) {
    // create the user
    if(
        !empty($user->username) &&
        !empty($user->nameAndSurname) &&
        !empty($user->address) &&
        !empty($user->email) &&
        !empty($user->password_) &&
        !empty($user->phone) &&
        $user->insertUser()
    ){

         $_SESSION['user'] = $user->username;

        // set response code
        http_response_code(200);



        // display message: user was created
        header("Location: http://localhost:3000/");
    }

    // message if unable to create user
    else{

        // set response code
        http_response_code(400);

        // display message: unable to create user
        echo json_encode(array("message" => "Unable to create user."));
    }

}   else {

        // set response code
        http_response_code(400);

        // display message: unable to create user
        header("Location: http://localhost/car-dealing-rest-API/api/user/registerFailed.php");
        }



?>