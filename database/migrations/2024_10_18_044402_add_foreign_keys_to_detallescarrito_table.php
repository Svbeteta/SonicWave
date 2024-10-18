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
        Schema::table('detallescarrito', function (Blueprint $table) {
            $table->foreign(['id_carrito'], 'detallescarrito_ibfk_1')->references(['id_carrito'])->on('carritos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_producto'], 'detallescarrito_ibfk_2')->references(['id_producto'])->on('productos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detallescarrito', function (Blueprint $table) {
            $table->dropForeign('detallescarrito_ibfk_1');
            $table->dropForeign('detallescarrito_ibfk_2');
        });
    }
};
