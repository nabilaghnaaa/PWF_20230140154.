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
    // MEMBUAT TABEL categories
    Schema::create('categories', function (Blueprint $table) {
         // Primary key (auto increment)
        $table->id();
        // Nama category
        $table->string('name');
        // created_at & updated_at
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DROP TABEL categories jika rollback
        Schema::dropIfExists('categories');
    }
};