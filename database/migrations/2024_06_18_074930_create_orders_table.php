<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Đảm bảo rằng cột user_id có kiểu dữ liệu phù hợp
            $table->unsignedBigInteger('user_id'); 
            $table->string('status')->default('pending');
            $table->decimal('total', 10, 2);
            $table->string('payment_method')->nullable();
            $table->string('address');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            // Định nghĩa khóa ngoại với users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
