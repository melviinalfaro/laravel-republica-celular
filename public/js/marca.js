$(document).ready(function () {
    var marcaSelect = $("#marca-select");
    var ultimaVersion = null;
    var intervalID;

    function obtenerMarcas() {
        $.ajax({
            url: "/obtener-marcas",
            type: "GET",
            dataType: "json",
            data: { version: ultimaVersion },
            success: function (data) {
                var selectedValue = marcaSelect.val();

                marcaSelect.empty();

                marcaSelect.append(
                    '<option value="">Selecciona la marca</option>'
                );

                $.each(data, function (key, value) {
                    marcaSelect.append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nombre +
                            "</option>"
                    );
                });

                if (selectedValue) {
                    marcaSelect.val(selectedValue);
                } else {
                    marcaSelect.val("");
                }

                ultimaVersion = data.version;

                clearInterval(intervalID);
            },
        });
    }

    obtenerMarcas();

    intervalID = setInterval(obtenerMarcas, 1000);

    const formMarca = $("#marcaForm");
    const nombreMarcaInput = $("#marca-input");
    const invalidNombreMarcaFeedback = $(".invalid-feedback-marca");
    const tablaMarcas = $("#tabla-marcas");

    nombreMarcaInput.on("input", () => {
        nombreMarcaInput.removeClass("is-invalid");
        invalidNombreMarcaFeedback.hide();
    });

    $("#subirModalMarca").on("hidden.bs.modal", function () {
        formMarca[0].reset();
        nombreMarcaInput.removeClass("is-invalid");
        invalidNombreMarcaFeedback.hide();
    });

    $("#subirModalMarca").on("shown.bs.modal", function () {
        formMarca.off("submit");

        formMarca.on("submit", function (event) {
            event.preventDefault();
            const nombreInput = nombreMarcaInput.val();

            if (!nombreInput) {
                nombreMarcaInput.addClass("is-invalid");
                invalidNombreMarcaFeedback.show();
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    url: formMarca.attr("action"),
                    type: "POST",
                    data: formMarca.serialize(),
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
                                            '<button type="button" class="btn btn-danger btn-eliminar-marca" data-bs-toggle="modal" ' +
                                            'data-bs-target="#confirmarEliminacionMarca" data-id="' +
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

                            tablaMarcas.find("tbody").prepend(nuevaFila);

                            obtenerMarcas();

                            formMarca.trigger("reset");
                            $("#mensaje-success-marca")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-marca").hide();
                            }, 2000);
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
    });

    var confirmarModalMarca = $("#confirmarEliminacionMarca");
    var subirModalMarca = $("#subirModalMarca");

    tablaMarcas.on("click", ".btn-eliminar-marca", function (event) {
        event.preventDefault();

        var marcaId = $(this).data("id");
        var marcaNombre = $(this).data("nombre");
        var row = $(this).closest("tr");

        $("#btn-confirmar-eliminacion")
            .data("marca-id", marcaId)
            .data("marca-nombre", marcaNombre);

        $("#nombre-marca").text(marcaNombre);

        confirmarModalMarca.modal("show");
    });

    $("#btn-confirmar-eliminacion").click(function () {
        var marcaId = $(this).data("marca-id");
        var marcaNombre = $(this).data("marca-nombre");
        var row = $(".btn-eliminar-marca[data-id='" + marcaId + "']").closest(
            "tr"
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/eliminar/marca/" + marcaId,
            type: "DELETE",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    row.remove();
                    marcaSelect
                        .find('option[value="' + marcaId + '"]')
                        .remove();

                    var mensajeExito = response.message;

                    $("#mensaje-eliminado-marca")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .text(mensajeExito)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-marca").hide();
                    }, 2000);

                    confirmarModalMarca.modal("hide");
                } else {
                    confirmarModalMarca.modal("hide");
                    $("#mensaje-eliminado-marca")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .text(response.error)
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado-marca").hide();
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                confirmarModalMarca.modal("hide");
                $("#mensaje-eliminado-marca")
                    .removeClass("text-success")
                    .addClass("text-danger")
                    .text("No se puede eliminar esta marca")
                    .show();
                setTimeout(function () {
                    $("#mensaje-eliminado-marca").hide();
                }, 2000);
            },
        });
    });

    confirmarModalMarca.on("hidden.bs.modal", function () {
        subirModalMarca.modal("show");
    });
});
