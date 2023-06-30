@extends('layouts.app')

@section('title', 'Inventario de productos')

@section('content')
    <div class="container-lg py-3">
        <div class="table-responsive py-3">
            <table id="miTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $c = 1; ?>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="text-center">{{ $c++ }}</td>
                            <td data-label="Nombre">{{ $producto->nombre }}</td>
                            <td data-label="Imagen">
                                <img class="imagen"
                                    src="{{ asset('storage/productos/' . $producto->id . '/' . $producto->imagen) }}">
                            </td>

                            <td data-label="Acciones">
                                <div class="d-flex flex-column flex-sm-row align-items-center">
                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $producto->id }}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="material-icons-outlined">visibility</i>
                                        </button>
                                    </div>

                                    <x-modal.producto-ver :producto="$producto" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar{{ $producto->id }}">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="material-icons-outlined">edit</i>
                                        </button>
                                    </div>

                                    <x-modal.producto-editar :producto="$producto" />

                                    <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                        data-bs-target="#confirmacionModal{{ $producto->id }}">
                                        <button type="button" class="btn btn-danger" onclick="event.stopPropagation()">
                                            <i class="material-icons-outlined">delete</i>
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
    {{-- <x-modal.producto-agregar :categorias="$categorias" :marcas="$marcas" :capacidades="$capacidades" />
    <x-modal.categoria-agregar :categorias="$categorias" />
    <x-modal.capacidad-agregar :capacidades="$capacidades" />
    <x-modal.marca-agregar :marcas="$marcas" />
    <x-modal.liberacion-agregar :liberaciones="$liberaciones" />
    <x-modal.estado-agregar :estados="$estados" /> --}}

    <x-utils.btn-add-producto />
    <x-utils.notificaciones />
    <x-utils.btn-cuenta />

    </div>
@endsection
