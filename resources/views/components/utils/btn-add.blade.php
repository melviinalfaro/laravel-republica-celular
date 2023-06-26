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
        <li class="dropdown__item" onclick="redirectTo('{{ route('ver.carrusel') }}')">
            <i class="material-icons-outlined dropdown__icon icon">add_photo_alternate</i>
            <span class="dropdown__name text">Carrusel</span>
        </li>
        <li class="dropdown__item" onclick="redirectTo('{{ route('productos') }}')">
            <i class="material-icons-outlined dropdown__icon icon">inventory_2</i>
            <span class="dropdown__name text">Producto</span>
        </li>
    </ul>
</div>

<script src="{{ asset('js/btn-add.js') }}"></script>
