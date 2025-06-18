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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('people_id');
            $table->integer('rating');
            $table->foreignId('category_id');
            $table->foreignId('cuisine_id');
            $table->foreignId(column: 'media_id');
            $table->string('description');
            $table->string('nutrition');
            $table->string('prepare_time');
            $table->string('total_time');
            $table->string('cooking_time');
            $table->string('servings');
            $table->string('steps');
            $table->string('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
