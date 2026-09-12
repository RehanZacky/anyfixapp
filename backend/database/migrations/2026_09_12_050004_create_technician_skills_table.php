<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technician_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->unique(['technician_id', 'category_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technician_skills');
    }
};
