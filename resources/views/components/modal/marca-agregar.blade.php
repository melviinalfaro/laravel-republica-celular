<div class="modal fade" id="subirModalMarca" tabindex="-1" aria-labelledby="subirModalMarcaLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color">Marcas de los productos</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="marcaForm" method="POST" action="{{ route('agregar.marca') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-6 text-center pb-2">Marcas registradas</h6>
                                <div class="table-scroll">
                                    <table class="table" id="tabla-marcas">
                                        <tbody>
                                            @foreach ($marcas as $marca)
                                                <tr>
                                                    <td class="td-modal">{{ $marca->nombre }}</td>
                                                    <td class="td-modal" data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-eliminar-marca"
                                                                    data-id="{{ $marca->id }}"
                                                                    data-nombre="{{ $marca->nombre }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmarEliminacionMarca">
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
                                <h6 class="modal-title fs-6 text-center pb-2">Agregar nueva marca</h6>
                                <div class="form-group">
                                    <input autocomplete="off" type="text" name="nombre" class="form-control"
                                        id="marca-input" required placeholder="Ingrese el nombre de la marca">
                                    <div class="invalid-feedback invalid-feedback-marca">Por favor ingresa una marca
                                        válida</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="d-none d-sm-block">
                        <div class="text-success" id="mensaje-success-marca"></div>
                        <div class="text-danger" id="mensaje-error-marca"></div>
                        <div class="text-success" id="mensaje-eliminado-marca"></div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Cerrar</button>
                        <button id="subir" type="submit" class="btn btn-primary">Guardar marca</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmarEliminacionMarca" tabindex="-1" role="dialog"
    aria-labelledby="confirmarEliminacionMarcaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color" id="confirmarEliminacionMarcaLabel">Confirmar eliminación</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-color text-center">¿Estás seguro de que deseas eliminar la marca <span
                        id="nombre-marca"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn-confirmar-eliminacion-marca">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/marca.js') }}"></script>
