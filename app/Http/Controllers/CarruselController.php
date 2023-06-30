<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;
use Illuminate\Support\Facades\File;

class CarruselController extends Controller
{
    public function index() {

        $carruseles = Carrusel::all();

        return view('admin-carrusel', compact('carruseles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'imagen' => 'required|image'
        ]);

        $carrusel = new Carrusel();

        if ($request->has('nombre')) {
            $carrusel->nombre = $request->input('nombre');
        }

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $carrusel->imagen = $image->getClientOriginalName();
        }
        $carrusel->save();

        $image->move(public_path('carrusel/' . $carrusel->id), $image->getClientOriginalName());

        try {
            return redirect()->back()->with('success', '¡Has añadido un nuevo carrusel!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo guardar el carrusel: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image'
        ]);

        $carrusel = Carrusel::find($id);

        if ($request->has('nombre')) {
            $carrusel->nombre = $request->input('nombre');
        }

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $carrusel->imagen = $image->getClientOriginalName();
            $image->move(public_path('carrusel/' . $carrusel->id), $image->getClientOriginalName());
        }

        $carrusel->save();

        try {
            return redirect()->back()->with('success', 'El carrusel se ha actualizado');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $carrusel = Carrusel::find($id);

        if ($carrusel) {
            $carrusel_path = public_path("carrusel/{$carrusel->id}");

            if (File::exists($carrusel_path)) {
                File::deleteDirectory($carrusel_path);
            }

            $carrusel->delete();

            try {
                return redirect()->back()->with('success', 'Se ha eliminado exitosamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'No se pudo eliminar: ' . $e->getMessage());
            }
        }
    }
}
