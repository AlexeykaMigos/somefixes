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
        Schema::table('kittens', function (Blueprint $table) {
            $table->string('mother_title')->nullable()->after('show_parents');
            $table->string('father_title')->nullable()->after('mother_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kittens', function (Blueprint $table) {
            $table->dropColumn(['mother_title', 'father_title']);
        });
    }
};
