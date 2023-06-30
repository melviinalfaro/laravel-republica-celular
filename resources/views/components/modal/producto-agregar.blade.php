<div class="modal fade" id="subirModalProducto" tabindex="-1" aria-labelledby="subirModalProductoLabel"
    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-color">Agregar un producto</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="productoForm" method="POST" action="{{ route('agregar.producto') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre-producto-input"
                                        class="label-file text-color">{{ __('Nombre') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-producto-input" required>
                                    <div class="invalid-feedback invalid-feedback-nombre">
                                        Por favor ingresa un nombre válido
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image-producto-input"
                                        class="label-file text-color">{{ __('Imagen principal') }}</label>
                                    <label for="image-producto-input" class="file-upload-producto">
                                        <p>Selecciona la imagen</p>
                                        <span class="image-producto-name"></span>
                                    </label>
                                    <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .gif, .webp"
                                        id="image-producto-input" class="file-upload-input" required>
                                    <div class="invalid-feedback invalid-feedback-imagen">Por favor selecciona una
                                        imagen válida</div>
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

            {{-- <form id="productoForm" method="POST" action="{{ route('agregar.producto') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre-producto-input" class="label-file text-color">{{ __('Nombre') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-producto-input" required>
                                    <div class="invalid-feedback invalid-feedback-nombre">
                                        Por favor ingresa un nombre válido
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="precio-input" class="label-file text-color">{{ __('Precio') }}</label>
                                    <input type="number" name="precio" autofocus class="form-control"
                                        id="precio-input" required pattern="[0-9]+(\.[0-9]+)?" min="0"
                                        step="0.01" placeholder="0.00">
                                    <div class="invalid-feedback invalid-feedback-precio">Por favor ingresa un precio válido
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inventario-input"
                                        class="label-file text-color">{{ __('Cantidad en inventario') }}</label>
                                    <input type="text" name="inventario" autofocus class="form-control"
                                        id="inventario-input" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        required min="0" step="0" placeholder="0">
                                    <div class="invalid-feedback invalid-feedback-inventario">Por favor ingresa una
                                        cantidad numérica.</div>
                                </div> --}}
            {{-- </div> --}}
            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado-select" class="label-file text-color">{{ __('Estado') }}</label>
                                    <select name="estado" id="estado-select" class="form-control">
                                        <option value="">Selecciona el estado</option>
                                    </select>
                                    <div class="invalid-feedback invalid-feedback-estado">Por favor selecciona un estado
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="almacenamiento-select"
                                        class="label-file text-color">{{ __('Almacenamiento') }}</label>
                                    <select name="almacenamiento" id="almacenamiento-select" class="form-control">
                                        <option value="">Selecciona la capacidad</option>
                                    </select>
                                    <div class="invalid-feedback invalid-feedback-almacenamiento">
                                        Por favor selecciona una capacidad válida
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="marca-select" class="label-file text-color">{{ __('Marca') }}</label>
                                    <select name="marca" id="marca-select" class="form-control">
                                        <option value="">Selecciona la marca</option>
                                    </select>
                                    <div class="invalid-feedback invalid-feedback-marca">
                                        Por favor selecciona una marca válida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color-input" class="label-file text-color">{{ __('Color') }}</label>
                                    <input type="text" name="color" autofocus class="form-control" id="color-input"
                                        required>
                                    <div class="invalid-feedback invalid-feedback-color">Por favor ingresa un color
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="liberacion-select"
                                        class="label-file text-color">{{ __('Tipo de liberación') }}</label>
                                    <select name="liberacion" id="liberacion-select" class="form-control">
                                        <option value="">Selecciona la liberación</option>
                                    </select>
                                    <div class="invalid-feedback invalid-feedback-liberacion">
                                        Por favor selecciona una liberación válida
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categoria-select" class="label-file text-color">{{ __('Categoría') }}</label>
                                    <select name="categoria" id="categoria-select" class="form-control">
                                        <option value="">Selecciona la categoría</option>
                                    </select>
                                    <div class="invalid-feedback invalid-feedback-categoria">
                                        Por favor selecciona una categoría válida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion-input"
                                        class="label-file text-color">{{ __('Descripción del producto') }}</label>
                                    <textarea name="descripcion" autofocus class="form-control" id="descripcion-input" required></textarea>
                                    <div class="invalid-feedback invalid-feedback-descripcion">Por favor ingresa una
                                        descripción</div>
                                </div>
                            </div> --}}
            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image-producto-input"
                                        class="label-file text-color">{{ __('Imagen principal') }}</label>
                                    <label for="image-producto-input" class="file-upload-producto">
                                        <p>Selecciona la imagen</p>
                                        <span class="image-producto-name"></span>
                                    </label>
                                    <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .gif, .webp"
                                        id="image-producto-input" class="file-upload-input" required>
                                    <div class="invalid-feedback invalid-feedback-imagen">Por favor selecciona una
                                        imagen válida</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar producto</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

<script src="{{ 'js/producto.js' }}"></script>
