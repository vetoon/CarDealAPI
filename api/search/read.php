<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Car.php';

$database=new Database();
$db=$database->connect();

$car= new Car($db);
$car->make=isset($_GET['make']);

if($car->make) {
    $result = $database->getConn()->query($car->getOnlyModel($_GET['make']));

    $num = $database->getConn()->query($car->rowCount());
    $row = $num->fetch(PDO::FETCH_BOTH);
    $cars_total = $row['total'];
    if ($cars_total > 0) {
        $cars_arr = array();
        $cars_arr['data'] = array();
        $cars_arr['total'] = $cars_total;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $car_item = array(
                'model' => $model,
            );
            array_push($cars_arr['data'], $car_item);
        }
        echo json_encode($cars_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(array('message' => 'not found', JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
else{
    $result=$database->getConn()->query($car->getOnlyMake());
    $num = $database->getConn()->query($car->rowCount());
    $row = $num->fetch(PDO::FETCH_BOTH);
    $cars_total = $row['total'];
    if ($cars_total > 0) {
        $cars_arr = array();
        $cars_arr['data'] = array();
        $cars_arr['total'] = $cars_total;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $car_item = array(
                'make' => $make,
            );
            array_push($cars_arr['data'], $car_item);
        }
        echo json_encode($cars_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(array('message' => 'not found', JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}