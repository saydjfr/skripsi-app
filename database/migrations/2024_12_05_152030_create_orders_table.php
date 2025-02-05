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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nomor_pesanan')->unique();
            $table->decimal('grand_total',10,2)->nullable();
            $table->string('payment_methode')->nullable();
            $table->string('payment_status')->nullable();
            $table->enum('status',['new','processing','completed'])->default('new');
            $table->string('currency')->nullable();
            $table->string('nama_customer');
            $table->string('telpon');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
