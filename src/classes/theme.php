<?php
    namespace App\classes;
    require_once __DIR__."../../../vendor/autoload.php";

    use App\classes\database;

    class Theme extends database{
        protected $id_theme;
        protected $name;
        protected $description;
        private $nbOfArticles;

        public function __construct($id){
            
            parent::__construct();
            $data = $this->selectWhere("theme","id_theme",$id);
            if($data){
                $this->id_theme = $id;
                $this->name = $data["name"];
                $this->description = $data["description"];
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
                return $this->$attr;
            }
        }
        public function display(){
            echo '<a href="articles.php?id_theme='.$this->id_theme.'" data-id="'.$this->id_theme.'" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-semibold transition duration-300">'.$this->name.'</a>';
        }
        public function displaySelect($id){
            $s = '';
            if($id == $this->id_theme) $s = 'selected';
            echo '<option '.$s.' class="themeSelect" value="'.$this->id_theme.'">'.$this->name.'</option>';
        }
        public function displaySelectAdd(){
            echo '<option value="'.$this->id_theme.'">'.$this->name.'</option>';
        }
        public function addTheme($name,$description){
            $this->name = $name;
            $this->description = $description;
            $this->id = $this->insert("theme",["name"=>$this->name,"description"=>$this->description]);
        }
        public function editTheme($name,$description){
            $this->update("theme",["name"=>$name,"description"=>$description],"id_theme",$this->id_theme);
        }
        public function removeTheme(){
            $this->deleteWhere("theme","id_theme",$this->id_theme);
        } 
        public function displayAdmin(){
            echo '
            <tr class="border-t" data-id="'.$this->id_theme.'">
                        <td class="px-4 py-2">'.$this->id_theme.'</td>
                        <td class="px-4 py-2">'.$this->name.'</td>
                        <td class="px-4 py-2 space-x-2 flex justify-center gap-4">
                            <button class="px-2 py-1 bg-blue-500 text-white rounded edit" data-id="'.$this->id_theme.'">Edit</button>
                            <button class="px-2 py-1 bg-red-500 text-white rounded delete" data-id="'.$this->id_theme.'">Delete</button>
                        </td>
            </tr>
            ';
        }

    }


?>