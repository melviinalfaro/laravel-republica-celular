<div class="modal fade" id="modalEditar{{ $carrusel->id }}" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $carrusel->id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="imagenModalLabel">Editar el carrusel - "{{ $carrusel->nombre }}"</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="modalForm{{ $carrusel->id }}" action="{{ route('actualizar-carrusel', ['id' => $carrusel->id]) }}"
                class="form" enctype="multipart/form-data" novalidate method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="columna col-md-7">
                                <img class="editar-imagen"
                                    src="{{ URL::to('/') . '/carrusel/' . $carrusel->id . '/' . $carrusel->imagen }}">
                            </div>
                            <div class="columna col-md-5">
                                <div class="form-group">
                                    <label for="nombre-input-editar{{ $carrusel->id }}"
                                        class="label-nombre text-color">{{ __('Título') }}</label>
                                    <input type="text" name="nombre" autofocus class="form-control"
                                        id="nombre-input-editar{{ $carrusel->id }}" value="{{ $carrusel->nombre }}"
                                        required form="modalForm{{ $carrusel->id }}">
                                    <div class="invalid-feedback invalid-feedback-nombre-editar{{ $carrusel->id }}">Por
                                        favor ingresa un título válido</div>
                                </div>
                                <div class="form-group">
                                    <label for="image-upload-input-editar{{ $carrusel->id }}"
                                        class="label-file text-color">{{ __('Imagen')
                                        }}</label>
                                    <label for="image-upload-input-editar{{ $carrusel->id }}" class="file-upload-modal">
                                        <p>Selecciona la imagen</p>
                                        <small>800x450 píxeles</small>
                                        <span class="image-upload-name-editar{{ $carrusel->id }}"></span>
                                    </label>
                                    <input type="file" name="imagen"
                                        accept=".jpg, .jpeg, .png, .svg .webp .mp4 .mov .mkv"
                                        id="image-upload-input-editar{{ $carrusel->id }}" class="file-upload-input">
                                    <div class="invalid-feedback invalid-feedback-imagen-editar{{ $carrusel->id }}">Por
                                        favor selecciona una
                                        imagen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subirEditar{{ $carrusel->id }}" type="submit" class="btn btn-primary">Actualizar
                        imagen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const form{{ $carrusel->id }} = document.querySelector("#modalForm{{ $carrusel->id }}");
    const nombreInput{{ $carrusel->id }} = document.querySelector("#nombre-input-editar{{ $carrusel->id }}");
    const invalidNombreFeedback{{ $carrusel->id }} = document.querySelector(".invalid-feedback-nombre-editar{{ $carrusel->id }}");
    const imagenInput{{ $carrusel->id }} = document.querySelector("#image-upload-input-editar{{ $carrusel->id }}");
    const invalidImagenFeedback{{ $carrusel->id }} = document.querySelector(".invalid-feedback-imagen-editar{{ $carrusel->id }}");

    nombreInput{{ $carrusel->id }}.addEventListener("input", () => {
        nombreInput{{ $carrusel->id }}.classList.remove("is-invalid");
        invalidNombreFeedback{{ $carrusel->id }}.style.display = "none";
    });

    imagenInput{{ $carrusel->id }}.addEventListener("change", () => {
        const fileName = imagenInput{{ $carrusel->id }}.files[0]?.name;
        const uploadName = document.querySelector(".image-upload-name-editar{{ $carrusel->id }}");
        uploadName.textContent = fileName;
        imagenInput{{ $carrusel->id }}.classList.remove("is-invalid");
        invalidImagenFeedback{{ $carrusel->id }}.style.display = "none";
    });

    const modal{{ $carrusel->id }} = document.querySelector("#modalEditar{{ $carrusel->id }}");

    modal{{ $carrusel->id }}.addEventListener("hidden.bs.modal", function () {
        form{{ $carrusel->id }}.reset();
        nombreInput{{ $carrusel->id }}.classList.remove("is-invalid");
        invalidNombreFeedback{{ $carrusel->id }}.style.display = "none";
        imagenInput{{ $carrusel->id }}.classList.remove("is-invalid");
        invalidImagenFeedback{{ $carrusel->id }}.style.display = "none";
    });

    form{{ $carrusel->id }}.addEventListener("submit", function (event) {
        const button = document.querySelector("button[id='subirEditar{{ $carrusel->id }}']");
    
        if (!nombreInput{{ $carrusel->id }}.value) {
            event.preventDefault();
            nombreInput{{ $carrusel->id }}.classList.add("is-invalid");
            invalidNombreFeedback{{ $carrusel->id }}.style.display = "block";
        } else {
            if (!form{{ $carrusel->id }}.checkValidity()) {
                event.preventDefault();
                alert("Por favor complete todos los campos requeridos");
            } else {
                button.innerHTML = "Cargando...";
                button.classList.add("disabled");
                form{{ $carrusel->id }}.submit();
            }
        }
    });
</script>