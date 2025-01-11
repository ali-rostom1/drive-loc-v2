<?php
    require_once __DIR__ . "../../../../../vendor/autoload.php";

    use App\classes\Article;
    use App\classes\Theme;
	use App\classes\User;
	use App\classes\database;

    $user = new User();
    $user->isLoggedAsClient();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive & Blog</title>
    <link rel="stylesheet" href="../../../assets/css/input.css">
    <link rel="stylesheet" href="../../../assets/css/output.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap');
        .font-karla { font-family: 'Karla', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50 font-karla">
    <!-- Top Navigation -->
    <nav class="bg-blue-800 shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="../home.php" class="text-white font-bold text-xl">DRIVE & LOC</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-200 transition duration-300">Home</a>
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

    <!-- Header -->
    <header class="bg-white py-12 text-center">
        <h1 class="text-5xl font-bold text-gray-800 mb-4">DRIVE & BLOG</h1>
        <p class="text-xl text-gray-600">All you need to know about Vehicles</p>
    </header>

    <!-- Topics Navigation -->
    <nav class="bg-gray-100 border-t border-b">
        <div class="container mx-auto px-4">
            <div class="py-4">
                <div class="flex flex-wrap justify-center gap-4">
                    <?php
                        $db = new database();
                        $allThemes = $db->selectAll("theme");
                        foreach($allThemes as $element){
                            $theme = new Theme($element["id_theme"]);
                            $theme->display();
                        }
                    ?>    
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="grid md:grid-cols-2 gap-8">
            <?php
                $articles = $db->selectLimit("article",1,4);
                foreach($articles as $articleInstance){
                    $article = new Article($articleInstance["id_article"]);
                    $article->display();
                }
            ?>
        </div>

        <div class="text-center mt-8">
            <a href="articles.php" class="inline-block px-8 py-3 bg-blue-800 text-white rounded-lg font-bold hover:bg-blue-700 transition duration-300">
                See More Articles
            </a>
        </div>
    </main>

    <!-- Footer -->
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
</body>
</html>




