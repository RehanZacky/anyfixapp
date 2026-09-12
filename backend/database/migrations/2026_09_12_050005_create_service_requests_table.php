<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique()->index();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('technician_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null');
            
            $table->string('device_name');
            $table->string('device_brand');
            $table->string('device_model')->nullable();
            $table->text('problem_description');
            
            $table->text('address');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            $table->date('preferred_date');
            $table->string('preferred_time');
            
            $table->enum('status', [
                'pending',
                'confirmed',
                'technician_assigned',
                'technician_on_the_way',
                'diagnosing',
                'waiting_customer_approval',
                'repairing',
                'completed',
                'cancelled'
            ])->default('pending')->index();

            $table->decimal('estimated_price', 12, 2)->nullable();
            $table->decimal('final_price', 12, 2)->nullable();
            
            $table->text('customer_notes')->nullable();
            $table->text('technician_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
