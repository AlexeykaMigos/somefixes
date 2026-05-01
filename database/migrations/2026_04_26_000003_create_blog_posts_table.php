<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->longText('content')->nullable();  // Rich HTML content
            $table->string('category')->default('care'); // care, food, nutrition, breeding, health
            $table->string('image_url')->nullable();     // Featured image URL
            $table->string('author_name')->default('Admin');
            $table->string('author_role')->nullable();
            $table->string('author_avatar')->nullable();
            $table->string('read_time')->default('5 min');
            $table->string('status')->default('published'); // published, draft
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
