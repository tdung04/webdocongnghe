<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Liên kết với bảng orders
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Liên kết với bảng products
            $table->integer('quantity'); // Số lượng sản phẩm trong đơn hàng
            $table->decimal('price', 10, 2); // Giá tại thời điểm mua
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
