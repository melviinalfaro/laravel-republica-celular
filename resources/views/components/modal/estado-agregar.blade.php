<div class="modal fade" id="subirModalEstado" tabindex="-1" aria-labelledby="subirModalEstadoLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color">Estados de los productos</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="estadoForm" method="POST" action="{{ route('agregar.estado') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-6">Registrados</h6>
                                <div class="table-scroll">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($estados as $estado)
                                                <tr>
                                                    <td class="td-modal">{{ $estado->nombre }}</td>
                                                    <td class="td-modal" data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-eliminar-estado"
                                                                    data-id="{{ $estado->id }}">
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
                                <h6 class="modal-title fs-6">Agregar nuevo</h6>
                                <div class="form-group">
                                    <input type="text" name="nombre" autofocus class="form-control" id="estado-input"
                                        required placeholder="Ingrese el nombre del estado">
                                    <div class="invalid-feedback invalid-feedback-estado">Por favor ingresa un estado
                                        válido
                                    </div>
                                    <div class="text-success" id="mensaje-success-estado">
                                    </div>
                                    <div class="text-success" id="mensaje-eliminado-estado">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar estado</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/estado.js') }}"></script>
