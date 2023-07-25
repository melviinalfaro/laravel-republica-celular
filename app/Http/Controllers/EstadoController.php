<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Producto;

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
            $nombreEstado = $request->input('nombre');

            $estado = Estado::firstOrCreate(['nombre' => $nombreEstado]);

            if ($estado->wasRecentlyCreated) {
                return response()->json(['success' => true, 'message' => 'Estado creado exitosamente', 'data' => $estado]);
            } else {
                return response()->json(['success' => false, 'error' => 'El estado ya existe']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $estado = Estado::find($id);

        if ($estado) {
            if ($estado->nombre === 'Sin estado') {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar el estado "Sin estado"']);
            }

            $sinEstado = Estado::where('nombre', 'Sin estado')->first();
            $sinEstadoId = $sinEstado->id;

            Producto::where('estado_id', $estado->id)->update(['estado_id' => $sinEstadoId]);

            $estado->delete();

            return response()->json(['success' => true, 'message' => 'Estado eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar el estado']);
        }
    }
    public function asignarEstadoSinEstado(Request $request)
    {
        $estadoId = $request->input('estadoId');
        $productos = Producto::where('estado_id', $estadoId)->get();

        if ($productos->isNotEmpty()) {
            $sinEstado = Estado::where('nombre', 'Sin estado')->first();

            if ($sinEstado) {
                foreach ($productos as $producto) {
                    $producto->estado_id = $sinEstado->id;
                    $producto->save();
                }

                return response()->json(['success' => true, 'message' => 'Estado asignado correctamente']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró el estado "Sin estado"']);
            }
        }

        return response()->json(['success' => true, 'message' => 'No hay productos asociados a este estado']);
    }
}