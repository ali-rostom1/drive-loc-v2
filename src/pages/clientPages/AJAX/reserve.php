<?php
    require_once "../../../../vendor/autoload.php";

    use App\classes\Reservation;

    

        if(isset($_GET["id_vehicle"])){
            $reservation = new Reservation(0);
            $reservation->addReservation($_POST["reservationDate"],(int)$_COOKIE["user_id"],(int)$_GET["id_vehicle"]);
            echo json_encode(["success"=>true]);
        }
        if(isset($_GET["id_res"]) && !isset($_GET["del"])){
            $reservation = new Reservation($_GET["id_res"]);
            $reservation->updateReservation($_POST["reservationDate"]);
            echo json_encode(["success"=>true]);
        }
        if(isset($_GET["id_res"]) && isset($_GET["del"])){
            $reservation = new Reservation($_GET["id_res"]);
            $reservation->deleteReservation();
            echo json_encode(["success"=>true]);
        }
?>
