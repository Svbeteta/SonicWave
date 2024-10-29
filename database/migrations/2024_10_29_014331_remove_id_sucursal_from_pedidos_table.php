<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdSucursalFromPedidosTable extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Drop the foreign key constraint by specifying its actual name
            $table->dropForeign('pedidos_ibfk_3');
            $table->dropColumn('id_sucursal');
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Re-add the column and foreign key constraint if rolling back
            $table->unsignedInteger('id_sucursal')->nullable();
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
}
