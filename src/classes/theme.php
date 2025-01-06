<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    class Theme extends database{
        protected $id;
        protected $name;
        public $nbOfArticles;

        public function __construct($id){
            parent::__construct();
            $data = $this->selectWhere("theme","id_theme",$id);
            if($data){
                $this->id = $id;
                $this->name = $data["name"];
                $this->nbOfArticles = $this->selectCountWhere("article","id_theme",$this->id);
            }
        }
        public function display(){
            echo '<a href="articles.php" data-id="'.$this->id.'" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">'.$this->name.'</a>';
        }
    }


?>