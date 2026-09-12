<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_request_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
            $table->string('path');
            $table->enum('type', ['customer_problem', 'technician_diagnosis', 'technician_completed'])->default('customer_problem');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_request_images');
    }
};
