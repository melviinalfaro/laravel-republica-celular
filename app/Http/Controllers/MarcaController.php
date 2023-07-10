<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Producto;

class MarcaController extends Controller
{   
    public function obtenerMarcas()
    {
        $marcas = Marca::all();
        
        return response()->json($marcas);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $marca = new Marca();
            $marca->nombre = $request->input('nombre');
            $marca->save();

            return response()->json(['success' => true, 'message' => 'Guardado exitosamente.', 'data' => $marca]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $marca = Marca::find($id);

        if ($marca) {
            if ($marca->nombre === 'Sin marca') {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar la marca "Sin marca"']);
            }

            $sinMarca = Marca::where('nombre', 'Sin marca')->first();
            $sinMarcaId = $sinMarca->id;

            Producto::where('marca_id', $marca->id)->update(['marca_id' => $sinMarcaId]);

            $marca->delete();

            return response()->json(['success' => true, 'message' => 'Marca eliminada exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la marca']);
        }
    }

    public function asignarMarcaSinMarca(Request $request)
    {
        $marcaId = $request->input('marcaId');
        $productos = Producto::where('marca_id', $marcaId)->get();

        if ($productos->isNotEmpty()) {
            $sinMarca = Marca::where('nombre', 'Sin marca')->first();

            if ($sinMarca) {
                foreach ($productos as $producto) {
                    $producto->marca_id = $sinMarca->id;
                    $producto->save();
                }

                return response()->json(['success' => true, 'message' => 'Marca asignada correctamente']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró la marca "Sin marca"']);
            }
        }

        return response()->json(['success' => true, 'message' => 'No hay productos asociados a esta marca']);
    }
}
