<nav class="navbar navbar-expand-lg sticky-top pb-3">
    <div class="container-lg">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" width="35" height="35"
                    class="d-inline-block align-text-top">
                <span class="text-color">República celular</span>
            </a>
        </div>
        <h4>@yield('title')</h4>
        <div class="navbar-nav ml-auto align-items-center">
            <div class="d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="btn btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        data-bs-auto-close="false">
                        <span class="text-color name-user">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li class="nav-item">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons-outlined dropdown-icon">person</i>
                                    <span>Mi perfil</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item toggle-darkmode">
                            <div class="dropdown-item d-flex align-items-center">
                                <i class="material-icons-outlined dropdown-icon dark">dark_mode</i>
                                <i class="material-icons-outlined dropdown-icon light">light_mode</i>
                                <div class="toggle-switch2" id="toggle-switch-nav2">
                                    <div class="toggle-container d-flex align-items-center">
                                        <span class="mode-text mr-1">Oscuro</span>
                                        <span class="switch2"></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons-outlined dropdown-icon">settings</i>
                                    <span>Configuración</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('cerrar.sesion') }}">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons-outlined dropdown-icon">logout</i>
                                    <span>Cerrar sesión</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>
    </div>
</nav>
