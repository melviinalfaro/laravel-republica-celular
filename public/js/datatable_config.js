var itemsPerPage = 9;

function updatePaginationLinks() {
    var paginationLinks = document.querySelectorAll(".pagination a");
    paginationLinks.forEach(function (link) {
        var href = link.getAttribute("href");
        if (href.includes("items=")) {
            href = href.replace(/items=\d+/, "items=" + itemsPerPage);
        } else {
            href = href.includes("?")
                ? href + "&items=" + itemsPerPage
                : href + "?items=" + itemsPerPage;
        }
        link.setAttribute("href", href);
    });
}

function initDataTable() {
    var table = new DataTable("#miTabla", {
        language: {
            processing: "Procesando...",
            search: "",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros en total)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron registros coincidentes.",
            emptyTable: "No se encontro ningún registro",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último",
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna en orden ascendente",
                sortDescending: ": Activar para ordenar la columna en orden descendente",
            },
        },
        paging: false,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: false,
        autoWidth: true,
    });

    var searchWrapper = $('<div class="search-wrapper"></div>');
    var searchInput = $(
        '<input type="search" class="form-control" placeholder="Buscar producto" autocomplete="off">'
    );
    var searchIcon = $('<i class="material-icons-outlined">search</i>');

    searchWrapper.css("position", "relative");
    searchInput.css("padding-right", "25px");
    searchIcon.css({
        position: "absolute",
        top: "50%",
        right: "10px",
        transform: "translateY(-50%)",
        color: "var(--text-color)",
        "pointer-events": "none",
    });

    searchInput.on("keyup", function () {
        table.search($(this).val()).draw();
    });

    searchWrapper.append(searchInput);
    searchWrapper.append(searchIcon);

    $(".dataTables_filter").empty().append(searchWrapper);

    $(document).on("click", function (event) {
        var targetElement = event.target;

        if (
            !searchInput.is(targetElement) &&
            !searchInput.has(targetElement).length
        ) {
            searchInput.val("");
            table.search("").draw();
        }
    });
}

$(document).ready(function () {
    initDataTable();
    updatePaginationLinks();
});

window.addEventListener("resize", function () {
    updatePaginationLinks();
});
