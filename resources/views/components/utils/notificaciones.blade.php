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
    <div class="notificacion">
        <div id="alertElement" class="alert alert-danger fade show alert-custom" role="alert">
            {{ session('error') }}
        </div>
    </div>
@endif
