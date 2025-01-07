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
                    <a href="#" class="text-white font-bold text-xl">DRIVE & LOC</a>
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

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            
            <!-- Filters -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Theme Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">All Themes</option>
                        <?php
                        $db = new database();
                        $allThemes = $db->selectAll("theme");
                        foreach($allThemes as $element){
                            $theme = new Theme($element["id_theme"]);
                            $theme->displaySelect();
                        }
                        ?>  

                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm hover:bg-blue-200">
                            Performance
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Luxury
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Economy
                        </button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            Safety
                        </button>
                    </div>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="popular">Most Popular</option>
                        <option value="comments">Most Commented</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-8">
            <button onclick="location.href='add-article.php'" class="flex items-center gap-2 bg-blue-800 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                <i class="fas fa-plus"></i>
                Add New Article
            </button>
        </div>
        <!-- Articles Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <?php
                $db = new database();
                $articles = $db->selectAll("article");
                foreach($articles as $articleInstance){
                    $article = new Article($articleInstance["id_article"]);
                    $article->displaySecondPage();
                }
            ?>

            <!-- Article Card 2 -->
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="/api/placeholder/800/400" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Electric</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Performance</span>
                    </div>
                    <h2 class="text-xl font-bold mb-2">Future of Electric Sports Cars</h2>
                    <p class="text-gray-600 mb-4">Exploring the latest innovations in electric vehicle performance...</p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Jane Smith
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            Jan 4, 2025
                        </span>
                    </div>
                </div>
            </article>

            <!-- Add more article cards as needed -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2">
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100 disabled:opacity-50">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-4 py-2 border rounded-lg bg-blue-800 text-white">1</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">2</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">3</button>
            <span class="px-4 py-2">...</span>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">10</button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </main>

    <!-- Footer (same as previous) -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <!-- ... (keeping previous footer code) ... -->
    </footer>
</body>
</html>