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
            $table->string('name', 75);
            $table->decimal('sale_price', 8, 2); //precio de venta 8 digitos de 2 decimales
            $table->integer('quantity')->default(0);//cantidad de productos existentes, por default 0
            $table->enum('status', ['Activo', 'Descontinuado'])->default('Activo'); //enum permite crear estados fijos de una tabla


            //Relacion que tiene productos con categorias
            $table->unsignedBigInteger('category_id'); //llave foranea por la relación que tiene con categorias

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //category_id hace referencia
            //al id de la tabla categorias y hace la eliminación en cascada

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
