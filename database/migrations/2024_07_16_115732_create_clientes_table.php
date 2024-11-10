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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social'); // Asegúrate de que esta columna esté incluida
            $table->string('nit'); // Asegúrate de que esta columna esté incluida
            $table->string('complemento')->nullable(); // Agrega esta línea para incluir la columna complemento
            $table->timestamps();
            $table->string('email');
            $table->integer('celular');
            $table->integer('telefono')->nullable();
            $table->unsignedBigInteger('tipodoc_id');
            $table->foreign('tipodoc_id')->references('id')->on('tipo_documentos');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
