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
            $table->integer('id')->autoIncrement()->comment('Llave principal del producto');
            $table->String('nombre')->comment('Nombre del producto');
            $table->integer('categoria')->comment('Categoria del producto');
            $table->foreign('categoria')->references('id')->on('categorias');
            $table->decimal('precio')->nullable()->comment('Precio del producto');
            $table->decimal('valor')->nullable()->comment('Valor del producto');
            $table->integer('stock')->nullable()->comment('Stock del producto');
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
