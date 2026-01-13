<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-yellow-50 to-red-50 dark:from-gray-900 dark:to-gray-800 min-h-screen flex flex-col items-center justify-center">

    <!-- Header with login/register buttons -->
    <header class="absolute top-6 right-6 flex gap-3">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-5 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">Register</a>
                @endif
            @endauth
        @endif
    </header>

    <!-- Main content -->
    <main class="text-center p-6">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 flex items-center justify-center gap-2">
            🍔 Welcome to Food Menu Management System 🍕
        </h1>

        <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 mb-8 animate-pulse">
            Manage your food menu easily and deliciously!
        </p>

        <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-4 bg-red-500 text-white text-lg font-semibold rounded-full shadow-lg hover:bg-red-600 transition transform hover:scale-105">
            Go to Dashboard 🍽️
        </a>
    </main>

<!-- Footer animation (floating food icons) -->
<div class="fixed bottom-6 w-full flex justify-center gap-6 text-2xl">
    <span class="animate-bounce">🍔</span>
    <span class="animate-bounce delay-75">🍕</span>
    <span class="animate-bounce delay-150">🥗</span>
    <span class="animate-bounce delay-200">🍩</span>
    <span class="animate-bounce delay-300">🍣</span>
</div>


</body>
</html>
