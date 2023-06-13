<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;

class AdminController extends Controller
{
    public function index() {

        $carruseles = Carrusel::all();

        return view('admin', compact('carruseles'));
    }
}
