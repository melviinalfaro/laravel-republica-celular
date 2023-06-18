<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
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

    public function destroy($id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $marca->delete();

            return response()->json(['success' => true, 'message' => 'Marca eliminada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo eliminar la marca: ' . $e->getMessage()]);
        }
    }
}