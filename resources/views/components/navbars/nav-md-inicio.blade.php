<div class="navigation-container">
    <nav class="navigation-bottom left">
        <a href="{{ route('admin') }}" class="tab {{ Request::is('admin') ? 'active' : '' }}">
            <i class="icon material-icons-outlined">home</i>
            <p>Inicio</p>
        </a>
        <a href="#" class="tab">
            <i class="icon material-icons-outlined">shopping_bag</i>
            <p>Venta</p>
        </a>
        <a href="{{ route('productos') }}" class="tab {{ Request::is('productos') ? 'active' : '' }}">
            <i class="icon material-icons-outlined">inventory_2</i>
            <p>Inventario</p>
        </a>
        <a href="#" class="tab">
            <i class="icon material-icons-outlined">delivery_dining</i>
            <p>Entregas</p>
        </a>
        <a href="#" class="tab">
            <i class="icon material-icons-outlined">account_circle</i>
            <p>Usuarios</p>
        </a>
    </nav>
    <nav class="navigation-bottom right">
        <div class="dropdown-add dropup">
            <button class="btn btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons-outlined dropdown-icon-list">add_circle_outline</i>
                <span>Agregar</span>
            </button>
            <ul class="dropdown-menu dropdown-bottom dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('ver.carrusel') }}">
                        <i class="material-icons-outlined dropdown-icon">category</i>
                        <span>Carrusel</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('productos') }}">
                        <i class="material-icons-outlined dropdown-icon">inventory</i>
                        <span>Producto</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
