<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Liberacion;

class AgregarLiberacionSinLiberacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $liberacion = new Liberacion();
        $liberacion->nombre = "Sin liberación";
        $liberacion->save();

        $sinLiberacionId = $liberacion->id;
        Schema::table('productos', function (Blueprint $table) use ($sinLiberacionId) {
            $table->unsignedBigInteger('liberacion_id')->default($sinLiberacionId)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $liberacion = Liberacion::where('nombre', 'Sin liberación')->first();
        if ($liberacion) {
            $liberacion->delete();
        }

        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('liberacion_id')->nullable()->change();
        });
    }
}