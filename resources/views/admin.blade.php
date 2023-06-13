@extends('layouts.app')

@section('title', 'Administrador')

@section('content')
    <div class="container-lg p-3">
        <h3 class="titulo pb-2">Panel administrativo</h3>

        <div class="row py-3">
            <div class="col-md-6">
                <div id="carruselPublicidad" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if (count($carruseles) > 0)
                            @foreach ($carruseles as $index => $carrusel)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="3000">
                                    <img src="{{ URL::to('/') . '/carrusel/' . $carrusel->id . '/' . $carrusel->imagen }}"
                                        class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('images/defecto-carrusel.webp') }}" class="d-block w-100"
                                    alt="Imagen por defecto">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carruselPublicidad"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carruselPublicidad"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <a href="{{ route('subir.carrusel') }}">
                        <button class="btn-imagenes btn btn-primary">
                            <i class="material-icons-round">add_photo_alternate</i>
                            Agregar imágenes
                        </button>
                    </a>
                    <h3 class="titulo-productos">Carrusel publicitario</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carruselPublicidad" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if (count($carruseles) > 0)
                            @foreach ($carruseles as $index => $carrusel)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="3000">
                                    <img src="{{ URL::to('/') . '/carrusel/' . $carrusel->id . '/' . $carrusel->imagen }}"
                                        class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('images/defecto-carrusel.webp') }}" class="d-block w-100"
                                    alt="Imagen por defecto">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carruselPublicidad"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carruselPublicidad"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <a href="{{ route('subir.carrusel') }}">
                        <button class="btn-imagenes btn btn-primary">
                            <i class="material-icons-round">inventory_2</i>
                            Agregar productos
                        </button>
                    </a>
                    <h3 class="titulo-productos">Agregados recientemente</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
