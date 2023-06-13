<div class="modal fade" id="subirModalProducto" tabindex="-1" aria-labelledby="subirModalLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="exampleModalLabel">Agregar producto</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="carruselForm" method="POST" action="" class="form" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre-input" class="label-file text-color">{{ __('Título') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-input" required>
                                    <div class="invalid-feedback invalid-feedback-nombre">Por favor ingresa un título
                                        válido</div>
                                </div>
                                <div class="form-group">
                                    <label for="estado-input"
                                        class="label-file text-color">{{ __('Almacenamiento') }}</label>
                                    <select name="estado" id="estado-input" class="form-control">
                                        <option value="">Selecciona la cantidad</option>
                                        <option value="16">16GB</option>
                                        <option value="32">32GB</option>
                                        <option value="64">64GB</option>
                                        <option value="128">128GB</option>
                                        <option value="256">256GB</option>
                                        <option value="512">512GB</option>
                                        <option value="1">1TB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio-input" class="label-file text-color">{{ __('Precio') }}</label>
                                    <input type="number" name="precio" autofocus class="form-control"
                                        id="precio-input" required pattern="[0-9]+(\.[0-9]+)?" min="0"
                                        step="0.01" placeholder="0.00">
                                    <div class="invalid-feedback invalid-feedback-precio">Por favor ingresa un precio
                                        válido</div>
                                </div>
                                <div class="form-group">
                                    <label for="color-input" class="label-file text-color">{{ __('Color') }}</label>
                                    <input type="text" name="color" autofocus class="form-control" id="color-input"
                                        required>
                                    <div class="invalid-feedback invalid-feedback-color">Por favor ingresa un color
                                        válido</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado-input" class="label-file text-color">{{ __('Estado') }}</label>
                                    <select name="estado" id="estado-input" class="form-control">
                                        <option value="">Selecciona el estado</option>
                                        <option value="nuevo">Nuevo</option>
                                        <option value="categoria_a">Categoría A</option>
                                        <option value="categoria_b">Categoría B</option>
                                        <option value="usado">Usado</option>
                                        <option value="reacondicionado">Reacondicionado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar producto</button>
                </div>
            </form>
        </div>
    </div>
</div>
