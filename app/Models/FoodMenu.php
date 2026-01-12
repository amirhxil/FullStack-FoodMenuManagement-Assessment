<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'food_menus';

    protected $fillable = [
        'name', 'type', 'description', 'price', 'image_path', 'created_by'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
