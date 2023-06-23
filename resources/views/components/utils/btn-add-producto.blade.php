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
            <a href="#" class="dropdown__name text">Capacidad</a>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalLiberacion">
            <i class="material-icons-outlined dropdown__icon icon">sim_card</i>
            <a href="#" class="dropdown__name text">Tipo de liberación</a>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalEstado">
            <i class="material-icons-outlined dropdown__icon icon">verified</i>
            <a href="#" class="dropdown__name text">Estado</a>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalMarca">
            <i class="material-icons-outlined dropdown__icon icon">loyalty</i>
            <a href="#" class="dropdown__name text">Marca</a>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalCategoria">
            <i class="material-icons-outlined dropdown__icon icon">category</i>
            <a href="#" class="dropdown__name text">Categoría</a>
        </li>
        <li class="dropdown__item" data-bs-toggle="modal" data-bs-target="#subirModalProducto">
            <i class="material-icons-outlined dropdown__icon icon">inventory</i>
            <a href="#" class="dropdown__name text">Producto</a>
        </li>
    </ul>
</div>

<script src="{{ asset('js/btn-add.js') }}"></script>
