<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $database=new Database();
    $db=$database->connect();

    $car= new Car($db);
    $car->make=isset($_GET['make']);
    $car->model=isset($_GET['model']);
    $car->price=isset($_GET['price']);
    $car->date_=isset($_GET['registration']);
    $car->vehicleID=isset($_GET['id']);
    if($car->vehicleID){
        $result=$database->getConn()->query($car->getSpecific($_GET['id']));
    }
    else if($car->make && $car->model && $car->price && $car->date_){
        $result=$database->getConn()->query($car->getWithDetails($_GET['make'],$_GET['model'],$_GET['price'],$_GET['registration']));
    }
    else if($car->make && $car->model){
        $result=$database->getConn()->query($car->getMakeAndModel($_GET['make'],$_GET['model']));
    }
    else if($car->make){
        $result=$database->getConn()->query($car->getMake($_GET['make']));
    }else{
        $result=$database->getConn()->query($car->getAll());
    }
    $num=$database->getConn()->query($car->rowCount());
    $row=$num->fetch(PDO::FETCH_BOTH);
    $cars_total=$row['total'];
    if($cars_total>0){
        $cars_arr=array();
        $cars_arr['data']=array();
        $cars_arr['total']=$cars_total;
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $car_item=array(
                'vehicleID'=>$vehicleID,
                'make'=>$make,
                'model'=>$model,
                'description'=>$description_,
                'fuel'=>$fuel,
                'image'=>$image,
                'price'=>$price,
                'power'=>$power_,
                'mileage'=>$mileage,
                'date'=>$date_,
                'username'=>$username,
            );
            array_push($cars_arr['data'],$car_item);
        }
        echo json_encode($cars_arr,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    else{
        echo json_encode(array('message'=>'not found',JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }