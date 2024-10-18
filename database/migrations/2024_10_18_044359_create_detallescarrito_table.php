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
        Schema::create('detallescarrito', function (Blueprint $table) {
            $table->integer('id_detalle_carrito', true);
            $table->integer('id_carrito')->nullable()->index('id_carrito');
            $table->integer('id_producto')->nullable()->index('id_producto');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallescarrito');
    }
};
