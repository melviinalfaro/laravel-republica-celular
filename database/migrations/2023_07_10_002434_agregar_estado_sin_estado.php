<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Estado;

class AgregarEstadoSinEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $estado = new Estado();
        $estado->nombre = "Sin estado";
        $estado->save();

        $sinEstadoId = $estado->id;
        Schema::table('productos', function (Blueprint $table) use ($sinEstadoId) {
            $table->unsignedBigInteger('estado_id')->default($sinEstadoId)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $estado = Estado::where('nombre', 'Sin estado')->first();
        if ($estado) {
            $estado->delete();
        }

        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id')->nullable()->change();
        });
    }
}