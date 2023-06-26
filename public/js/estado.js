$(document).ready(function () {
    const formEstado = $("#estadoForm");
    const nombreEstadoInput = $("#estado-input");
    const invalidNombreEstadoFeedback = $(".invalid-feedback-estado");

    nombreEstadoInput.on("input", () => {
        nombreEstadoInput.removeClass("is-invalid");
        invalidNombreEstadoFeedback.hide();
    });

    $("#subirModalEstado").on("hidden.bs.modal", function () {
        formEstado[0].reset();
        nombreEstadoInput.removeClass("is-invalid");
        invalidNombreEstadoFeedback.hide();
    });

    $("#subirModalEstado").on("shown.bs.modal", function () {
        formEstado.off("submit");

        formEstado.on("submit", function (event) {
            event.preventDefault();
            const nombreInput = nombreEstadoInput.val();

            if (!nombreInput) {
                nombreEstadoInput.addClass("is-invalid");
                invalidNombreEstadoFeedback.show();
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: formEstado.attr("action"),
                    type: "POST",
                    data: formEstado.serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#mensaje-success-estado")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            formEstado.trigger("reset");

                            var nuevaFila = $("<tr>")
                                .append(
                                    $("<td class='td-modal'>").text(
                                        response.data.nombre
                                    )
                                )
                                .append(
                                    $("<td class='td-modal'>").html(
                                        '<div class="d-flex flex-column align-items-center">' +
                                            '<div class="btn-group m-1" role="group">' +
                                            '<button type="button" class="btn btn-danger btn-eliminar-estado" data-id="' +
                                            response.data.id +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            $("#subirModalEstado")
                                .find("tbody")
                                .prepend(nuevaFila);

                            $("#mensaje-success-estado")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text("Estado guardado exitosamente.")
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-estado").hide();
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

        $(document).off("click", ".btn-eliminar-estado");

        $(document).on("click", ".btn-eliminar-estado", function (event) {
            event.preventDefault();

            var estadoId = $(this).data("id");
            var row = $(this).closest("tr");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/eliminar/estado/" + estadoId,
                type: "DELETE",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        row.remove();
                        $("#mensaje-eliminado-estado")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Estado eliminado exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-estado").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar el estado");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
