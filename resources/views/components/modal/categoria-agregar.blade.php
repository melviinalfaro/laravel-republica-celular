<div class="modal fade" id="subirModalCategoria" tabindex="-1" aria-labelledby="subirModalCategoriaLabel"
    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="exampleModalLabel">Categorías</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="categoriaForm" method="POST" action="{{ route('agregar.categoria') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color add-modal">
                                <h6 class="modal-title fs-5 py-2">Registradas</h6>
                                <div class="table-scroll">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($categorias as $categoria)
                                                <tr>
                                                    <td>{{ $categoria->nombre }}</td>
                                                    <td data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-light btn-eliminar-categoria"
                                                                    data-id="{{ $categoria->id }}">
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
                                <h6 class="modal-title fs-5 py-2">Agregar nueva</h6>
                                <div class="form-group pt-2">
                                    <label for="categoria-input"
                                        class="label-file text-color">{{ __('Nombre') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="categoria-input" required>
                                    <div class="invalid-feedback invalid-feedback-categoria">Por favor ingresa una
                                        categoría
                                        válida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div id="mensaje-success-categoria" style="display: none;"></div>
                        <div id="mensaje-eliminado-categoria" style="display: none;"></div>
                    </div>

                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="subir" type="submit" class="btn btn-primary">Guardar categoría</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/categoria.js') }}"></script>
