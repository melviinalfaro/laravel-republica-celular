<div class="modal fade" id="modal{{ $carrusel->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $carrusel->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="imagenModalLabel">
                    {{ $carrusel->nombre }}</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <div class="modal-body">
                <img class="imagen-ver"
                    src="{{ URL::to('/') . '/carrusel/' . $carrusel->id . '/' . $carrusel->imagen }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>