<?php
    require_once __DIR__ . "../../../../../vendor/autoload.php";

    use App\classes\Article;
    use App\classes\Theme;
	use App\classes\User;
	use App\classes\database;

    $user = new User();
    $user->isLoggedAsClient();

    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else $page = 1;
    if(isset($_GET["perPage"])){
        $perpage = $_GET["perPage"];
    }else $perpage = 5;
    $article = new Article(0);
    $nb = !isset($_GET["id_theme"]) ? $article->getTotalApproved() : $article->getTotalApprovedByTheme($_GET["id_theme"]);
    $totalPages = ceil($nb/$perpage);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - Drive & Blog</title>
    <link rel="stylesheet" href="../../../assets/css/input.css">
    <link rel="stylesheet" href="../../../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-800 shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="../home.php" class="text-white font-bold text-xl">DRIVE & LOC</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="forum.php" class="text-white hover:text-blue-200 transition duration-300">Home</a>
                        <a href="articles.php" class="text-white hover:text-blue-200 transition duration-300">Articles</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="hidden md:flex bg-blue-700 rounded-lg">
                        <input type="text" placeholder="Search..." class="bg-transparent text-white px-4 py-2 focus:outline-none placeholder-blue-300">
                        <button class="px-4 text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fas fa-star"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition duration-300">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 min-h-screen">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            
            <!-- Filters -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Theme Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                    <select id="themeSelect" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">All Themes</option>
                        <?php
                        $db = new database();
                        $allThemes = $db->selectAll("theme");
                        $id_theme = isset($_GET["id_theme"]) ? $_GET["id_theme"] : 0 ;
                        foreach($allThemes as $element){
                            $theme = new Theme($element["id_theme"]);
                            $theme->displaySelect($id_theme);
                        }
                        ?>  

                    </select>
                </div>

            </div>
        </div>
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-medium">Show:</span>
                <div class="flex gap-2">
                    <?php
                        for ($i=5; $i <= 15 ; $i+=5) { 
                            $id_theme = "";
                            if(isset($_GET["id_theme"])){
                                $id_theme ='&id_theme='. $_GET["id_theme"].'';
                            }else{
                                $id_theme = "";
                            }
                            if($i==$perpage){
                                echo '<a href="?perPage='.$i.''.$id_theme.'" class="w-12 h-12 flex items-center justify-center text-white bg-blue-600 border-2 border-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-semibold transition-all duration-200">'.$i.'</a>';
                            }else{
                                echo '<a href="?perPage='.$i.''.$id_theme.'" class="w-12 h-12 flex items-center justify-center text-gray-700 border-2 rounded-lg hover:bg-blue-50 hover:border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 active:bg-blue-100 font-semibold transition-all duration-200">'.$i.'</a>';
                            }
                        }
                    ?>
                </div>
            </div>
            <button onclick="document.getElementById('createPostModal').classList.remove('hidden')" class="flex items-center gap-2 bg-blue-800 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                <i class="fas fa-plus"></i>
                Add New Article
            </button>
        </div>
        <!-- Articles Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <?php
                $db = new database();
                $articles = !isset($_GET["id_theme"]) ? $db->selectLimit("articleOrdered",$page,$perpage) : $db->selectLimitWhere("articleOrdered",$page,$perpage,"id_theme",$_GET["id_theme"]);
                
                foreach($articles as $articleInstance){
                    $article = new Article($articleInstance["id_article"]);
                    $article->displaySecondPage();
                }
            ?>

            <!-- Add more article cards as needed -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2">
            <?php
                if(isset($_GET["id_theme"])){
                    $id_theme = "&id_theme=".$_GET["id_theme"];
                }else{
                    $id_theme = "";
                }
                for ($i=1; $i <= $totalPages; $i++) { 
                    if($page == $i){
                        echo '<a class="px-4 py-2 border rounded-lg bg-blue-800 text-white">'.$i.'</a>';
                    }else{
                        echo '<a href="?page='.$i.'&perPage='.$perpage.''.$id_theme.'" class="px-4 py-2 border rounded-lg hover:bg-gray-100">'.$i.'</a>';
                    }
                }

            ?>
        </div>
    </main>
    
    <div id="createPostModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg w-full max-w-2xl">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-xl font-bold">Create New Article</h3>
            <button onclick="document.getElementById('createPostModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="p-4">
            <form id="addModal">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md " name="title">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md" name="id_theme">
                        <option value="">Select Theme</option>
                        <?php
                            $allThemes = $db->selectAll("theme");
                            foreach($allThemes as $themeInst){
                                $theme = new Theme($themeInst["id_theme"]);
                                $theme->displaySelectAdd();
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4 space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Tags</label>
                    <div class="relative">
                        <input type="text" placeholder="Search tags..." class="w-full p-2 border border-gray-300 rounded-md pr-8" id="searchTag">
                        <svg class="w-5 h-5 absolute right-2 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        
                        <div id="searchDropdown" class="absolute z-10 w-full bg-white mt-1 border border-gray-200 rounded-lg shadow-lg hidden">
                        
                        </div>
                    </div>
                    <input type="hidden" id="tagIds" name="tagIds" value="">
                    <!-- Selected Tags -->
                    <div id="selectedTags" class="flex flex-wrap gap-2">
                        
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                    <textarea rows="6" name="content" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                    <input type="file" accept="image/*" name="image" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div class="p-4 border-t flex justify-end space-x-3">
                    <button onclick="document.getElementById('createPostModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700">Publish Post</button>
                </div>
            </form>
        </div>

        
    </div>
</div>
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="bg-white w-11/12 max-w-4xl mx-auto mt-10 rounded-lg shadow-xl flex flex-col max-h-[90vh]">
            <div class="p-4 border-b flex justify-between items-center sticky top-0 bg-white z-10">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold" id="articleTitle">Article Title</h2>
                <button 
                    id="favoriteBtn" 
                    class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors group"
                >
                    <svg 
                        class="w-6 h-6 text-gray-400 group-hover:text-red-500 transition-colors" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path 
                            id="favoriteIcon"
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                        >
                        </path>
                    </svg>
                    </button>
                </div>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <div class="overflow-y-auto flex-1 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100">
                <div class="p-4 space-y-6">
                    <img id="displayImg" src="/api/placeholder/800/400" alt="Article" class="w-full h-64 object-cover rounded-lg shadow-md">
                    
                    <div class="flex gap-4 text-sm text-gray-600">
                    <span id="displayDate" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Jan 8, 2025
                    </span>
                    <span id="displayTotalComments" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        5 Comments
                    </span>
                    </div>

                    <div id="displayTags" class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">#technology</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">#web</span>
                    </div>

                    <div id="displayContent" class="prose max-w-none bg-gray-50 p-8 rounded-xl space-y-6 shadow-inner">
                    </div>  

                    <div id="displayComments" class="border-t pt-6 mt-8">
                        <h3  class="text-xl font-bold mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            Comments
                        </h3>
                        <div id="seeMoreButton" class="flex justify-center items-center hidden">
                            <button  class="px-6 py-2 mb-4 mx-auto bg-gray-200 text-blue-600 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                            See More
                            </button>
                        </div>
                        <?php

                            $shortName = strtoupper(implode("",array_map(function($element){ return $element[0];},array_slice(explode(" ",$user->username),0,2))));
                        ?>
                    <form id="commentForm" class="space-y-4 bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <span id="userShortName" class="text-blue-600 font-medium"><?php echo $shortName ?></span>
                        </div>
                        <span class="font-medium">You</span>
                        </div>
                        <textarea 
                        name="comment"
                        placeholder="Add a comment..." 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 min-h-[100px] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100"
                        ></textarea>
                        <button 
                        type="submit" 
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center gap-2"
                        >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                        Post Comment
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">DRIVE & LOC</h3>
                    <p class="mb-4">117, rue de la Pyramide<br>Casablanca, Morocco</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:text-white transition duration-300"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Vehicles</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition duration-300">SUVs</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Sedans</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Sports Cars</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Electric</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li>Phone: +212 61413 7566</li>
                        <li>Email: drive&loc@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p>&copy; 2002 - 2025 Drive & Loc. All Rights Reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition duration-300">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/15.0.6/marked.min.js" integrity="sha512-rvRITpPeEKe4hV9M8XntuXX6nuohzqdR5O3W6nhjTLwkrx0ZgBQuaK4fv5DdOWzs2IaXsGt5h0+nyp9pEuoTXg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/4.1.0/cdn.min.js" integrity="sha512-bz58Sg3BAWMEMPTH0B8+pK/+5Qfqq6b2Ho2G4ld12x4fiUVqpY8jSbN/73qpBQYFLU4QnKVL5knUm4uqcJGLVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script defer src="../../../assets/js/forum/articles.js" ></script>
</body>
</html>