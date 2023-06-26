<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Capacidad;
use App\Models\Producto;
use App\Models\Liberacion;
use App\Models\Estado;

class ProductoController extends Controller
{
    public function obtenerProductos()
    {
        $productos = Producto::all();

        return response()->json($productos);
    }
    public function index()
    {
        $productos = Producto::all();
        //     // $productos = Producto::with('marcas', 'categorias', 'capacidades', 'liberaciones', 'estados')->get();
        //     // $marcas = Marca::all();
        //     // $categorias = Categoria::all();
        //     // $capacidades = Capacidad::all();
        //     // $liberaciones = Liberacion::all();
        //     // $estados = Estado::all();

        return view('productos', compact('productos'));
        //     // return view('productos', compact('productos', 'marcas', 'categorias', 'capacidades', 'liberaciones', 'estados'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $producto = new Producto();
            $producto->nombre = $request->input('nombre');

            $imagen = $request->file('imagen');
            $path = $imagen->store('productos', 'public');
            $producto->imagen = $path;

            $producto->save();

            return response()->json(['success' => true, 'message' => 'Agregaste un nuevo producto.'], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo guardar: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        $producto = Producto::find($id);

        if ($producto) {
            $producto->delete();
            return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente']);
        } else {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar el producto']);
        }
    }
}