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
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->timestamp('buy_date'); //fecha de la compra


            //relacion con el proveedor
            $table->unsignedBigInteger('provider_id'); //id del proveedor
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

            //relacion con los usuarios
            $table->unsignedBigInteger('user_id'); //id del usuario
            $table->foreign('user_id')->references('id')->on('users'); //eliminamos unicamente el usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buys');
    }
};
