<?php
    namespace App;
    require_once '../vendor/autoload.php';


    $action = $_GET["action"] ?? "home";
    switch ($action) {
        case 'getVehicle':
            include 'pages/clientPages/AJAX/getVehicle.php';
            break;
        case 'home':
            include 'pages/clientPages/home.php';
            break;
        default:
            include 'pages/clientPages/home.php';
            break;
    }
?>

