@extends('layouts.app')

@section('title', 'Inventario de productos')

@section('content')
    <div class="container-lg py-3">
        <div class="table-responsive py-3">
            <table id="tabla-productos" class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            {{-- <table id="miTabla" class="table">
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
                    <x-modal.producto-eliminar :productos="$productos" />
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
        <div id="notificationContainer"></div>
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

    <script>
        function obtenerProductos() {
            $.ajax({
                url: "/obtener-productos?timestamp=" + Date.now(),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var tablaProductos = $("#tabla-productos tbody");

                    if (response.length > 0) {
                        tablaProductos.empty();

                        response.forEach(function(producto, index) {
                            var fila = $("<tr>");

                            var numero = $("<td>")
                                .addClass("text-center")
                                .text(index + 1);
                            var nombre = $("<td>").text(producto.nombre);
                            var imagen = $("<td>").html(
                                '<img class="imagen" src="' + '{{ asset('storage/') }}' + '/' +
                                producto.imagen + '">'
                            );
                            var acciones = $("<td>").html(`
                        <div class="d-flex flex-column flex-sm-row align-items-center">
                            <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#modal${producto.id}">
                                <button type="button" class="btn btn-primary">
                                    <i class="material-icons-round">image_search</i>
                                </button>
                            </div>
                            <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#modalEditar${producto.id}">
                                <button type="submit" class="btn btn-warning">
                                    <i class="material-icons-round">border_color</i>
                                </button>
                            </div>
                            <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#confirmacionModal${producto.id}">
                                <button type="button" class="btn btn-danger" onclick="event.stopPropagation()">
                                    <i class="material-icons-round">delete</i>
                                </button>
                            </div>
                        </div>
                    `);

                            fila.append(numero, nombre, imagen, acciones);

                            tablaProductos.append(fila);
                        });
                    } else {
                        tablaProductos.html(
                            '<tr><td colspan="4" class="text-center">No se encontraron productos</td></tr>'
                        );
                    }
                },
                error: function(xhr) {
                    console.log("Error en la solicitud AJAX");
                },
            });
        }

        function eliminarProducto(id) {
            $.ajax({
                url: "/eliminar-producto/" +
                id,
                type: "DELETE",
                success: function(response) {
                    obtenerProductos();
                },
                error: function(xhr) {
                    console.log("Error en la solicitud AJAX");
                },
            });
        }

        function obtenerProductos() {
            $.ajax({
                url: "/obtener-productos?timestamp=" + Date.now(),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var tablaProductos = $("#tabla-productos tbody");

                    if (response.length > 0) {
                        tablaProductos.empty();

                        response.forEach(function(producto, index) {
                            var fila = $("<tr>");

                            var numero = $("<td>")
                                .addClass("text-center")
                                .text(index + 1);
                            var nombre = $("<td>").text(producto.nombre);
                            var imagen = $("<td>").html(
                                '<img class="imagen" src="' + '{{ asset('storage/') }}' + '/' +
                                producto.imagen + '">'
                            );
                            var acciones = $("<td>").html(`
                            <div class="d-flex flex-column flex-sm-row align-items-center">
                                <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#modal${producto.id}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="material-icons-round">image_search</i>
                                    </button>
                                </div>
                                <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#modalEditar${producto.id}">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="material-icons-round">border_color</i>
                                    </button>
                                </div>
                                <div class="btn-group m-1" role="group" data-bs-toggle="modal" data-bs-target="#confirmacionModal${producto.id}">
                                    <button type="button" class="btn btn-danger" onclick="eliminarProducto(${producto.id}); event.stopPropagation();">
                                        <i class="material-icons-round">delete</i>
                                    </button>
                                </div>
                            </div>
                        `);

                            fila.append(numero, nombre, imagen, acciones);

                            tablaProductos.append(fila);
                        });
                    } else {
                        tablaProductos.html(
                            '<tr><td colspan="4" class="text-center">No se encontraron productos</td></tr>'
                        );
                    }
                },
                error: function(xhr) {
                    console.log("Error en la solicitud AJAX");
                },
            });
        }
    </script>
@endsection
