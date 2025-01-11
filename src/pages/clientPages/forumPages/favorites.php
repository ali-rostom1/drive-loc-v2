<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../assets/css/output.css">
    <link rel="stylesheet" href="../../../assets/css/input.css">
    <title>Favorites</title>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Favorite Articles</h1>
            <p class="text-gray-600">Articles you've marked as favorites</p>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden bg-white rounded-xl p-8 text-center shadow-sm border-2 border-dashed border-gray-200">
            <div class="max-w-sm mx-auto space-y-4">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">No favorites yet</h3>
                <p class="text-gray-600">Start marking articles as favorites to see them here.</p>
                <button onclick="window.location.href='articles.php'" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Browse Articles
                </button>
            </div>
        </div>

        <!-- Articles Grid -->
        <div id="articlesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Article Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <img src="/api/placeholder/400/200" alt="Article" class="w-full h-48 object-cover">
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <h2 class="text-xl font-bold text-gray-900">Article Title</h2>
                        <button onclick="toggleFavorite(this)" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">#technology</span>
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">#web</span>
                    </div>

                    <p class="text-gray-600 line-clamp-3">Article preview text goes here. This is a brief description of the article content that gives readers an idea of what to expect.</p>
                    
                    <div class="flex justify-between items-center pt-4 border-t">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Jan 8, 2025
                        </div>
                        <button onclick="openArticle(1)" class="text-blue-600 hover:text-blue-700 font-medium">Read More →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>