$(document).ready(function () {
    var capacidadSelect = $("#capacidad-select");
    var ultimaVersion = null;
    var intervalID;

    function obtenerCapacidades() {
        $.ajax({
            url: "/obtener-capacidades",
            type: "GET",
            dataType: "json",
            data: { version: ultimaVersion },
            success: function (data) {
                var selectedValue = capacidadSelect.val();

                capacidadSelect.empty();

                capacidadSelect.append(
                    '<option value="">Selecciona la capacidad</option>'
                );

                $.each(data, function (key, value) {
                    capacidadSelect.append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nombre +
                            "</option>"
                    );
                });

                if (selectedValue) {
                    capacidadSelect.val(selectedValue);
                } else {
                    capacidadSelect.val("");
                }

                ultimaVersion = data.version;

                clearInterval(intervalID);
            },
        });
    }

    obtenerCapacidades();

    intervalID = setInterval(obtenerCapacidades, 1000);

    const formCapacidad = $("#capacidadForm");
    const nombreCapacidadInput = $("#capacidad-input");
    const invalidNombreCapacidadFeedback = $(".invalid-feedback-capacidad");
    const tablaCapacidades = $("#tabla-capacidades");

    nombreCapacidadInput.on("input", () => {
        nombreCapacidadInput.removeClass("is-invalid");
        invalidNombreCapacidadFeedback.hide();
    });

    $("#subirModalCapacidad").on("hidden.bs.modal", function () {
        formCapacidad[0].reset();
        nombreCapacidadInput.removeClass("is-invalid");
        invalidNombreCapacidadFeedback.hide();
    });

    $("#subirModalCapacidad").on("shown.bs.modal", function () {
        formCapacidad.off("submit");

        formCapacidad.on("submit", function (event) {
            event.preventDefault();
            const nombreInput = nombreCapacidadInput.val();

            if (!nombreInput) {
                nombreCapacidadInput.addClass("is-invalid");
                invalidNombreCapacidadFeedback.show();
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: formCapacidad.attr("action"),
                    type: "POST",
                    data: formCapacidad.serialize(),
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
                                            '<button type="button" class="btn btn-danger btn-eliminar-capacidad" data-bs-toggle="modal" ' +
                                            'data-bs-target="#confirmarEliminacionCapacidad" data-id="' +
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

                            tablaCapacidades.find("tbody").prepend(nuevaFila);

                            obtenerCapacidades();

                            formCapacidad.trigger("reset");
                            if (response.data.wasRecentlyCreated) {
                                $("#mensaje-success-capacidad")
                                    .removeClass("text-success")
                                    .addClass("text-danger")
                                    .text(response.message)
                                    .show();
                                $("#mensaje-error-capacidad").hide();
                            } else {
                                $("#mensaje-success-capacidad").hide();
                                $("#mensaje-error-capacidad")
                                    .removeClass("text-danger")
                                    .addClass("text-success")
                                    .text(response.message)
                                    .show();
                            }
                            setTimeout(function () {
                                $("#mensaje-success-capacidad").hide();
                                $("#mensaje-error-capacidad").hide();
                            }, 3000);
                        } else {
                            $("#mensaje-success-capacidad").hide();
                            $("#mensaje-error-capacidad")
                                .removeClass("text-success")
                                .addClass("text-danger")
                                .text("No se pudo guardar: " + response.error)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-error-capacidad").hide();
                            }, 3000);
                        }
                    },
                    error: function (xhr) {
                        $("#mensaje-success-capacidad").hide();
                        $("#mensaje-error-capacidad")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text("Error en la solicitud")
                            .show();
                    },
                });
            }
        });
    });

    var confirmarModalCapacidad = $("#confirmarEliminacionCapacidad");
    var subirModalCapacidad = $("#subirModalCapacidad");

    tablaCapacidades.on("click", ".btn-eliminar-capacidad", function (event) {
        event.preventDefault();

        var capacidadId = $(this).data("id");
        var capacidadNombre = $(this).data("nombre");
        var row = $(this).closest("tr");

        $("#btn-confirmar-eliminacion-capacidad")
            .data("capacidad-id", capacidadId)
            .data("capacidad-nombre", capacidadNombre);

        $("#nombre-capacidad").text(capacidadNombre);

        confirmarModalCapacidad.modal("show");
    });

    $("#btn-confirmar-eliminacion-capacidad").click(function () {
        var capacidadId = $(this).data("capacidad-id");
        var capacidadNombre = $(this).data("capacidad-nombre");
        var row = $(".btn-eliminar-capacidad[data-id='" + capacidadId + "']").closest(
            "tr"
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/eliminar/capacidad/" + capacidadId,
            type: "DELETE",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    row.remove();
                    capacidadSelect
                        .find('option[value="' + capacidadId + '"]')
                        .remove();

                    $("#mensaje-eliminado-capacidad")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .text(response.message)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-capacidad").hide();
                    }, 3000);

                    confirmarModalCapacidad.modal("hide");
                } else {
                    confirmarModalCapacidad.modal("hide");
                    $("#mensaje-eliminado-capacidad")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .text(response.error)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-capacidad").hide();
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                confirmarModalCapacidad.modal("hide");
                $("#mensaje-eliminado-capacidad")
                    .removeClass("text-success")
                    .addClass("text-danger")
                    .text("No se puede eliminar esta capacidad")
                    .show();
                setTimeout(function () {
                    $("#mensaje-eliminado-capacidad").hide();
                }, 3000);
            },
        });
    });

    confirmarModalCapacidad.on("hidden.bs.modal", function () {
        subirModalCapacidad.modal("show");
    });
});
