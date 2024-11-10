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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->enum('casos_esp',['ninguno','99001','99002','99003']);
            $table->date('fecha');
            $table->string('cod_auto')->unique();;
            $table->unsignedBigInteger('id_sucursal');
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade');
            $table->unsignedBigInteger('id_actividad');
            $table->foreign('id_actividad')->references('id')->on('actividades')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipodoc');
            $table->foreign('id_tipodoc')->references('id')->on('tipo_documentos')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
