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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreign(['id_carrito'], 'pedidos_ibfk_1')->references(['id_carrito'])->on('carritos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_direccion_usuario'], 'pedidos_ibfk_2')->references(['id_direccion_usuario'])->on('direccionesusuario')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_sucursal'], 'pedidos_ibfk_3')->references(['id_sucursal'])->on('sucursales')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign('pedidos_ibfk_1');
            $table->dropForeign('pedidos_ibfk_2');
            $table->dropForeign('pedidos_ibfk_3');
        });
    }
};
