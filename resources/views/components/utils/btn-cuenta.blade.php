<div class="dropdown-new" id="dropdown-content-new">
    <button class="dropdown-new__button" id="dropdown-button-new">
        <i class="material-icons-outlined dropdown-new__icon">account_circle</i>
        <span class="dropdown-new__name">{{ auth()->user()->name }}</span>

        <div class="dropdown-new__icons">
            <i class="material-icons-outlined dropdown-new__arrow">arrow_drop_down</i>
            <i class="material-icons-outlined dropdown-new__close">close</i>
        </div>
    </button>

    <ul class="dropdown-new__menu">
        <li class="dropdown-new__item">
            <i class="material-icons-outlined dropdown-new__icon icon">face</i>
            <a href="#" class="dropdown-new__name">Mi perfil</a>
        </li>

        <li class="dropdown-new__item">
            <i class="material-icons-outlined dropdown-new__icon icon">settings</i>
            <a href="#" class="dropdown-new__name">Configuración</a>
        </li>

        <li class="dropdown-new__item" onclick="redirectTo('{{ route('cerrar.sesion') }}')">
            <i class="material-icons-outlined dropdown-new__icon icon">logout</i>
            <span class="dropdown-new__name">Cerrar sesión</span>
        </li>
    </ul>
</div>

<script src="{{ asset('js/btn-cuenta.js') }}"></script>
