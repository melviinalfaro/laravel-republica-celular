$(document).ready(function () {
    const form = $("#productoForm");
    const nombreInput = $("#nombre-input");
    const invalidNombreFeedback = $(".invalid-feedback-nombre");
    const imagenInput = $("#image-upload-input");
    const invalidImagenFeedback = $(".invalid-feedback-imagen");
    const modal = $("#subirModalProducto");
    const successMessage = $("#success-message");

    nombreInput.on("input", () => {
        nombreInput.removeClass("is-invalid");
        invalidNombreFeedback.hide();
    });

    imagenInput.on("change", function () {
        const fileName = $(this).val().split("\\").pop();
        const uploadName = $(this)
            .siblings(".file-upload-producto")
            .find(".image-upload-name");
        uploadName.text(fileName);
        imagenInput.removeClass("is-invalid");
        invalidImagenFeedback.hide();
    });

    modal.on("hidden.bs.modal", function () {
        form[0].reset();
        nombreInput.removeClass("is-invalid");
        invalidNombreFeedback.hide();
        imagenInput.removeClass("is-invalid");
        invalidImagenFeedback.hide();
    });

    form.on("submit", function (event) {
        event.preventDefault();

        const button = $("button[id='subir']");

        let isValid = true;

        if (nombreInput.val().trim() === "") {
            nombreInput.addClass("is-invalid");
            invalidNombreFeedback.show();
            isValid = false;
        }

        if (imagenInput.val().trim() === "") {
            imagenInput.addClass("is-invalid");
            invalidImagenFeedback.show();
            isValid = false;
        }

        if (isValid) {
            button.html("Cargando...");
            button.addClass("disabled");

            var formData = new FormData(form[0]);
            formData.append("imagen", imagenInput[0].files[0]);

            $.ajax({
                url: "/productos/registrar",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        modal.modal("hide");

                        var notification = document.createElement("figure");
                        notification.className = "notificacion";

                        var cuerpo = document.createElement("div");
                        cuerpo.className = "cuerpo";

                        var icono = document.createElement("i");
                        icono.className = "material-icons-round icono";
                        icono.textContent = "check_circle";

                        var mensaje = document.createTextNode(response.message);

                        cuerpo.appendChild(icono);
                        cuerpo.appendChild(mensaje);

                        notification.appendChild(cuerpo);

                        var progreso = document.createElement("div");
                        progreso.className = "progreso";

                        notification.appendChild(progreso);

                        var notificationContainer = document.getElementById(
                            "notificationContainer"
                        );
                        notificationContainer.appendChild(notification);

                        successMessage.text(response.message);
                        successMessage.show();

                        setTimeout(function () {
                            $(notification).fadeOut("slow", function () {
                                $(this).remove();
                                button.html("Guardar producto");
                                button.removeClass("disabled");
                                obtenerProductos();
                            });
                        }, 1200);
                    }
                },
                error: function (xhr) {
                    button.html("Guardar producto");
                    button.removeClass("disabled");
                },
            });
        }
    });

    obtenerProductos();
});
