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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_pcontribuyente');
            $table->string('desc_pcontribuyente');
            $table->integer('precio');
            $table->unsignedBigInteger('actividad_id');
                $table->foreign('actividad_id')->references('id')->on('actividades');
            $table->unsignedBigInteger('unidad_id');
                $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
