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

$id = isset($_POST['vehicleid']) ? $_POST['vehicleid'] : die();

$car->vehicleID = $id;

if ($car->deleteCar()) {
    echo json_encode(
        array('message' => 'Car is deleted successfully')
    );
    header("Location: http://localhost:3000/");
}
else{
    echo json_encode(
        array('message' => 'Car is not deleted!')
    );
}

