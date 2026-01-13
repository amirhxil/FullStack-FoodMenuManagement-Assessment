<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-gray-100 leading-tight flex items-center gap-2">
            🍽️ Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-0 text-gray-900 dark:text-gray-100">
                    <!-- Logged in + Date -->
                    <div class="text-lg md:text-xl font-semibold flex items-center gap-3">
                        <span>You're logged in! 🎉</span>
                        <span id="today-date" class="text-gray-500 dark:text-gray-400"></span>
                    </div>

                    <!-- Quick action buttons -->
                    <div class="flex gap-3 flex-wrap">
                        <a href="{{ route('food-menus.create') }}" class="px-5 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition transform hover:scale-105">Add New Item 🍔</a>
                        <a href="{{ route('food-menus.index') }}" class="px-5 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition transform hover:scale-105">View Menu List 🥗</a>
                    </div>
                </div>

                <!-- Content placeholder -->
                <div class="p-6 mt-6 text-gray-700 dark:text-gray-300">
                    <p class="text-lg">Here you can manage all your food menu items, view orders, and track updates!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for client date -->
    <script>
        const today = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('today-date').textContent = today.toLocaleDateString(undefined, options);
    </script>
</x-app-layout>
