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
                        $("#mensaje-success")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text(response.message)
                            .show();
                        formMarca.trigger("reset");

                        var nuevaFila = $("<tr>")
                            .append($("<td>").text(response.data.nombre))
                            .append(
                                $("<td>").html(
                                    '<div class="d-flex flex-column align-items-center">' +
                                        '<div class="btn-group m-1" role="group">' +
                                        '<button type="button" class="btn btn-light btn-eliminar" data-id="' +
                                        response.data.id +
                                        '">' +
                                        '<i class="material-icons-outlined">delete</i>' +
                                        "</button>" +
                                        "</div>" +
                                        "</div>"
                                )
                            );

                        $("#subirModalMarca").find("tbody").append(nuevaFila);

                        $("#mensaje-success")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("Marca guardada exitosamente.")
                            .show();
                        setTimeout(function () {
                            $("#mensaje-success").hide();
                        }, 4000);
                    } else {
                        alert("No se pudo guardar: " + response.error);
                    }
                },
                error: function (xhr) {
                    alert("Error en la solicitud AJAX: " + xhr.responseText);
                },
            });
        }
    });

    $(document).on("click", ".btn-eliminar", function (event) {
        event.preventDefault();

        var marcaId = $(this).data("id");
        var row = $(this).closest("tr");

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
                    $("#mensaje-eliminado")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .text("Marca eliminada exitosamente.")
                        .show();
                    setTimeout(function () {
                        $("#mensaje-eliminado").hide();
                    }, 4000);
                } else {
                    alert("No se pudo eliminar la marca: " + response.error);
                }
            },
            error: function (xhr) {
                alert("Error en la solicitud AJAX: " + xhr.responseText);
            },
        });
    });
});
