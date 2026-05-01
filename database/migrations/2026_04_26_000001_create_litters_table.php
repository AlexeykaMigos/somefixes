<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('litters', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // "Помет А", "Litter B", etc.
            $table->date('date')->nullable();             // Expected/birth date of the litter
            $table->string('status')->default('available'); // available, upcoming
            $table->integer('sort_order')->default(0);   // display order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('litters');
    }
};
