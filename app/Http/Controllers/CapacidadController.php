<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacidad;

class CapacidadController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $capacidad = new Capacidad();
            $capacidad->nombre = $request->input('nombre');
            $capacidad->save();

            return response()->json(['success' => true, 'message' => 'Guardado exitosamente.', 'data' => $capacidad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $capacidad = Capacidad::find($id);

        if ($capacidad) {
            $capacidad->delete();
            return response()->json(['success' => true, 'message' => 'Marca eliminada exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la marca']);
        }
    }
}