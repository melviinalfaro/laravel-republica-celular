<div class="modal fade" id="subirModalLiberacion" tabindex="-1" aria-labelledby="subirModalLiberacionLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color">Tipos de liberación</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="liberacionForm" method="POST" action="{{ route('agregar.liberacion') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-6">Registradas</h6>
                                <div class="table-scroll">
                                    <table class="table" id="tabla-liberaciones">
                                        <tbody>
                                            @foreach ($liberaciones as $liberacion)
                                                <tr>
                                                    <td class="td-modal">{{ $liberacion->nombre }}</td>
                                                    <td class="td-modal" data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-eliminar-liberacion"
                                                                    data-id="{{ $liberacion->id }}">
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
                                <h6 class="modal-title fs-6">Agregar nueva</h6>
                                <div class="form-group">
                                    <input type="text" name="nombre" autofocus class="form-control" id="liberacion-input"
                                        required placeholder="Ingrese el nombre de la liberación">
                                    <div class="invalid-feedback invalid-feedback-liberacion">Por favor ingresa una liberación
                                        válida
                                    </div>
                                    <div class="text-success" id="mensaje-success-liberacion">
                                    </div>
                                    <div class="text-success" id="mensaje-eliminado-liberacion">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar liberación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/liberacion.js') }}"></script>
