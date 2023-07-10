<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Capacidad;

class AgregarCapacidadSinCapacidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $capacidad = new Capacidad();
        $capacidad->nombre = "Sin capacidad";
        $capacidad->save();

        $sinCapacidadId = $capacidad->id;
        Schema::table('productos', function (Blueprint $table) use ($sinCapacidadId) {
            $table->unsignedBigInteger('capacidad_id')->default($sinCapacidadId)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $capacidad = Capacidad::where('nombre', 'Sin capacidad')->first();
        if ($capacidad) {
            $capacidad->delete();
        }

        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('capacidad_id')->nullable()->change();
        });
    }
}