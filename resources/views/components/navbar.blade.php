<nav class="navbar bg-body-tertiary">
    <div class="container-lg">
        <div class="nav-brand">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                <span class="brand-text">República Celular</span>
            </a>
        </div>

        <div class="buscador">
            <input type="text" name="text" class="input-buscar" id="input" placeholder="Buscar teléfono">
            <label class="icono-buscar" for="input">
                <i class="material-icons-round">search</i>
            </label>
        </div>

        <div class="d-flex align-items-center">
            <span class="toggle-title">Modo Oscuro</span>
            <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
        </div>
    </div>
</nav>
