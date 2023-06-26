$(document).ready(function () {
    const formLiberacion = $("#liberacionForm");
    const nombreLiberacionInput = $("#liberacion-input");
    const invalidNombreLiberacionFeedback = $(".invalid-feedback-liberacion");

    nombreLiberacionInput.on("input", () => {
        nombreLiberacionInput.removeClass("is-invalid");
        invalidNombreLiberacionFeedback.hide();
    });

    $("#subirModalLiberacion").on("hidden.bs.modal", function () {
        formLiberacion[0].reset();
        nombreLiberacionInput.removeClass("is-invalid");
        invalidNombreLiberacionFeedback.hide();
    });

    $("#subirModalLiberacion").on("shown.bs.modal", function () {
        formLiberacion.off("submit");

        formLiberacion.on("submit", function (event) {
            event.preventDefault();
            const nombreInput = nombreLiberacionInput.val();

            if (!nombreInput) {
                nombreLiberacionInput.addClass("is-invalid");
                invalidNombreLiberacionFeedback.show();
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: formLiberacion.attr("action"),
                    type: "POST",
                    data: formLiberacion.serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#mensaje-success-liberacion")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            formLiberacion.trigger("reset");

                            var nuevaFila = $("<tr>")
                                .append(
                                    $(
                                        "<td class='td-modal'>"
                                    ).text(response.data.nombre)
                                )
                                .append(
                                    $("<td class='td-modal'>").html(
                                        '<div class="d-flex flex-column align-items-center">' +
                                            '<div class="btn-group m-1" role="group">' +
                                            '<button type="button" class="btn btn-danger btn-eliminar-liberacion" data-id="' +
                                            response.data.id +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            $("#subirModalLiberacion")
                                .find("tbody")
                                .prepend(nuevaFila);

                            $("#mensaje-success-liberacion")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text("Liberación guardada exitosamente.")
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-liberacion").hide();
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

        $(document).off("click", ".btn-eliminar-liberacion");

        $(document).on("click", ".btn-eliminar-liberacion", function (event) {
            event.preventDefault();

            var liberacionId = $(this).data("id");
            var row = $(this).closest("tr");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/eliminar/liberacion/" + liberacionId,
                type: "DELETE",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        row.remove();
                        $("#mensaje-eliminado-liberacion")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Liberación eliminada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-liberacion").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar la liberación");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
