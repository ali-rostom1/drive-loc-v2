<?php
    require_once "../../../../vendor/autoload.php";

use App\classes\database;
use App\classes\Reservation;


    if(isset($_GET["approve"])){
        $db = new database();
        $db->update("reservations",["status"=>"Accepted"],"id_reservation",$_GET["approve"]);
    }else if(isset($_GET["decline"])){
        $db = new database();
        $db->update("reservations",["status"=>"Declined"],"id_reservation",$_GET["decline"]);
    }else if(isset($_GET["delete"])){
        $db = new database();
        $db->deleteWhere("reservations","id_reservation",$_GET["delete"]);
    }


?>