<div class="modal fade" id="confirmacionModal{{ $carrusel->id }}" tabindex="-1"
    aria-labelledby="confirmacionModalLabel{{ $carrusel->id }}" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-color" id="confirmacionModalLabel{{ $carrusel->id }}">
                    Confirma la eliminación</h5>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <div class="modal-body text-color">
                ¿Estas seguro que deseas eliminar la imagen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar</button>
                <form action="{{ route('eliminar-carrusel', ['id' => $carrusel->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>