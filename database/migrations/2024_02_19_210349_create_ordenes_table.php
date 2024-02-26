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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('cliente_id')->references('id')->on('personas');
            $table->boolean('cancelado');
            $table->boolean('enviado');
            $table->boolean('recibido');
            $table->string('total');
            $table->json('formaPago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
