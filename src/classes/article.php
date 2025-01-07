<?php
    namespace App\classes;
    require_once __DIR__ . "../../../vendor/autoload.php";
    use App\classes\Theme;


    class Article extends Theme{
        public $id_article;
        public $title;
        public $content;
        public $img;
        public $tags=[];
        public $comments=[];
        public $status;
        public $id_user;
        public $isFavorite;
        public $dateCreated;

        public function __construct($id){
            parent::__construct(0);
            $data = $this->selectWhere("article","id_article",$id);
            if($data){
                $this->id_article = $data["id_article"];
                $this->title = $data["title"];
                $this->content = $data["content"];
                $this->status = $data["status"];
                $this->id_user = $data["id_user"];
                $this->dateCreated = explode(" ",$data["date_created"])[0];
                parent::__construct($data["id_theme"]);
                $this->img = $this->selectWhere("image","id_img",$data["id_img"]);
                $data = $this->selectAllWhere("articlestagsdetails","id_article",$this->id_article);
                foreach($data as $tagId){
                    if($tagId["id_tag"]){
                        array_push($this->tags,$tagId["id_tag"]);
                    }
                }
                $data = $this->selectAllWhere("articlescommentdetails","id_article",$this->id_article);
                foreach($data as $commentId){
                    if($commentId["id_comment"]){
                        array_push($this->comments,$commentId["id_comment"]);
                    }
                }
                $this->isFavorite = $this->selectWhereMultipleCondition("favorite",["id_user"=>$this->id_user,"id_article"=>$this->id_article]) ? true : false;
            }
        }
        public function display(){
            
            $date = date("d-m-Y",strtotime($this->dateCreated));
            $username = $this->selectWhere("user","id_user",$this->id_user)["name_user"];
            $imgData = "data:image/png;base64,".$this->img["image_data"];
            echo '
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="'.$imgData.'" alt="SUV Article" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-blue-600 font-semibold">'.$this->name.'</span>
                        <span class="text-gray-500 text-sm">'.$date.'</span>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">'.$this->title.'</h2>
                    <p class="text-gray-600 mb-4">'.substr($this->content, 0, 80).'</p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">By '.$username.'</span>
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center">
                                <i class="fas fa-comment mr-2"></i>
                                23
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-star mr-2"></i>
                                45
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }

?>