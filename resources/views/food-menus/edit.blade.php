<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-gray-100 leading-tight flex items-center gap-2">
            <span>🍽️</span>
            <span>Edit Item</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('food-menus.update', $foodMenu->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-4">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" name="name" value="{{ $foodMenu->name }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100" required>
                </div>

                {{-- Type --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Type</label>
                    <select name="type" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100" required>
                        <option value="food" {{ $foodMenu->type === 'food' ? 'selected' : '' }}>🍔 Food</option>
                        <option value="drink" {{ $foodMenu->type === 'drink' ? 'selected' : '' }}>🥤 Drink</option>
                    </select>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Description</label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100">{{ $foodMenu->description }}</textarea>
                </div>

                {{-- Price --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Price (RM)</label>
                    <input type="number" name="price" step="0.01" value="{{ $foodMenu->price }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100" required>
                </div>

                {{-- Current Image --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Current Image</label>
                    @if($foodMenu->image_path)
                        <img src="{{ asset('storage/'.$foodMenu->image_path) }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                    @else
                        <span class="text-gray-500 dark:text-gray-400">No image available</span>
                    @endif
                </div>

                {{-- Change Image --}}
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-200">Change Image</label>
                    <input type="file" name="image" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:text-gray-100">
                </div>

                {{-- Buttons --}}
                <div class="flex space-x-3 mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200 flex items-center space-x-2">
                        <span>💾</span><span>Update</span>
                    </button>
                    <a href="{{ route('food-menus.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200 flex items-center space-x-2">
                        <span>❌</span><span>Cancel</span>
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
