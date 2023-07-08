<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class CategoriaController extends Controller
{
    public function obtenerCategorias()
    {
        $categorias = Categoria::all();

        return response()->json($categorias);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255'
        ]);

        try {
            $categoria = new Categoria();
            $categoria->nombre = $request->input('nombre');
            $categoria->save();

            return response()->json(['success' => true, 'message' => 'Categoría guardada exitosamente', 'data' => $categoria]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            if ($categoria->nombre === 'Sin categoría') {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar la categoría "Sin Categoría"']);
            }

            $sinCategoria = Categoria::where('nombre', 'Sin categoría')->first();
            $sinCategoriaId = $sinCategoria->id;

            Producto::where('categoria_id', $categoria->id)->update(['categoria_id' => $sinCategoriaId]);

            $categoria->delete();

            return response()->json(['success' => true, 'message' => 'Categoría eliminada exitosamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría']);
        }
    }

    public function asignarCategoriaSinCategoria(Request $request)
    {
        $categoriaId = $request->input('categoriaId');
        $productos = Producto::where('categoria_id', $categoriaId)->get();

        if ($productos->isNotEmpty()) {
            $sinCategoria = Categoria::where('nombre', 'Sin categoría')->first();

            if ($sinCategoria) {
                foreach ($productos as $producto) {
                    $producto->categoria_id = $sinCategoria->id;
                    $producto->save();
                }

                return response()->json(['success' => true, 'message' => 'Categoría asignada correctamente']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró la categoría "Sin categoría"']);
            }
        }

        return response()->json(['success' => true, 'message' => 'No hay productos asociados a esta categoría']);
    }
}