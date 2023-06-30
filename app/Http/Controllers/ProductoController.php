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
        $productos = Producto::all();

        return view('productos', compact('productos'));
    }

    //     // $productos = Producto::with('marcas', 'categorias', 'capacidades', 'liberaciones', 'estados')->get();
    //     // $marcas = Marca::all();
    //     // $categorias = Categoria::all();
    //     // $capacidades = Capacidad::all();
    //     // $liberaciones = Liberacion::all();
    //     // $estados = Estado::all();
    //     // return view('productos', compact('productos', 'marcas', 'categorias', 'capacidades', 'liberaciones', 'estados'));


    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'imagen' => 'required|image'
        ]);

        try {
            $producto = $this->crearProducto($request->input('nombre'));
            $this->guardarImagen($request->file('imagen'), $producto);

            return redirect()->back()->with('success', '¡Has añadido un nuevo producto!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar el producto: ' . $e->getMessage());
        }
    }

    private function crearProducto($nombre)
    {
        $producto = new Producto();
        $producto->nombre = $nombre;
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
                return redirect()->back()->with('success', 'Se ha eliminado exitosamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'No se pudo eliminar: ' . $e->getMessage());
            }
        }
    }
}