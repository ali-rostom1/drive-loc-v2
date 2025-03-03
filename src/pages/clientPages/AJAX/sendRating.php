<?php
    require_once __DIR__."../../../../../vendor/autoload.php";
    use App\classes\database;
    use App\classes\Rating;
    use App\classes\Vehicle;
    use App\classes\User;

    if(isset($_GET["value"]) && isset($_GET["id_vehicle"])){
        $user = new User();
        $vehicle = new Vehicle();
        $vehicle->fetchForVehicle((int)$_GET["id_vehicle"]);
        $rating = new Rating($user->getId(),(int)$vehicle->id);
        if(!$rating->value){
            $rating->addRating((int)$_GET["value"]);
        }else{
            $rating->updateValue($_GET["value"]);
        }
    }

?>