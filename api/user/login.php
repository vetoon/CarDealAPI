<?php
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


//set username and password values;
$user->username = $_POST['username'];
$user->password_ = $_POST['password'];



if(!empty($user->username) &&
   !empty($user->password_) && $user->userExists())
{

       $_SESSION['user'] = $user->username;
     // set response code
     http_response_code(200);

    //header("Location:index.php");

     // display message: login was successful
       // echo json_encode(array("message" => "Login was successful."));
        //echo 'Hi, ' . $_SESSION["user"];
        header("Location: http://localhost:3000/");

 }

 // message if unable to login
 else{

     // set response code
     http_response_code(400);

     //header("Location:login.php");

     // display message: login failed
     //echo json_encode(array("message" => "Login failed."));
     //echo 'Hi, ' . $_SESSION["user"];

     header("Location: http://localhost:3000/login");


 }





?>
