@extends('layouts.app')

@section('title', 'Imágenes del carrusel')

@section('content')
    <div class="container-lg">
        <div class="table-responsive py-3">
            <table id="miTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $c = 1; ?>
                    @foreach ($carruseles as $carrusel)
                        <tr>
                            <td>{{ $c++ }}</td>
                            <td data-label="Nombre">{{ $carrusel->nombre }}</td>
                            <td data-label="Imagen"><img class="imagen"
                                    src="{{ URL::to('/') . '/carrusel/' . $carrusel->id . '/' . $carrusel->imagen }}"></td>
                            <td data-label="Acciones">
                                <div class="d-flex flex-column flex-sm-row align-items-center">
                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $carrusel->id }}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="material-icons-outlined">image_search</i>
                                        </button>
                                    </div>

                                    <x-modal.carrusel-ver :carrusel="$carrusel" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar{{ $carrusel->id }}">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="material-icons-outlined">edit</i>
                                        </button>
                                    </div>

                                    <x-modal.carrusel-editar :carrusel="$carrusel" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#confirmacionModal{{ $carrusel->id }}">
                                        <button type="button" class="btn btn-danger" onclick="event.stopPropagation()">
                                            <i class="material-icons-outlined">delete_outline</i>
                                        </button>
                                    </div>

                                    <x-modal.carrusel-eliminar :carrusel="$carrusel" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer>
            <x-navbars.nav-md-admin-carrusel />
            <x-navbars.nav-carrusel-admin />
        </footer>
    </div>

    <x-modal.carrusel-agregar />

    <x-utils.notificaciones />

    </div>
@endsection
