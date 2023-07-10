<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Categoria;

class AgregarCategoriaSinCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categoria = new Categoria();
        $categoria->nombre = "Sin categoría";
        $categoria->save();

        $sinCategoriaId = $categoria->id;
        Schema::table('productos', function (Blueprint $table) use ($sinCategoriaId) {
            $table->unsignedBigInteger('categoria_id')->default($sinCategoriaId)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $categoria = Categoria::where('nombre', 'Sin categoría')->first();
        if ($categoria) {
            $categoria->delete();
        }

        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->change();
        });
    }
}