<?php

use App\classes\Article;
use App\classes\Comment;

    require_once __DIR__."../../../../../../vendor/autoload.php";
    


    if(isset($_GET["get"])){
        $article = new Article($_GET["id_article"]);
        $values = ["title"=>$article->title,"img"=>$article->img["image_data"],"tags"=>$article->tags,"content"=>$article->content,"date"=>$article->dateCreated];
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
    }


?>