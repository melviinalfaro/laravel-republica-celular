$(document).ready(function () {
    var estadoSelect = $("#estado-select");
    var ultimaVersion = null;
    var intervalID;

    function obtenerEstados() {
        $.ajax({
            url: "/obtener-estados",
            type: "GET",
            dataType: "json",
            data: { version: ultimaVersion },
            success: function (data) {
                var selectedValue = estadoSelect.val();

                estadoSelect.empty();

                estadoSelect.append(
                    '<option value="">Selecciona el estado</option>'
                );

                $.each(data, function (key, value) {
                    estadoSelect.append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nombre +
                            "</option>"
                    );
                });

                if (selectedValue) {
                    estadoSelect.val(selectedValue);
                } else {
                    estadoSelect.val("");
                }

                ultimaVersion = data.version;

                clearInterval(intervalID);
            },
        });
    }

    obtenerEstados();

    intervalID = setInterval(obtenerEstados, 1000);

    const formEstado = $("#estadoForm");
    const nombreEstadoInput = $("#estado-input");
    const invalidNombreEstadoFeedback = $(".invalid-feedback-estado");
    const tablaEstados = $("#tabla-estados");

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
                                            '<button type="button" class="btn btn-danger btn-eliminar-estado" data-bs-toggle="modal" ' +
                                            'data-bs-target="#confirmarEliminacionEstado" data-id="' +
                                            response.data.id +
                                            '" data-nombre="' +
                                            response.data.nombre +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            tablaEstados.find("tbody").prepend(nuevaFila);

                            obtenerEstados();

                            formEstado.trigger("reset");
                            if (response.data.wasRecentlyCreated) {
                                $("#mensaje-success-estado")
                                    .removeClass("text-success")
                                    .addClass("text-danger")
                                    .text(response.message)
                                    .show();
                                $("#mensaje-error-estado").hide();
                            } else {
                                $("#mensaje-success-estado").hide();
                                $("#mensaje-error-estado")
                                    .removeClass("text-danger")
                                    .addClass("text-success")
                                    .text(response.message)
                                    .show();
                            }
                            setTimeout(function () {
                                $("#mensaje-success-estado").hide();
                                $("#mensaje-error-estado").hide();
                            }, 3000);
                        } else {
                            $("#mensaje-success-estado").hide();
                            $("#mensaje-error-estado")
                                .removeClass("text-success")
                                .addClass("text-danger")
                                .text("No se pudo guardar: " + response.error)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-error-estado").hide();
                            }, 3000);
                        }
                    },
                    error: function (xhr) {
                        $("#mensaje-success-estado").hide();
                        $("#mensaje-error-estado")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text("Error en la solicitud")
                            .show();
                    },
                });
            }
        });
    });

    var confirmarModalEstado = $("#confirmarEliminacionEstado");
    var subirModalEstado = $("#subirModalEstado");

    tablaEstados.on("click", ".btn-eliminar-estado", function (event) {
        event.preventDefault();

        var estadoId = $(this).data("id");
        var estadoNombre = $(this).data("nombre");
        var row = $(this).closest("tr");

        $("#btn-confirmar-eliminacion-estado")
            .data("estado-id", estadoId)
            .data("estado-nombre", estadoNombre);

        $("#nombre-estado").text(estadoNombre);

        confirmarModalEstado.modal("show");
    });

    $("#btn-confirmar-eliminacion-estado").click(function () {
        var estadoId = $(this).data("estado-id");
        var estadoNombre = $(this).data("estado-nombre");
        var row = $(
            ".btn-eliminar-estado[data-id='" + estadoId + "']"
        ).closest("tr");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/eliminar/estado/" + estadoId,
            type: "DELETE",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    row.remove();
                    estadoSelect
                        .find('option[value="' + estadoId + '"]')
                        .remove();

                    $("#mensaje-eliminado-estado")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .text(response.message)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-estado").hide();
                    }, 3000);

                    confirmarModalEstado.modal("hide");
                } else {
                    confirmarModalEstado.modal("hide");
                    $("#mensaje-eliminado-estado")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .text(response.error)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-estado").hide();
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                confirmarModalEstado.modal("hide");
                $("#mensaje-eliminado-estado")
                    .removeClass("text-success")
                    .addClass("text-danger")
                    .text("No se puede eliminar este estado")
                    .show();
                setTimeout(function () {
                    $("#mensaje-eliminado-estado").hide();
                }, 3000);
            },
        });
    });

    confirmarModalEstado.on("hidden.bs.modal", function () {
        subirModalEstado.modal("show");
    });
});
