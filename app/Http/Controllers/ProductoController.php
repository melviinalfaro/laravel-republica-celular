<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('marcas', 'categorias')->get();
        $marcas = Marca::all();
        $categorias = Categoria::all();
        
        return view('productos', compact('productos', 'marcas', 'categorias'));
    }



    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nombre' => 'required|string|max:255',
    //         'imagen' => 'required|image',
    //         'precio' => 'required|numeric',
    //         'descripcion' => 'required|string',
    //         'stock' => 'required|boolean',
    //         'estado' => 'required|string',
    //         'color' => 'required|string',
    //         'almacenamiento' => 'nullable|string',
    //         'liberacion' => 'nullable|string',
    //         'categoria_id' => 'nullable|exists:categorias,id',
    //         'marca_id' => 'nullable|exists:marcas,id',
    //     ]);

    //     $producto = new Producto();
    //     $producto->fill($validatedData);

    //     if ($request->has('nombre')) {
    //         $producto->nombre = $request->input('nombre');
    //     }
        
    //     if ($request->hasFile('imagen')) {
    //         $image = $request->file("imagen");
    //         $producto->imagen = $image->getClientOriginalName();
    //     }
        
    //     if ($request->has('precio')) {
    //         $producto->precio = $request->input('precio');
    //     }
        
    //     if ($request->has('descripcion')) {
    //         $producto->descripcion = $request->input('descripcion');
    //     }
        
    //     if ($request->has('stock')) {
    //         $producto->stock = $request->input('stock');
    //     }
        
    //     if ($request->has('estado')) {
    //         $producto->estado = $request->input('estado');
    //     }
        
    //     if ($request->has('color')) {
    //         $producto->color = $request->input('color');
    //     }
        
    //     if ($request->has('almacenamiento')) {
    //         $producto->almacenamiento = $request->input('almacenamiento');
    //     }
        
    //     if ($request->has('liberacion')) {
    //         $producto->liberacion = $request->input('liberacion');
    //     }
        
    //     if ($request->filled('categoria_id')) {
    //         $producto->categoria_id = $request->input('categoria_id');
    //     }
        
    //     if ($request->filled('marca_id')) {
    //         $producto->marca_id = $request->input('marca_id');
    //     }

    //     $producto->save();

    //     $image->move(public_path('productos/' . $producto->id), $image->getClientOriginalName());

    //     try {
    //         return redirect()->back()->with('success', 'Guardado exitosamente.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'No se pudo guardar: ' . $e->getMessage());
    //     }
    // }
}
