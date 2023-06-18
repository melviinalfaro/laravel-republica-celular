@if (session('success'))
    <figure class="notificacion">
        <div class="cuerpo">
            <i class="material-icons-round icono">check_circle</i>
            {{ session('success') }}
        </div>
        <div class="progreso"></div>
    </figure>
@endif


@if (session('error'))
    <figure class="notificacion">
        <div class="cuerpo">
            <i class="material-icons-round icono">check_circle</i>
            {{ session('error') }}
        </div>
        <div class="progreso"></div>
    </figure>
@endif
