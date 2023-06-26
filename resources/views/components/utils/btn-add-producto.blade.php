<div class="dropdown" id="dropdown-content">
    <button class="dropdown__button" id="dropdown-button">
        <i class="material-icons-outlined dropdown__icon">add_circle_outline</i>
        <span class="dropdown__name">Agregar</span>

        <div class="dropdown__icons">
            <i class="material-icons-outlined dropdown__arrow">arrow_drop_up</i>
            <i class="material-icons-outlined dropdown__close">close</i>
        </div>
    </button>

    <ul class="dropdown__menu">
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalCapacidad">
            <i class="material-icons-outlined dropdown__icon icon">storage</i>
            <span class="dropdown__name">Capacidad</span>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalLiberacion">
            <i class="material-icons-outlined dropdown__icon icon">sim_card</i>
            <span class="dropdown__name">Liberación</span>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalEstado">
            <i class="material-icons-outlined dropdown__icon icon">verified</i>
            <span class="dropdown__name">Estado</span>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalMarca">
            <i class="material-icons-outlined dropdown__icon icon">loyalty</i>
            <span class="dropdown__name">Marca</span>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalCategoria">
            <i class="material-icons-outlined dropdown__icon icon">category</i>
            <span class="dropdown__name">Categoría</span>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalProducto">
            <i class="material-icons-outlined dropdown__icon icon">inventory</i>
            <span class="dropdown__name">Producto</span>
        </li>
    </ul>
</div>

<script src="{{ asset('js/btn-add.js') }}"></script>
