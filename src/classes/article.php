<?php
    namespace App\classes;
    require_once __DIR__ . "../../../vendor/autoload.php";
    use App\classes\Theme;


    class Article extends Theme{
        protected $id_article;
        private $title;
        private $content;
        private $img;
        private $tags=[];
        private $commentIds = [];
        private $status;
        protected $id_user;
        private $isFavorite;
        private $dateCreated;

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
                foreach($data as $tag){
                    if($tag["id_tag"]){
                        $values = ["id_tag"=>$tag["id_tag"],"name"=>$tag["name"]];
                        array_push($this->tags,$values);
                    }
                }
                $data = $this->selectAllWhere("articlescommentdetails","id_article",$this->id_article);
                foreach($data as $comment){
                    if($comment["id_comment"]){
                        array_push($this->commentIds,$comment["id_comment"]);
                    }
                }
                $this->isFavorite = $this->selectWhereMultipleCondition("favorite",["id_user"=>$this->id_user,"id_article"=>$this->id_article]) ? true : false;
            }
        }
        public function __get($attr){
            if(property_exists($this,$attr)){
                return $this->$attr;
            }
        }
        public function __set($attr,$value){
            if(property_exists($this,$attr)){
                $this->$attr = $value;
            }
        }
        public function display(){
            if($this->status =="Approved"){
                $date = date("d-m-Y",strtotime($this->dateCreated));
                $username = $this->selectWhere("user","id_user",$this->id_user)["name_user"];
                $imgData = "data:image/png;base64,". base64_encode($this->img["image_data"]);
                echo '
                    <a href="articles.php" class="bg-white rounded-lg shadow-lg overflow-hidden">
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
                                    '. count($this->commentIds) .'
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                ';
            }
        }
        public function displaySecondPage(){
            if($this->status == "Approved"){
                $date = date("d-m-Y",strtotime($this->dateCreated));
                $username = $this->selectWhere("user","id_user",$this->id_user)["name_user"];
                $imgData = "data:image/jpg;base64,".base64_encode($this->img["image_data"]);
                echo '
                    <article data-id="'.$this->id_article.'" class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="'.$imgData.'" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">';
                foreach($this->tags as $tag){
                    echo '<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">'.$tag["name"].'</span>';

                }



                echo '  </div>
                        <h2 class="text-xl font-bold mb-2">'.$this->title.'</h2>
                        <p class="text-gray-600 mb-4">'.substr($this->content,0,30).'...</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                '.$username.'
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                '.$date.'
                            </span>
                        </div>
                    </div>
                </article>
                ';
            }
        }
        public function displayAdmin(){
            echo '
                    <tr class="border-t" data-id="'.$this->id_article.'">
                                <td class="px-4 py-2">'.$this->id_article.'</td>
                                <td class="px-4 py-2">'.$this->title.'</td>
                                <td class="px-4 py-2 space-x-2 flex justify-center gap-4">';
            if($this->status === "Pending"){
                echo '
                                    <button class="px-2 py-1 bg-green-500 text-white rounded approve" data-id="'.$this->id_article.'">Approve</button>
                                    <button class="px-2 py-1 bg-red-500 text-white rounded disapprove" data-id="'.$this->id_article.'">Disapprove</button>
                                </td>
                    </tr>
            ';
            }else if($this->status === "Approved"){
                echo '
                                    
                                    <button class="px-2 py-1 bg-red-500 text-white rounded disapprove" data-id="'.$this->id_article.'">Disapprove</button>
                                </td>
                    </tr>
            ';
            }else{
                echo '
                                    <button class="px-2 py-1 bg-green-500 text-white rounded approve" data-id="'.$this->id_article.'">Approve</button>
                                </td>
                    </tr>
            ';
            }
            
        }
        public function addArticle($title,$themeId,$tagsIds,$content,$img,$id_user){
            $this->title = $title;
            $this->id_theme = $themeId;
            $this->tags = $tagsIds;
            $this->content = $content;
            $id_img = $this->insert("image",["image_data"=>$img,"id_user"=>$id_user]);
            $this->img =$this->selectWhere("image","id_img",$id_img);
            $this->id_user = $id_user;
            $this->id_article = $this->insert("article",["title"=>$this->title,"content"=>$this->content,"id_user"=>$this->id_user,"id_img"=>$this->img["id_img"],"id_theme"=>$this->id_theme]);
            foreach($this->tags as $tagId){
                $this->insert("tag_article",["id_article"=>$this->id_article,"id_tag"=>$tagId]);
            }
        }
        public function editArticle($title,$themeId,$tagsIds,$content,$img,$id_user){
            $this->title = $title;
            $this->id_theme = $themeId;
            $this->tags = $tagsIds;
            $this->content = $content;
            $data = $this->selectWhere("image","img_data",$img);
            $id_img = $data ? $data : $this->insert("image",["image_data"=>$img,"id_user"=>$id_user]);
            $this->img =$this->selectWhere("image","id_img",$id_img);
            $this->id_user = $id_user;
            $this->id_article = $this->update("article",["title"=>$this->title,"content"=>$this->content,"id_user"=>$this->id_user,"id_img"=>$this->img["id_img"],"id_theme"=>$this->id_theme],"id_article",$this->id_article);
        }
        public function removeArticle(){
            $this->deleteWhere("article","id_article",$this->id_article);
        }
        public function getTotalApproved(){
            return $this->selectCountWhere("articleOrdered","1","1");
        }
        public function getTotalApprovedByTheme($id_theme){
            return $this->selectCountWhere("articleOrdered","id_theme",$id_theme);
        }
        public function approve(){
            $this->update("article",["status"=>"Approved"],"id_article",$this->id_article);
        }
        public function disapprove(){
            $this->update("article",["status"=>"Disapproved"],"id_article",$this->id_article);
        }
    }

?>