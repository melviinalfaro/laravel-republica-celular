<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('images/logo.svg') }}" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">República Celular</span>
            </div>
        </div>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="{{ route('admin') }}" class="{{ Request::is('admin') ? 'active' : '' }}">
                        <i class="icon material-icons-round">home</i>
                        <span class="text nav-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('productos') }}" class="{{ Request::is('productos') ? 'active' : '' }}">
                        <i class="icon material-icons-round">inventory_2</i>
                        <span class="text nav-text">Inventario</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="">
                        <i class="icon material-icons-round">group</i>
                        <span class="text nav-text">Usuarios</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="medium-content">
            <li class="">
                <a href="#">
                    <i class="icon material-icons-round">account_circle</i>
                    <span class="text nav-text">Mi perfil</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="icon material-icons-round">settings</i>
                    <span class="text nav-text">Configuración</span>
                </a>
            </li>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="{{ route('cerrar.sesion') }}">
                    <i class="icon material-icons-round">logout</i>
                    <span class="text nav-text">Cerrar sesión</span>
                </a>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class="icon material-icons-round sun">light_mode</i>
                    <i class="icon material-icons-round moon">dark_mode</i>
                </div>
                <span class="mode-text text">Oscuro</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>
