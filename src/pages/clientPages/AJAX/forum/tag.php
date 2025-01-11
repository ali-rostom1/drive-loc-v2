<?php

use App\classes\database;

    require_once __DIR__."../../../../../../vendor/autoload.php";



    $db = new database;

    if(isset($_GET["term"])){
        $term = $_GET["term"]."%";
        $tags = $db->searchTag($term);
        echo json_encode($tags);
    }else if(isset($_GET["add"])){
        foreach($_POST["name"] as $tagName){
            if($db->insert("tag",["name"=>$tagName])){
            }
        }
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["get"])){
        $tag = $db->selectWhere("tag","id_tag",$_GET["id_tag"]);
        echo json_encode(["name"=>$tag["name"]]);
    }else if(isset($_GET["edit"])){
        $tag = $db->update("tag",["name"=>$_POST["name"]],"id_tag",$_GET["id_tag"]);
        echo json_encode(["success"=> true]);
    }else if(isset($_GET["delete"])){
        $db->deleteWhere("tag","id_tag",$_GET["id_tag"]);
        echo json_encode(["success"=>true]);
    }
    
?>