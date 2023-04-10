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
            $table->date("fecha_nacimiento");
            $table->boolean("sexo");
            $table->string("diagnostico")->nullable();
            $table->string("prescripcion_medica")->nullable();
            $table->string("observacion")->nullable();
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
