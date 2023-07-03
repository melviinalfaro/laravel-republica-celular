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
                                .append($("<td class='td-modal'>").text(response.data.nombre))
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

                            tablaEstados.find("tbody").append(nuevaFila);

                            obtenerEstados();

                            formEstado.trigger("reset");
                            $("#mensaje-success-estado")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
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
                        estadoSelect
                            .find('option[value="' + estadoId + '"]')
                            .remove();

                        $("#mensaje-eliminado-estado")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Estado eliminada exitosamente.")
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
