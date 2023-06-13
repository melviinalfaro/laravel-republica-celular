<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;

class InicioController extends Controller
{
    public function index() {

        $carruseles = Carrusel::all();

        return view('inicio', compact('carruseles'));
    }
}
