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
        Schema::table('direccionesusuario', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'direccionesusuario_ibfk_1')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_geolocalizacion'], 'direccionesusuario_ibfk_2')->references(['id_geolocalizacion'])->on('geolocalizacion')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direccionesusuario', function (Blueprint $table) {
            $table->dropForeign('direccionesusuario_ibfk_1');
            $table->dropForeign('direccionesusuario_ibfk_2');
        });
    }
};
