<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Food Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('food-menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Type</label>
                    <select name="type" class="form-control" required>
                        <option value="food">Food</option>
                        <option value="drink">Drink</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-2">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-success">Save</button>
                <a href="{{ route('food-menus.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</x-app-layout>
