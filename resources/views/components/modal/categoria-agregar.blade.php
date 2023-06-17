<div class="modal fade" id="subirModalCategoria" tabindex="-1" aria-labelledby="subirModalLabel" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-color" id="exampleModalLabel">Categorías</h1>
                <button class="btn-cerrar">
                    <i class="icon material-icons-round" data-bs-dismiss="modal">close</i>
                </button>
            </div>
            <form id="carruselForm" method="POST" action="" class="form" enctype="multipart/form-data"
                novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 text-color">Mostrar categorías</div>
                            <div class="col-md-6 text-color">Agregar categoría</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="subir" type="submit" class="btn btn-primary">Guardar categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>
