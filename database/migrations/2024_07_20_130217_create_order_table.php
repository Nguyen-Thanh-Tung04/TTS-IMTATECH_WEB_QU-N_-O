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
            $table->string('receiver_name');
            $table->string('receiver_phone')->unique();
            $table->string('receiver_address');
            $table->string('payment_method')->nullable();
            $table->decimal('paid_amount', 10, 2);
            $table->string('payment_status')->nullable();
            $table->string('shipping_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};