<div class="modal fade" id="subirModalMarca" tabindex="-1" aria-labelledby="subirModalMarcaLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="exampleModalLabel">Marcas</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="marcaForm" method="POST" action="{{ route('agregar.marca') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-5 py-2">Registradas</h6>
                                <div class="table-scroll">
                                    <table class="table">
                                        <thead class="sticky-top titulo-tabla">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($marcas as $marca)
                                                <tr>
                                                    <td>{{ $marca->nombre }}</td>
                                                    <td data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-light btn-eliminar">
                                                                    <i class="material-icons-outlined">delete</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-5 py-2">Agregar</h6>
                                <div class="form-group pt-2">
                                    <label for="marca-input" class="label-file text-color">{{ __('Nombre') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control" id="marca-input"
                                        required>
                                    <div class="invalid-feedback invalid-feedback-marca">Por favor ingresa un nombre
                                    </div>
                                </div>
                                <div id="mensaje-success" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar marca</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Maneja el envío del formulario para agregar marcas
        $(document).on('click', '#subir', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            var form = $('#marcaForm');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Realiza la solicitud AJAX
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    // Manipula la respuesta del servidor
                    if (response.success) {
                        $('#mensaje-success').removeClass('text-danger').addClass(
                            'text-success').text(response.message).show();
                        form.trigger('reset'); // Limpia el formulario

                        // Actualiza la tabla dentro del modal con el nuevo registro
                        var nuevaFila = $('<tr>')
                            .append($('<td>').text(response.data.nombre))
                            .append($('<td>').html(
                                '<div class="d-flex flex-column align-items-center">' +
                                '<div class="btn-group m-1" role="group">' +
                                '<button type="button" class="btn btn-light btn-eliminar" data-id="' +
                                response.data.id + '">' +
                                '<i class="material-icons-outlined">delete</i>' +
                                '</button>' +
                                '</div>' +
                                '</div>'));

                        $('#subirModalMarca').find('tbody').append(nuevaFila);

                        // Oculta el mensaje después de 5 segundos
                        setTimeout(function() {
                            $('#mensaje-success').hide();
                        }, 3000);
                    } else {
                        alert('No se pudo guardar: ' + response.error);
                    }
                },
                error: function(xhr) {
                    // Maneja los errores de la solicitud AJAX
                    alert('Error en la solicitud AJAX: ' + xhr.responseText);
                }
            });
        });
    });
</script>
