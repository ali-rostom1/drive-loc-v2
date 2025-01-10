<?php

use App\classes\database;

    require_once __DIR__."../../../../../../vendor/autoload.php";



    $db = new database;

    if(isset($_GET["term"])){
        $term = $_GET["term"]."%";
        $tags = $db->searchTag($term);
        echo json_encode($tags);
    }
?>