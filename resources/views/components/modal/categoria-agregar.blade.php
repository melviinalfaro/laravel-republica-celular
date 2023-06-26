{{-- <div class="modal fade" id="subirModalCategoria" tabindex="-1" aria-labelledby="subirModalCategoriaLabel"
    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color">Categorías de los productos</h1>
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
                                <h6 class="modal-title fs-6">Registradas</h6>
                                <div class="table-scroll">
                                    <table class="table">
                                        <tbody>
                                            @foreach ($categorias as $categoria)
                                                <tr>
                                                    <td class="td-modal">{{ $categoria->nombre }}</td>
                                                    <td class="td-modal" data-label="Acciones">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <div class="btn-group m-1" role="group">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-eliminar-categoria"
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
                                <h6 class="modal-title fs-6">Agregar nueva categoría</h6>
                                <div class="form-group">
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="categoria-input" required placeholder="Ingrese el nombre de la categoría">
                                    <div class="invalid-feedback invalid-feedback-categoria">Por favor ingresa una
                                        categoría válida
                                    </div>
                                    <div class="text-success" id="mensaje-success-categoria">
                                    </div>
                                    <div class="text-success" id="mensaje-eliminado-categoria">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/categoria.js') }}"></script> --}}
