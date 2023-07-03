$(document).ready(function () {
    var categoriaSelect = $("#categoria-select");
    var ultimaVersion = null;
    var intervalID;

    function obtenerCategorias() {
        $.ajax({
            url: "/obtener-categorias",
            type: "GET",
            dataType: "json",
            data: { version: ultimaVersion },
            success: function (data) {
                var selectedValue = categoriaSelect.val();

                categoriaSelect.empty();

                categoriaSelect.append(
                    '<option value="">Selecciona la categoría</option>'
                );

                $.each(data, function (key, value) {
                    categoriaSelect.append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nombre +
                            "</option>"
                    );
                });

                if (selectedValue) {
                    categoriaSelect.val(selectedValue);
                } else {
                    categoriaSelect.val("");
                }

                ultimaVersion = data.version;

                clearInterval(intervalID);
            },
        });
    }

    obtenerCategorias();

    intervalID = setInterval(obtenerCategorias, 1000);

    const formCategoria = $("#categoriaForm");
    const nombreCategoriaInput = $("#categoria-input");
    const invalidNombreCategoriaFeedback = $(".invalid-feedback-categoria");
    const tablaCategorias = $("#tabla-categorias");

    nombreCategoriaInput.on("input", () => {
        nombreCategoriaInput.removeClass("is-invalid");
        invalidNombreCategoriaFeedback.hide();
    });

    $("#subirModalCategoria").on("hidden.bs.modal", function () {
        formCategoria[0].reset();
        nombreCategoriaInput.removeClass("is-invalid");
        invalidNombreCategoriaFeedback.hide();
    });

    $("#subirModalCategoria").on("shown.bs.modal", function () {
        formCategoria.off("submit");

        formCategoria.on("submit", function (event) {
            event.preventDefault();
            const nombreInput = nombreCategoriaInput.val();

            if (!nombreInput) {
                nombreCategoriaInput.addClass("is-invalid");
                invalidNombreCategoriaFeedback.show();
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: formCategoria.attr("action"),
                    type: "POST",
                    data: formCategoria.serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            var nuevaFila = $("<tr>")
                                .append($("<td class='td-modal'>").text(response.data.nombre))
                                .append(
                                    $("<td class='td-modal'>").html(
                                        '<div class="d-flex flex-column align-items-center">' +
                                            '<div class="btn-group m-1" role="group">' +
                                            '<button type="button" class="btn btn-danger btn-eliminar-categoria" data-id="' +
                                            response.data.id +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            tablaCategorias.find("tbody").append(nuevaFila);

                            obtenerCategorias();

                            formCategoria.trigger("reset");
                            $("#mensaje-success-categoria")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-categoria").hide();
                            }, 4000);
                        } else {
                            alert("No se pudo guardar");
                        }
                    },
                    error: function (xhr) {
                        alert("Error en la solicitud");
                    },
                });
            }
        });

        $(document).off("click", ".btn-eliminar-categoria");

        $(document).on("click", ".btn-eliminar-categoria", function (event) {
            event.preventDefault();

            var categoriaId = $(this).data("id");
            var row = $(this).closest("tr");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/eliminar/categoria/" + categoriaId,
                type: "DELETE",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        row.remove();
                        categoriaSelect
                            .find('option[value="' + categoriaId + '"]')
                            .remove();

                        $("#mensaje-eliminado-categoria")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Categoría eliminada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-categoria").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar la categoría");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
