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
        Schema::create('kittens', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name');
            $blueprint->string('price');
            $blueprint->string('old_price')->nullable();
            $blueprint->date('birth_date')->nullable();
            $blueprint->string('gender')->nullable();
            $blueprint->string('age')->nullable();
            $blueprint->string('breed_type');
            $blueprint->string('character')->nullable();
            $blueprint->text('description')->nullable();
            $blueprint->json('tags')->nullable();
            $blueprint->json('features')->nullable();
            $blueprint->string('status')->default('available');
            $blueprint->json('gallery')->nullable();
            
            // Parents block
            $blueprint->boolean('show_parents')->default(false);
            $blueprint->string('mother_name')->nullable();
            $blueprint->string('mother_breed')->nullable();
            $blueprint->string('mother_photo')->nullable();
            $blueprint->string('father_name')->nullable();
            $blueprint->string('father_breed')->nullable();
            $blueprint->string('father_photo')->nullable();
            
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kittens');
    }
};
