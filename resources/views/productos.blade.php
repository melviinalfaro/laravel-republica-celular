@extends('layouts.app')

@section('title', 'Inventario de productos')

@section('content')
    <div class="container-lg">
        <div class="table-responsive pt-3">
            <table id="miTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Color</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Stock</th>
                        {{-- <th scope="col">Acciones</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        @php
                            $numeracion = ($productos->currentPage() - 1) * $productos->perPage() + $loop->iteration;
                        @endphp
                        <tr>
                            <td class="td-modal" data-label="#">{{ $numeracion }}</td>
                            <td class="td-modal" data-label="Nombre">{{ $producto->nombre }}</td>
                            <td class="td-modal" data-label="Precio">${{ $producto->precio }}</td>
                            <td class="td-modal" data-label="Marca">{{ $producto->marca->nombre }}</td>
                            <td class="td-modal" data-label="Color">{{ $producto->color }}</td>
                            <td class="td-modal" data-label="Estado">{{ $producto->estado->nombre }}</td>
                            <td class="td-modal" data-label="Capacidad">{{ $producto->capacidad->nombre }}</td>
                            <td class="td-modal" data-label="Inventario">{{ $producto->stock }}</td>
                            {{-- <td data-label="Acciones">
                                <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $producto->id }}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="material-icons-outlined">visibility</i>
                                    </button>
                                </div>

                                <x-modal.producto-ver :producto="$producto" />

                                <div class="btn-group m-1" role="group" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $producto->id }}">
                                    <button type="button" class="btn btn-success">
                                        <i class="material-icons-outlined">add_photo_alternate</i>
                                    </button>
                                </div>

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
                            </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @php
                use Illuminate\Pagination\Paginator;
                Paginator::useBootstrap();
            @endphp
            <div class="d-flex justify-content-center">
                {{ $productos->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
            </div>
        </div>

        <footer>
            <x-navbars.nav-md-productos />
            <x-navbars.nav-productos />
        </footer>
    </div>
    <x-modal.producto-agregar />
    <x-modal.estado-agregar :estados="$estados" />
    <x-modal.marca-agregar :marcas="$marcas" />
    <x-modal.capacidad-agregar :capacidades="$capacidades" />
    <x-modal.categoria-agregar :categorias="$categorias" />
    <x-modal.liberacion-agregar :liberaciones="$liberaciones" />

    <x-utils.notificaciones />

@endsection
