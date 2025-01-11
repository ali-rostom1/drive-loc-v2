<?php

use App\classes\Article;
use App\classes\Comment;
use App\classes\database;

    require_once __DIR__."../../../../../../vendor/autoload.php";
    
    $db = new database;

    if(isset($_GET["get"])){
        $article = new Article($_GET["id_article"]);
        $values = ["title"=>$article->title,"img"=>base64_encode($article->img["image_data"]),"tags"=>$article->tags,"content"=>$article->content,"date"=>$article->dateCreated,"isFavorite"=>$article->isFavorite];
        $comments = [];
        foreach($article->commentIds as $commentId){
            $comment = new Comment($commentId);
            $comment = ["commentId"=> $comment->id_comment,"comment"=>$comment->content,"date"=>$comment->date,"id_user"=>$comment->id_user,"username"=>$comment->username];
            array_push($comments,$comment);
        }
        array_push($values,$comments);
        echo json_encode($values);
    }else if(isset($_GET["addComment"])){
        $comment = new Comment(0);
        $comment->content = $_POST["comment"];
        $comment->id_user = $_COOKIE["user_id"];
        $comment->id_article = $_GET["id_article"];
        $comment->addComment();
        if($comment->id_comment){
            echo json_encode(["success"=>true]);
        }
    }else if(isset($_GET["add"])){
        $article = new Article(0);
        $tagIds = explode(",",$_POST["tagIds"]);
        $img = file_get_contents($_FILES["image"]["tmp_name"]);
        $article->addArticle($_POST["title"],$_POST["id_theme"],$tagIds,$_POST["content"],$img,$_COOKIE["user_id"]);
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["favorite"])){
        $db->insert("favorite",["id_user"=>$_COOKIE["user_id"],"id_article"=>$_GET["id_article"]]);
    }else if(isset($_GET["unfavorite"])){
        $data = $db->selectWhereMultipleCondition("favorite",["id_user"=>$_COOKIE["user_id"],"id_article"=>$_GET["id_article"]]);
        $db->deleteWhere("favorite","id_fav",$data[0]["id_fav"]);
    }else if(isset($_GET["approve"])){
        $article = new Article($_GET["id_article"]);
        $article->approve();
        echo json_encode(["success"=>true]);
    }else if(isset($_GET["disapprove"])){
        $article = new Article($_GET["id_article"]);
        $article->disapprove();
        echo json_encode(["success"=>true]);
    }


?>