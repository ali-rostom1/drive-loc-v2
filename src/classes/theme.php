<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    class Theme extends database{
        protected $id_theme;
        protected $name;
        protected $descritpion;
        private $nbOfArticles;

        public function __construct($id){
            
            parent::__construct();
            $data = $this->selectWhere("theme","id_theme",$id);
            if($data){
                $this->id_theme = $id;
                $this->name = $data["name"];
                $this->descritpion = $data["description"];
                $this->nbOfArticles = $this->selectCountWhere("article","id_theme",$this->id_theme);
            }
        }
        public function __set($attr,$value){
            if(property_exists($this,$attr)){
                $this->$attr = $value;
            }
       }
       public function __get($attr){
            if(property_exists($this,$attr)){
                return $this->value;
            }
       }

        public function display(){
            echo '<a href="#" data-id="'.$this->id_theme.'" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-semibold transition duration-300">'.$this->name.'</a>';
        }
        public function displaySelect(){
            echo '<option value="'.$this->id_theme.'">'.$this->name.'</option>';
        }
        public function addTheme($name,$descritpion){
            $this->name = $name;
            $this->description = $descritpion;
            $this->id = $this->insert("theme",["name"=>$this->name,"description"=>$this->descritpion]);
        }
        public function editTheme($name,$descritpion){
            $this->update("theme",["name"=>$name,"description"=>$descritpion],"id_theme",$this->id_theme);
        }
        public function removeTheme(){
            $this->deleteWhere("theme","id_theme",$this->id_theme);
        }
        
    }


?>