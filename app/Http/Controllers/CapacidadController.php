<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacidad;
use App\Models\Producto;

class CapacidadController extends Controller
{
    public function obtenerCapacidades()
    {
        $capacidades = Capacidad::all();
        
        return response()->json($capacidades);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $capacidad = new Capacidad();
            $capacidad->nombre = $request->input('nombre');
            $capacidad->save();

            return response()->json(['success' => true, 'message' => 'Capacidad guardada exitosamente', 'data' => $capacidad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $capacidad = Capacidad::find($id);

        if ($capacidad) {
            if ($capacidad->nombre === 'Sin capacidad') {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar la capacidad "Sin capacidad"']);
            }

            $sinCapacidad = Capacidad::where('nombre', 'Sin capacidad')->first();
            $sinCapacidadId = $sinCapacidad->id;

            Producto::where('capacidad_id', $capacidad->id)->update(['capacidad_id' => $sinCapacidadId]);

            $capacidad->delete();

            return response()->json(['success' => true, 'message' => 'Capacidad eliminada exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la capacidad']);
        }
    }

    public function asignarCapacidadSinCapacidad(Request $request)
    {
        $capacidadId = $request->input('capacidadId');
        $productos = Producto::where('capacidad_id', $capacidadId)->get();

        if ($productos->isNotEmpty()) {
            $sinCapacidad = Capacidad::where('nombre', 'Sin capacidad')->first();

            if ($sinCapacidad) {
                foreach ($productos as $producto) {
                    $producto->capacidad_id = $sinCapacidad->id;
                    $producto->save();
                }

                return response()->json(['success' => true, 'message' => 'Capacidad asignado correctamente']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró la capacidad "Sin capacidad"']);
            }
        }

        return response()->json(['success' => true, 'message' => 'No hay productos asociados a esta capacidad']);
    }
}