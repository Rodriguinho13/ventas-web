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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 75)->unique();
            $table->decimal('sale_price', 8, 2); // 100.50, 60.00 precio de venta
            $table->integer('quantity')->default(0); //cantidad inicial 0
            $table->enum('status', ['Activo', 'Descontinuado'])->default('Activo'); //Permite crear estados fijos de una tabla,
            //unicamente tendra esos valores de acttivo y descontinuado, campos fijos a una determinada tabla
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
