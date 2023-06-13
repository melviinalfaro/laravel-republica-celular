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
            return redirect()->back()->with('success', 'Guardado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo guardar: ' . $e->getMessage());
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
            return redirect()->back()->with('success', 'Actualizado exitosamente.');
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
                return redirect()->back()->with('success', 'Eliminado exitosamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'No se pudo eliminar: ' . $e->getMessage());
            }
        }
    }
}
