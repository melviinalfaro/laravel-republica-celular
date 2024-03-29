<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio');
            $table->string('color');
            $table->integer('stock');
            $table->string('imagen')->nullable();
            $table->string('descripcion');
            $table->timestamps();

            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('capacidad_id')->constrained('capacidades');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('liberacion_id')->constrained('liberaciones');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
}