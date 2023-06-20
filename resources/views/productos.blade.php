@extends('layouts.app')

@section('title', 'Inventario de productos')

@section('content')
    <div class="container-lg p-3">
        <h3 class="titulo pb-2">Inventario de productos</h3>
        <div class="table-responsive py-3">
            <table id="miTabla" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">En stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $c = 1; ?>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="text-center">{{ $c++ }}</td>
                            <td data-label="Nombre">{{ $producto->nombre }}</td>
                            <td data-label="Imagen"><img class="imagen"
                                    src="{{ URL::to('/') . '/producto/' . $producto->id . '/' . $producto->imagen }}"></td>
                            <td data-label="Acciones">
                                <div class="d-flex flex-column flex-sm-row align-items-center">
                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $producto->id }}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="material-icons-round">image_search</i>
                                        </button>
                                    </div>

                                    <x-modal.producto-ver :producto="$producto" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar{{ $producto->id }}">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="material-icons-round">border_color</i>
                                        </button>
                                    </div>

                                    <x-modal.producto-editar :producto="$producto" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#confirmacionModal{{ $producto->id }}">
                                        <button type="button" class="btn btn-danger" onclick="event.stopPropagation()">
                                            <i class="material-icons-round">delete</i>
                                        </button>
                                    </div>

                                    <x-modal.producto-eliminar :producto="$producto" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-modal.producto-agregar />
    <x-modal.categoria-agregar :categorias="$categorias" />

    <x-modal.marca-agregar :marcas="$marcas" />

    <x-utils.btn-add-producto />
    <x-utils.notificaciones />
    <x-utils.btn-cuenta />

    </div>
@endsection
