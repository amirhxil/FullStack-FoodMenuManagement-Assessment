<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;
use App\Models\FoodMenuLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodMenuApiController extends Controller
{
    public function index(Request $request){
        $query = FoodMenu::query();

        if ($request->filled('search')){
            $query->where('name','ilike','%'.$request->search.'%');
        }

        if ($request->filled('type')){
            $query->where('type',$request->type);
        }

        if ($request->filled('sort')){
            $query->orderBy('name',$request->sort=='desc'?'desc':'asc');
        } else {
            $query->orderBy('id','desc');
        }

        return $query->paginate(10);
    }

    public function show($id){
        return FoodMenu::findOrFail($id);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'type'=>'required|in:food,drink',
            'price'=>'required|numeric',
            'image'=>'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('food_images','public');
        }

        $foodMenu = FoodMenu::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'description'=>$request->description,
            'price'=>$request->price,
            'image_path'=>$imagePath,
            'created_by'=>Auth::id()
        ]);

        // Log the action
        FoodMenuLog::create([
            'user_id'=>Auth::id(),
            'food_menu_id'=>$foodMenu->id,
            'action'=>'create'
        ]);

        return response()->json($foodMenu,201);
    }

    public function update(Request $request,$id){
        $foodMenu = FoodMenu::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'type'=>'required|in:food,drink',
            'price'=>'required|numeric',
            'image'=>'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')){
            if ($foodMenu->image_path) Storage::disk('public')->delete($foodMenu->image_path);
            $foodMenu->image_path = $request->file('image')->store('food_images','public');
        }

        $foodMenu->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'description'=>$request->description,
            'price'=>$request->price,
            'image_path'=>$foodMenu->image_path
        ]);

        // Log the action
        FoodMenuLog::create([
            'user_id'=>Auth::id(),
            'food_menu_id'=>$foodMenu->id,
            'action'=>'update'
        ]);

        return response()->json($foodMenu);
    }

    public function destroy($id){
        $foodMenu = FoodMenu::findOrFail($id);
        if ($foodMenu->image_path) Storage::disk('public')->delete($foodMenu->image_path);
        $foodMenu->delete();

        // Log the action
        FoodMenuLog::create([
            'user_id'=>Auth::id(),
            'food_menu_id'=>$id,
            'action'=>'delete'
        ]);

        return response()->json(['message'=>'Deleted successfully']);
    }
}
