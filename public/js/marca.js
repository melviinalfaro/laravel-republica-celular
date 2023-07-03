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
                                .append($("<td class='td-modal'>").text(response.data.nombre))
                                .append(
                                    $("<td class='td-modal'>").html(
                                        '<div class="d-flex flex-column align-items-center">' +
                                            '<div class="btn-group m-1" role="group">' +
                                            '<button type="button" class="btn btn-danger btn-eliminar-marca" data-id="' +
                                            response.data.id +
                                            '">' +
                                            '<i class="material-icons-outlined">delete</i>' +
                                            "</button>" +
                                            "</div>" +
                                            "</div>"
                                    )
                                );

                            tablaMarcas.find("tbody").append(nuevaFila);

                            obtenerMarcas();

                            formMarca.trigger("reset");
                            $("#mensaje-success-marca")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            setTimeout(function () {
                                $("#mensaje-success-marca").hide();
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

        $(document).off("click", ".btn-eliminar-marca");

        $(document).on("click", ".btn-eliminar-marca", function (event) {
            event.preventDefault();

            var marcaId = $(this).data("id");
            var row = $(this).closest("tr");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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

                        $("#mensaje-eliminado-marca")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Marca eliminada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-eliminado-marca").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo eliminar la marca");
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud");
                },
            });
        });
    });
});
