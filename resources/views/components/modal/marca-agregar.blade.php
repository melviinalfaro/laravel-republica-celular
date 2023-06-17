<div class="modal fade" id="subirModalMarca" tabindex="-1" aria-labelledby="subirModalLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="exampleModalLabel">Marcas</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="carruselForm" method="POST" action="" class="form" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-5 py-2">Marcas registradas</h6>
                                <div class="table-scroll">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Apple</td>
                                                <td data-label="Acciones">
                                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Samsung</td>
                                                <td data-label="Acciones">
                                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Xiaomi</td>
                                                <td data-label="Acciones">
                                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Xiaomi</td>
                                                <td data-label="Acciones">
                                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Xiaomi</td>
                                                <td data-label="Acciones">
                                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">edit</i>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group m-1" role="group">
                                                            <button type="button" class="btn btn-light">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 text-color">
                                <h6 class="modal-title fs-5 py-2">Agregar marca</h6>
                                <div class="form-group pt-2">
                                    <label for="nombre-input" class="label-file text-color">{{ __('Nombre') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-input" required>
                                    <div class="invalid-feedback invalid-feedback-nombre">Por favor ingresa una marca
                                        válida</div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre-input"
                                        class="label-file text-color">{{ __('Fabricante') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-input" required>
                                    <div class="invalid-feedback invalid-feedback-nombre">Por favor ingresa un
                                        fabricante
                                        válido</div>
                                </div>
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
