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
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->id();
            $table->integer("frecuencia_cardiaca");
            $table->integer("frecuencia_respiratoria");
            $table->integer("presion_sistolica");
            $table->integer("presion_diastolica");
            $table->decimal('temperatura', $precision = 8, $scale = 2);
            $table->foreignId('id_persona')->constrained('personas')->cascadeOnUpdate();
            $table->foreignId('id_usuario')->constrained('users')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. Saturacion
     */
    public function down(): void
    {
        Schema::dropIfExists('signos_vitales');
    }
};
