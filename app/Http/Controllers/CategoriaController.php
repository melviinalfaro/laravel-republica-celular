<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

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

            return response()->json(['success' => true, 'message' => 'Guardado exitosamente.', 'data' => $categoria]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();
            return response()->json(['success' => true, 'message' => 'Categoría eliminada correctamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría']);
        }
    }
}
