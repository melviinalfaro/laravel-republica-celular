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
                                .append($("<td class='td-modal'>").text(response.data.nombre))
                                .append(
                                    $("<td class='td-modal'>").html(
                                        '<div class="d-flex flex-column align-items-center">' +
                                            '<div class="btn-group m-1" role="group">' +
                                            '<button type="button" class="btn btn-danger btn-eliminar-capacidad" data-id="' +
                                            response.data.id +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            tablaCapacidades.find("tbody").append(nuevaFila);

                            obtenerCapacidades();

                            formCapacidad.trigger("reset");
                            $("#mensaje-success-capacidad")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-capacidad").hide();
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

        $(document).off("click", ".btn-eliminar-capacidad");

        $(document).on("click", ".btn-eliminar-capacidad", function (event) {
            event.preventDefault();

            var capacidadId = $(this).data("id");
            var row = $(this).closest("tr");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                            .text("Capacidad eliminada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-capacidad").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar la capacidad");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
