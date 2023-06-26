<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Liberacion;

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
            $liberacion = new Liberacion();
            $liberacion->nombre = $request->input('nombre');
            $liberacion->save();

            return response()->json(['success' => true, 'message' => 'Guardado exitosamente.', 'data' => $liberacion]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $liberacion = Liberacion::find($id);

        if ($liberacion) {
            $liberacion->delete();
            return response()->json(['success' => true, 'message' => 'Liberación eliminada correctamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la liberación']);
        }
    }
}
