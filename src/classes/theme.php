<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    class Theme extends database{
        protected $id_theme;
        protected $name;
        public $nbOfArticles;

        public function __construct($id){
            
            parent::__construct();
            $data = $this->selectWhere("theme","id_theme",$id);
            if($data){
                $this->id_theme = $id;
                $this->name = $data["name"];
                $this->nbOfArticles = $this->selectCountWhere("article","id_theme",$this->id_theme);
            }
        }
        public function display(){
            echo '<a href="#" data-id="'.$this->id_theme.'" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-semibold transition duration-300">'.$this->name.'</a>';
        }
        public function displaySelect(){
            echo '<option value="'.$this->id_theme.'">'.$this->name.'</option>';
        }
    }


?>