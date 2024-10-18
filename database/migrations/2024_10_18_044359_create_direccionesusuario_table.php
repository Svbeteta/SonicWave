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
        Schema::create('direccionesusuario', function (Blueprint $table) {
            $table->integer('id_direccion_usuario', true);
            $table->unsignedBigInteger('id_usuario')->nullable()->index('id_usuario');
            $table->integer('id_geolocalizacion')->nullable()->index('id_geolocalizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccionesusuario');
    }
};
