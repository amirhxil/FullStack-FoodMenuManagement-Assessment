<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenuLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','food_menu_id','action'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function foodMenu(){
        return $this->belongsTo(FoodMenu::class,'food_menu_id');
    }
}
