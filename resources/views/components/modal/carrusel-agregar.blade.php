<div class="modal fade" id="subirModal" tabindex="-1" aria-labelledby="subirModalLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color">Imagen para carrusel</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="carruselForm" method="POST" action="{{ route('agregar.carrusel') }}" class="form"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre-input" class="label-file text-color">{{ __('Nombre') }}</label>
                        <input type="text" name="nombre" autofocus class="form-control" id="nombre-input" required placeholder="Ingresa el nombre de la campaña">
                        <div class="invalid-feedback invalid-feedback-nombre">Por favor ingresa un nombre
                            válido</div>
                    </div>
                    <div class="form-group">
                        <label for="image-upload-input" class="label-file text-color">{{ __('Imagen') }}</label>
                        <label for="image-upload-input" class="file-upload">
                            <p>Selecciona la imagen</p>
                            <small>800x450 píxeles</small>
                            <span class="image-upload-name"></span>
                        </label>
                        <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .svg .webp"
                            id="image-upload-input" class="file-upload-input" required>
                        <div class="invalid-feedback invalid-feedback-imagen">Por favor selecciona una imagen</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="subir" type="submit" class="btn btn-primary">Guardar imagen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/carrusel.js') }}"></script>
