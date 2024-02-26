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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razonSocial');
            $table->string('nombreComercial')->nullable();
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('direccion');
            $table->string('ruc');
            $table->string('email');
            $table->string('telefono');
            $table->boolean('contribuyenteEspecial');
            $table->string('numeroContribuyente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
