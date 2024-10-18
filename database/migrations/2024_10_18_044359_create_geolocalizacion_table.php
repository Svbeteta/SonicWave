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
        Schema::create('geolocalizacion', function (Blueprint $table) {
            $table->integer('id_geolocalizacion', true);
            $table->decimal('latitud', 9, 6);
            $table->decimal('longitud', 9, 6);
            $table->string('direccion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geolocalizacion');
    }
};
