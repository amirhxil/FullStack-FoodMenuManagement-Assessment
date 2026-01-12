<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Food Menu
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

            <form action="{{ route('food_menus.update', $foodMenu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $foodMenu->name }}" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Type</label>
                    <select name="type" class="form-control" required>
                        <option value="food" {{ $foodMenu->type === 'food' ? 'selected' : '' }}>Food</option>
                        <option value="drink" {{ $foodMenu->type === 'drink' ? 'selected' : '' }}>Drink</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $foodMenu->description }}</textarea>
                </div>

                <div class="mb-2">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01"
                           value="{{ $foodMenu->price }}" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Current Image</label><br>
                    @if($foodMenu->image_path)
                        <img src="{{ asset('storage/'.$foodMenu->image_path) }}" width="100">
                    @else
                        No image
                    @endif
                </div>

                <div class="mb-2">
                    <label>Change Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('food_menus.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</x-app-layout>
