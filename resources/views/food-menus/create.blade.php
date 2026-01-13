<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-gray-100 leading-tight flex items-center gap-2">
            🍽 Add New Item
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Please fix the following errors:</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 transition-all duration-300 hover:shadow-xl">
                <form action="{{ route('food-menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">🍔 Name</label>
                        <input type="text" name="name" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100 focus:outline-none transition" placeholder="Enter food/drink name" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">🥤 Type</label>
                        <select name="type" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100 focus:outline-none transition" required>
                            <option value="food">Food</option>
                            <option value="drink">Drink</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">📝 Description</label>
                        <textarea name="description" rows="4" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100 focus:outline-none transition" placeholder="Enter a short description"></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">💰 Price</label>
                        <input type="number" name="price" step="0.01" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100 focus:outline-none transition" placeholder="0.00" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">📷 Image</label>
                        <input type="file" name="image" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100 focus:outline-none transition">
                    </div>

                    <div class="flex gap-3 mt-4">
                        <button type="submit" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                            💾 Save
                        </button>
                        <a href="{{ route('food-menus.index') }}" class="flex items-center gap-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold px-6 py-2 rounded-lg shadow-md transition">
                            ❌ Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-app-layout>
