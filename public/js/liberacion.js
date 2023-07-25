$(document).ready(function () {
    var liberacionSelect = $("#liberacion-select");
    var ultimaVersion = null;
    var intervalID;

    function obtenerLiberaciones() {
        $.ajax({
            url: "/obtener-liberaciones",
            type: "GET",
            dataType: "json",
            data: { version: ultimaVersion },
            success: function (data) {
                var selectedValue = liberacionSelect.val();

                liberacionSelect.empty();

                liberacionSelect.append(
                    '<option value="">Selecciona la liberación</option>'
                );

                $.each(data, function (key, value) {
                    liberacionSelect.append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nombre +
                            "</option>"
                    );
                });

                if (selectedValue) {
                    liberacionSelect.val(selectedValue);
                } else {
                    liberacionSelect.val("");
                }

                ultimaVersion = data.version;

                clearInterval(intervalID);
            },
        });
    }

    obtenerLiberaciones();

    intervalID = setInterval(obtenerLiberaciones, 1000);

    const formLiberacion = $("#liberacionForm");
    const nombreLiberacionInput = $("#liberacion-input");
    const invalidNombreLiberacionFeedback = $(".invalid-feedback-liberacion");
    const tablaLiberaciones = $("#tabla-liberaciones");

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
                                            '<button type="button" class="btn btn-danger btn-eliminar-liberacion" data-bs-toggle="modal" ' +
                                            'data-bs-target="#confirmarEliminacionLiberacion" data-id="' +
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

                            tablaLiberaciones.find("tbody").prepend(nuevaFila);

                            obtenerLiberaciones();

                            formLiberacion.trigger("reset");
                            if (response.data.wasRecentlyCreated) {
                                $("#mensaje-success-liberacion")
                                    .removeClass("text-success")
                                    .addClass("text-danger")
                                    .text(response.message)
                                    .show();
                                $("#mensaje-error-liberacion").hide();
                            } else {
                                $("#mensaje-success-liberacion").hide();
                                $("#mensaje-error-liberacion")
                                    .removeClass("text-danger")
                                    .addClass("text-success")
                                    .text(response.message)
                                    .show();
                            }
                            setTimeout(function () {
                                $("#mensaje-success-liberacion").hide();
                                $("#mensaje-error-liberacion").hide();
                            }, 3000);
                        } else {
                            $("#mensaje-success-liberacion").hide();
                            $("#mensaje-error-liberacion")
                                .removeClass("text-success")
                                .addClass("text-danger")
                                .text("No se pudo guardar: " + response.error)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-error-liberacion").hide();
                            }, 3000);
                        }
                    },
                    error: function (xhr) {
                        $("#mensaje-success-liberacion").hide();
                        $("#mensaje-error-liberacion")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text("Error en la solicitud")
                            .show();
                    },
                });
            }
        });
    });

    var confirmarModalLiberacion = $("#confirmarEliminacionLiberacion");
    var subirModalLiberacion = $("#subirModalLiberacion");

    tablaLiberaciones.on("click", ".btn-eliminar-liberacion", function (event) {
        event.preventDefault();

        var liberacionId = $(this).data("id");
        var liberacionNombre = $(this).data("nombre");
        var row = $(this).closest("tr");

        $("#btn-confirmar-eliminacion-liberacion")
            .data("liberacion-id", liberacionId)
            .data("liberacion-nombre", liberacionNombre);

        $("#nombre-liberacion").text(liberacionNombre);

        confirmarModalLiberacion.modal("show");
    });

    $("#btn-confirmar-eliminacion-liberacion").click(function () {
        var liberacionId = $(this).data("liberacion-id");
        var liberacionNombre = $(this).data("liberacion-nombre");
        var row = $(".btn-eliminar-liberacion[data-id='" + liberacionId + "']").closest(
            "tr"
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/eliminar/liberacion/" + liberacionId,
            type: "DELETE",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    row.remove();
                    liberacionSelect
                        .find('option[value="' + liberacionId + '"]')
                        .remove();

                    $("#mensaje-eliminado-liberacion")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .text(response.message)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-liberacion").hide();
                    }, 3000);

                    confirmarModalLiberacion.modal("hide");
                } else {
                    confirmarModalLiberacion.modal("hide");
                    $("#mensaje-eliminado-liberacion")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .text(response.error)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-liberacion").hide();
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                confirmarModalLiberacion.modal("hide");
                $("#mensaje-eliminado-liberacion")
                    .removeClass("text-success")
                    .addClass("text-danger")
                    .text("No se puede eliminar esta liberación")
                    .show();
                setTimeout(function () {
                    $("#mensaje-eliminado-liberacion").hide();
                }, 3000);
            },
        });
    });

    confirmarModalLiberacion.on("hidden.bs.modal", function () {
        subirModalLiberacion.modal("show");
    });
});
