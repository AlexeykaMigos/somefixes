<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kittens', function (Blueprint $table) {
            $table->foreignId('litter_id')->nullable()->after('id')->constrained('litters')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kittens', function (Blueprint $table) {
            $table->dropForeign(['litter_id']);
            $table->dropColumn('litter_id');
        });
    }
};
