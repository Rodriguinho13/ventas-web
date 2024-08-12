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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('company', 35); //nombre de la empresa
            $table->string('contact', 75); //nombre de la persona que se tiene contacto
            $table->string('cell_phone', 18)->nullable(); //numero de contacto
            $table->string('address', 250)->nullable(); //dirección del contacto
            $table->string('email', 75)->nullable(); //dirección de correo del contacto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
