$(document).ready(function () {
    const formMarca = $("#marcaForm");
    const nombreMarcaInput = $("#marca-input");
    const invalidNombreMarcaFeedback = $(".invalid-feedback-marca");

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
                            $("#mensaje-success-marca")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text(response.message)
                                .show();
                            formMarca.trigger("reset");

                            var nuevaFila = $("<tr>")
                                .append(
                                    $(
                                        "<td style='vertical-align: middle;'>"
                                    ).text(response.data.nombre)
                                )
                                .append(
                                    $("<td>").html(
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

                            $("#subirModalMarca")
                                .find("tbody")
                                .append(nuevaFila);

                            $("#mensaje-success-marca")
                                .removeClass("text-danger")
                                .addClass("text-success")
                                .text("Marca guardada exitosamente.")
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
