<?php

use App\classes\database;
use App\classes\Theme;

    require_once __DIR__."../../../../../../vendor/autoload.php";
    
    $db = new database();

    if(isset($_GET["add"])){
        $theme = new Theme(0);
        $theme->addTheme($_POST["name"],$_POST["description"]);
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["get"])){
        $theme = new Theme($_GET["id_theme"]);
        echo json_encode(["name"=>$theme->name,"description"=>$theme->description]);
    }else if(isset($_GET["edit"])){
        $theme = new Theme($_GET["id_theme"]);
        $theme->editTheme($_POST["name"],$_POST["description"]);
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["delete"])){
        $theme = new Theme($_GET["id_theme"]);
        $theme->removeTheme();
        echo json_encode(["success"=>true]);
    }


?>