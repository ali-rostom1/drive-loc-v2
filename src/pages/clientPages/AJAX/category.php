<?php

    require_once __DIR__."../../../../../vendor/autoload.php";
    use App\classes\database;

    $db = new database();

    if(isset($_GET["get"]) && isset($_GET["id_cat"])){
        $cat = $db->selectWhere("category","id_cat",$_GET["id_cat"]);
        echo json_encode($cat);
    }else if(isset($_GET["edit"]) && isset($_GET["id_cat"])){
        $db->update("category",["name_cat"=>$_POST["name"],"desc_cat"=>$_POST["description"],"img_url"=>$_POST["imgUrl"]],"id_cat",$_GET["id_cat"]);
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["del"]) && isset($_GET["id_cat"])){
        $db->deleteWhere("category","id_cat",$_GET["id_cat"]);
    }
?>