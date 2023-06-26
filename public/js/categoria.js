$(document).ready(function () {
    const formCategoria = $("#categoriaForm");
    const nombreCategoriaInput = $("#categoria-input");
    const invalidNombreCategoriaFeedback = $(".invalid-feedback-categoria");

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
                            $("#mensaje-success-categoria")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            formCategoria.trigger("reset");

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

                            $("#subirModalCategoria")
                                .find("tbody")
                                .prepend(nuevaFila);

                            $("#mensaje-success-categoria")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text("Categoría guardada exitosamente.")
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
                        $("#mensaje-eliminado-categoria")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Categoría eliminada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-categoria").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar la categoría: ");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
