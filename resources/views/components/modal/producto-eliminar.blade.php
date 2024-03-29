<div class="modal fade" id="confirmacionModal{{ $producto->id }}" tabindex="-1"
    aria-labelledby="confirmacionModalLabel{{ $producto->id }}" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-color" id="confirmacionModalLabel{{ $producto->id }}">
                    Confirma la eliminación</h5>
                <button class="btn-cerrar">
                    <i class="icon material-icons-outlined" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <div class="modal-body text-color text-center">
                <span>¿Estás seguro que deseas eliminar el producto?</span>
                <h6>{{ $producto->nombre }}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar</button>
                <form action="{{ route('eliminar.producto', ['id' => $producto->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
