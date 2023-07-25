<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Capacidad;
use App\Models\Producto;
use App\Models\Liberacion;
use App\Models\Estado;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('estado', 'marca', 'capacidad', 'categoria', 'liberacion')->paginate(9);

        $estados = Estado::all();
        $marcas = Marca::all();
        $capacidades = Capacidad::all();
        $categorias = Categoria::all();
        $liberaciones = Liberacion::all();

        return view('productos', compact('productos', 'estados', 'marcas', 'capacidades', 'categorias', 'liberaciones'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'color' => 'required|string|max:128',
            'stock' => 'required|integer',
            'imagen' => 'required|image',
            'descripcion' => 'required|string|max:512',
            'estado' => 'required',
            'marca' => 'required',
            'capacidad' => 'required',
            'categoria' => 'required',
            'liberacion' => 'required'
        ]);

        try {
            $producto = $this->crearProducto($request);
            $this->guardarImagen($request->file('imagen'), $producto);

            return redirect()->back()->with('success', 'Producto agregado exitosamente');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar el producto: ' . $e->getMessage());
        }
    }

    private function crearProducto(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->color = $request->input('color');
        $producto->stock = $request->input('stock');
        $producto->descripcion = $request->input('descripcion');
        $producto->estado_id = $request->input('estado');
        $producto->marca_id = $request->input('marca');
        $producto->capacidad_id = $request->input('capacidad');
        $producto->categoria_id = $request->input('categoria');
        $producto->liberacion_id = $request->input('liberacion');
        $producto->save();

        return $producto;
    }

    private function guardarImagen($imagen, $producto)
    {
        if ($imagen) {
            $filename = $imagen->getClientOriginalName();
            $imagen->move(public_path('storage/productos/' . $producto->id), $filename);
            $producto->imagen = $filename;
            $producto->save();
        } else {
            throw new Exception('Error al almacenar la imagen.');
        }
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if ($producto) {
            $producto_path = public_path("producto/{$producto->id}");

            if (File::exists($producto_path)) {
                File::deleteDirectory($producto_path);
            }

            $producto->delete();

            try {
                return redirect()->back()->with('success', 'Producto eliminado exitosamente');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar el producto: ' . $e->getMessage());
            }
        }
    }
}