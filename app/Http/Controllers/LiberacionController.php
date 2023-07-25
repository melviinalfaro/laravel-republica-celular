<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Liberacion;
use App\Models\Producto;

class LiberacionController extends Controller
{
    public function obtenerLiberaciones()
    {
        $liberaciones = Liberacion::all();
        
        return response()->json($liberaciones);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $nombreLiberacion = $request->input('nombre');

            $liberacion = Liberacion::firstOrCreate(['nombre' => $nombreLiberacion]);

            if ($liberacion->wasRecentlyCreated) {
                return response()->json(['success' => true, 'message' => 'Liberación creada exitosamente', 'data' => $liberacion]);
            } else {
                return response()->json(['success' => false, 'error' => 'La liberación ya existe']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $liberacion = Liberacion::find($id);

        if ($liberacion) {
            if ($liberacion->nombre === 'Sin liberación') {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar la liberación "Sin liberación"']);
            }

            $sinLiberacion = Liberacion::where('nombre', 'Sin liberación')->first();
            $sinLiberacionId = $sinLiberacion->id;

            Producto::where('liberacion_id', $liberacion->id)->update(['liberacion_id' => $sinLiberacionId]);

            $liberacion->delete();

            return response()->json(['success' => true, 'message' => 'Liberación eliminada exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la liberación']);
        }
    }

    public function asignarLiberacionSinLiberacion(Request $request)
    {
        $liberacionId = $request->input('liberacionId');
        $productos = Producto::where('liberacion_id', $liberacionId)->get();

        if ($productos->isNotEmpty()) {
            $sinLiberacion = Liberacion::where('nombre', 'Sin liberación')->first();

            if ($sinLiberacion) {
                foreach ($productos as $producto) {
                    $producto->liberacion_id = $sinLiberacion->id;
                    $producto->save();
                }

                return response()->json(['success' => true, 'message' => 'Liberación asignada correctamente']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró la liberación "Sin liberación"']);
            }
        }

        return response()->json(['success' => true, 'message' => 'No hay productos asociados a esta liberación']);
    }
}
