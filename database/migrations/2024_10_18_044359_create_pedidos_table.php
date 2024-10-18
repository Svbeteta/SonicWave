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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->integer('id_pedido', true);
            $table->integer('id_carrito')->nullable()->index('id_carrito');
            $table->timestamp('fecha_transaccion')->useCurrent();
            $table->integer('id_direccion_usuario')->nullable()->index('id_direccion_usuario');
            $table->integer('id_sucursal')->nullable()->index('id_sucursal');
            $table->decimal('total', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
