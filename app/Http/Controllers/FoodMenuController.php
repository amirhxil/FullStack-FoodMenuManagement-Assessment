<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodMenuController extends Controller
{

    public function index(Request $request) {
        $query = FoodMenu::query();

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%'.$request->search.'%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort == 'desc' ? 'desc' : 'asc');
        }

        $foodMenus = $query->paginate(10);

        return view('food-menus.index', compact('foodMenus'));
    }

    public function create() {
        return view('food-menus.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:food,drink',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('food_images','public');
        }

        FoodMenu::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('food-menus.index')->with('success','Food menu added!');
    }

    public function edit($id) {
        $foodMenu = FoodMenu::findOrFail($id);
        return view('food-menus.edit', compact('foodMenu'));
    }

    public function update(Request $request, $id) {
        $foodMenu = FoodMenu::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'type' => 'required|in:food,drink',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($foodMenu->image_path) Storage::disk('public')->delete($foodMenu->image_path);
            $foodMenu->image_path = $request->file('image')->store('food_images','public');
        }

        $foodMenu->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $foodMenu->image_path,
        ]);

        return redirect()->route('food-menus.index')->with('success','Food menu updated!');
    }

public function getData(Request $request)
{
    // 1️⃣ Base query (NO filters)
    $baseQuery = FoodMenu::query();

    $recordsTotal = $baseQuery->count();

    // 2️⃣ Filtered query
    $query = FoodMenu::query();

    if ($request->filled('searchName')) {
        $query->where('name', 'ilike', '%' . $request->searchName . '%');
    }

    if ($request->filled('filterType')) {
        $query->where('type', $request->filterType);
    }

    if ($request->filled('sortName')) {
        $query->orderBy('name', $request->sortName);
    } else {
        $query->orderBy('id', 'desc');
    }

    $recordsFiltered = $query->count();

    // 3️⃣ Pagination
    $start = $request->input('start', 0);
    $length = $request->input('length', 10);

    $data = $query
        ->skip($start)
        ->take($length)
        ->get();

    // 4️⃣ Response EXACT format DataTables needs
    return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'data' => $data
    ]);
}




    public function destroy($id) {
        $foodMenu = FoodMenu::findOrFail($id);
        if ($foodMenu->image_path) Storage::disk('public')->delete($foodMenu->image_path);
        $foodMenu->delete();
        return redirect()->route('food-menus.index')->with('success','Food menu deleted!');
    }
}
