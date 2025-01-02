<?php
    require_once "../../../../vendor/autoload.php";

    use App\classes\database;
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
            
        }
?>

