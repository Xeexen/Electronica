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
        Schema::create('orden_compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->references('id')->on('productos');
            $table->string('cantidad');
            $table->string('descuento');
            $table->string('subtotal');
            $table->foreignId('ordenCompra_id')->references('id')->on('orden_compras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_compra_detalles');
    }
};
