<?php

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained();
            $table->foreignId('order_id')->constrained();

            // Thêm các trường thông tin sản phẩm và biến thể sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_img_thumb');
            $table->decimal('product_price', 15, 2); // Sử dụng decimal thay cho string cho giá tiền

            $table->string('variant_size_name');
            $table->string('variant_color_name');
            $table->integer('quantity'); // Sử dụng integer cho số lượng sản phẩm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};