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
        Schema::create('buy_product', function (Blueprint $table) {
            $table->id();
            $table->decimal('buy_price', 8, 2)->default(0);//precio total de compra
            $table->integer('quantity');//cuantos productos estoy comprando

            $table->unsignedBigInteger('buy_id');
            $table->foreign('buy_id')->references('id')->on('buys')->onDelete('cascade');//tabla compras

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');//tabla productos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyproduct');
    }
};
