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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellido");
            $table->string("identificacion");
            $table->date("fecha_ingreso");
            $table->date("fecha_nacimiento");
            $table->boolean("sexo");
            $table->string("estado_civil");
            $table->string("instruccion");
            $table->string("ocupacion");
            $table->string("condicion_fisica");
            $table->string("condicion_psicologica");
            $table->string("estado_salud");
            $table->string("vino_voluntad_propia");
            $table->string("vino_voluntad_propia_especifique")->nullable();
            $table->string("recibe_algun_beneficio");
            $table->string("vive_con");
            $table->string("num_personas_vive_con");
            $table->string("nombre_personas_vive_con");
            $table->string("parentesco_vive_con");
            $table->string("calidad_relaciones");
            $table->string("calidad_relaciones_especifique")->nullable();
            $table->string("observaciones");
            $table->string("responsable1");
            $table->string("responsable2");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
