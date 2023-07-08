@extends('layouts.app')

@section('title', 'Inventario de productos')

@section('content')
    <div class="container-lg py-3">
        <div class="table-responsive pt-3">
            <table id="miTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Color</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="td-modal" data-label="Nombre">{{ $producto->nombre }}</td>
                            <td class="td-modal" data-label="Precio">${{ $producto->precio }}</td>
                            <td class="td-modal" data-label="Color">{{ $producto->color }}</td>
                            <td class="td-modal" data-label="Estado">{{ $producto->estado->nombre }}</td>
                            <td class="td-modal" data-label="Capacidad">{{ $producto->capacidad->nombre }}</td>
                            <td class="td-modal" data-label="Categoria">{{ $producto->categoria->nombre }}</td>
                            <td data-label="Acciones">
                                <div class="align-items-center">
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @php
                use Illuminate\Pagination\Paginator;
                Paginator::useBootstrap();
            @endphp
            <div class="d-flex justify-content-center pt-3 paginacion-estilo">
                {{ $productos->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
            </div>
        </div>
    </div>
    <x-modal.producto-agregar />
    <x-modal.estado-agregar :estados="$estados" />
    <x-modal.marca-agregar :marcas="$marcas" />
    <x-modal.capacidad-agregar :capacidades="$capacidades" />
    <x-modal.categoria-agregar :categorias="$categorias" />
    <x-modal.liberacion-agregar :liberaciones="$liberaciones" />

    <x-utils.btn-add-producto />
    <x-utils.notificaciones />
    <x-utils.btn-cuenta />

@endsection

{{-- @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif --}}

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#miTabla').DataTable({
                language: {
                    processing: "Procesando...",
                    search: "",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron registros coincidentes",
                    emptyTable: "No se han registrado productos",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    },
                    aria: {
                        sortAscending: ": Activar para ordenar la columna en orden ascendente",
                        sortDescending: ": Activar para ordenar la columna en orden descendente"
                    }
                },
                paging: false,
                lengthChange: true,
                searching: true,
                ordering: false,
                info: false,
                autoWidth: true,
            });

            var searchWrapper = $('<div class="search-wrapper"></div>');
            var searchInput = $(
                '<input type="search" class="form-control" placeholder="Buscar producto" autocomplete="off">');
            var searchIcon = $('<i class="material-icons-outlined">search</i>');

            searchWrapper.css('position', 'relative');
            searchInput.css('padding-right', '25px');
            searchIcon.css({
                'position': 'absolute',
                'top': '50%',
                'right': '10px',
                'transform': 'translateY(-50%)',
                'color': 'var(--text-color)',
                'pointer-events': 'hide'
            });

            searchInput.on('keyup', function() {
                table.search($(this).val()).draw();
            });

            searchWrapper.append(searchInput);
            searchWrapper.append(searchIcon);

            $('.dataTables_filter').empty().append(searchWrapper);

            $(document).on('click', function(event) {
                var targetElement = event.target;

                if (!searchInput.is(targetElement) && !searchInput.has(targetElement).length) {
                    searchInput.val('');
                    table.search('').draw();
                }
            });
        });
    </script>
@endpush
