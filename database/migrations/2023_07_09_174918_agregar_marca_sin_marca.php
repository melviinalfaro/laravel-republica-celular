<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Marca;

class AgregarMarcaSinMarca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $marca = new Marca();
        $marca->nombre = "Sin marca";
        $marca->save();

        $sinMarcaId = $marca->id;
        Schema::table('productos', function (Blueprint $table) use ($sinMarcaId) {
            $table->unsignedBigInteger('marca_id')->default($sinMarcaId)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $marca = Marca::where('nombre', 'Sin marca')->first();
        if ($marca) {
            $marca->delete();
        }

        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('marca_id')->nullable()->change();
        });
    }
}