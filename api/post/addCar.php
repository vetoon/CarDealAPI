<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Car.php';

$database=new Database();
$db=$database->connect();
$car= new Car($db);

$vehicleid = $_POST['vehicleid'];
$make = $_POST['make'];
$model = $_POST['model'];
$description = $_POST['description'];
$fuel = $_POST['fuel'];
$image = $_POST['image'];
$price = $_POST['price'];
$power = $_POST['power'];
$mileage = $_POST['mileage'];
$date = $_POST['date'];
$username = $_POST['username'];

$car->vehicleID = $vehicleid;
$car->make = $make;
$car->model = $model;
$car->description_ = $description;
$car->fuel = $fuel;
$car->image = $image;
$car->price = $price;
$car->power_ = $power;
$car->mileage = $mileage;
$car->date_ = $date;
$car->username = $username;

if ($car->insert_or_update("INSERT")) {
    header("Location: http://localhost/car-dealing-rest-API/api/post/isAddedMessage.php");
}
else{
    header("Location: http://localhost/car-dealing-rest-API/api/post/isAddedMessageError.php");
}
