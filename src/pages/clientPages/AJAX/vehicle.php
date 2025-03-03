<?php
    require_once "../../../../vendor/autoload.php";

    use App\classes\Vehicle;


    if(isset($_GET["id_vehicle"]) && isset($_GET["edit"])){

        $vehicle = new Vehicle();
        $vehicle->fetchForVehicle($_GET["id_vehicle"]);
        $vehicle->editVehicleDb($_POST["model"],$_POST["category"],$_POST["description"],$_POST["brand"],$_POST["price"],$_POST["isAvailable"],$_POST["imgUrl"],$_POST["location"]);
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["id_vehicle"]) && isset($_GET["del"])){
        $vehicle = new Vehicle();
        $vehicle->fetchForVehicle($_GET["id_vehicle"]);
        $vehicle->removeVehicleDb();
    }else if(isset($_GET["add"])){
        $vehicle = new Vehicle();
        $vehicle->addVehicleToDb($_POST["model"],$_POST["category"],$_POST["description"],$_POST["brand"],$_POST["price"],$_POST["isAvailable"],$_POST["imgUrl"],$_POST["location"]);
        
    }
?>
