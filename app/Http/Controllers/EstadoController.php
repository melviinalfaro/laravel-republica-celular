<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function obtenerEstados()
    {
        $estados = Estado::all();
        
        return response()->json($estados);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $estado = new Estado();
            $estado->nombre = $request->input('nombre');
            $estado->save();

            return response()->json(['success' => true, 'message' => 'Guardado exitosamente.', 'data' => $estado]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $estado = Estado::find($id);

        if ($estado) {
            $estado->delete();
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar el estado']);
        }
    }
}
