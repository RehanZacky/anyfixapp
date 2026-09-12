<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->onDelete('set null');
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['cash', 'bank_transfer_mock', 'e_wallet_mock'])->default('cash');
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending')->index();
            $table->string('reference')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
