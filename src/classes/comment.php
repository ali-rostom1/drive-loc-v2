<?php
    namespace App\classes;
    require_once __DIR__ . "../../../vendor/autoload.php";
    use App\classes\Article;
    

    class Comment extends Article{
        private $id_comment;
        private $content;
        private $date;
        private $username;

        public function __construct($id_comment){
            parent::__construct(0);
            $this->id_comment = $id_comment;
            $data = $this->selectWhere("comment","id_comment",$this->id_comment);
            if($data){
                $this->content = $data["content"];
                $this->date = $data["date"];
                $this->id_user = $data["id_user"];
                $this->username = $this->selectWhere("user","id_user",$this->id_user)["name_user"];
                $this->id_article = $data["id_article"];
            }
        }
        public function __set($attr,$value){
            if(property_exists($this,$attr)){
                $this->$attr = $value;
            }
        }
        public function __get($attr){
            if(property_exists($this,$attr)){
                return $this->$attr;
            }
        }
        public function addComment(){
            $this->id_comment = $this->insert("comment",["content"=>$this->content,"id_article"=>$this->id_article,"id_user"=>$this->id_user]);
        }
    }
    
?>