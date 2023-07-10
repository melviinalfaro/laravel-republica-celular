<div class="modal fade" id="subirModalLiberacion" tabindex="-1" aria-labelledby="subirModalLiberacionLabel"
    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
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
                                <h6 class="modal-title fs-6 text-center pb-2">Liberaciones registradas</h6>
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
                                                                    data-id="{{ $liberacion->id }}"
                                                                    data-nombre="{{ $liberacion->nombre }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmarEliminacionLiberacion">
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
                                <h6 class="modal-title fs-6 text-center pb-2">Agregar nueva liberación</h6>
                                <div class="form-group">
                                    <input autocomplete="off" type="text" name="nombre" class="form-control"
                                        id="liberacion-input" required placeholder="Ingrese el nombre de la liberación">
                                    <div class="invalid-feedback invalid-feedback-liberacion">Por favor ingresa una
                                        liberación válida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="d-none d-sm-block">
                        <div class="text-success" id="mensaje-success-liberacion"></div>
                        <div class="text-success" id="mensaje-eliminado-liberacion"></div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Cerrar</button>
                        <button id="subir" type="submit" class="btn btn-primary">Guardar liberación</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmarEliminacionLiberacion" tabindex="-1" role="dialog"
    aria-labelledby="confirmarEliminacionLiberacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color" id="confirmarEliminacionLiberacionLabel">Confirmar eliminación</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-color text-center">¿Estás seguro de que deseas eliminar la liberación <span
                    id="nombre-liberacion"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn-confirmar-eliminacion-liberacion">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/liberacion.js') }}"></script>
