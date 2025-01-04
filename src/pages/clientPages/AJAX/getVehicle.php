<?php
    require_once "../../../../vendor/autoload.php";

    use App\classes\database;
    use App\classes\Rating;
    use App\classes\User;
    use App\classes\Vehicle;

    $db = new database();

        if(isset($_GET["id_cat"])){

            
                
            $allVehicles = $db->selectAll("vehicle");
            $vehicles = [];
            foreach($allVehicles as $vehicle){
                if($vehicle["id_cat"] ==  $_GET["id_cat"]){
                        array_push($vehicles, $vehicle);
                }
            }
            echo json_encode($vehicles);
            
        }else if(isset($_GET["id_vehicle"])){
            $vehicle = new Vehicle();
            $vehicle->fetchForVehicle($_GET["id_vehicle"]);
            $user = new User();
            $rating = new Rating($user->getId(),(int)$vehicle->id);
            $data = [$vehicle,$rating];
            echo json_encode($data);
        }
?>

