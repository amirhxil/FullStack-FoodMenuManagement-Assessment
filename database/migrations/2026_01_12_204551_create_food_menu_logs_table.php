<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('food_menu_logs', function(Blueprint $table){
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('food_menu_id')->nullable();
    $table->enum('action',['create','update','delete']);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_menu_logs');
    }
};
