const form = document.querySelector("#productoForm");
const nombreInput = document.querySelector("#nombre-input");
const invalidNombreFeedback = document.querySelector(
    ".invalid-feedback-nombre"
);
const imagenInput = document.querySelector("#image-upload-input");
const invalidImagenFeedback = document.querySelector(
    ".invalid-feedback-imagen"
);

nombreInput.addEventListener("input", () => {
    nombreInput.classList.remove("is-invalid");
    invalidNombreFeedback.style.display = "none";
});

imagenInput.addEventListener("change", () => {
    const fileName = imagenInput.files[0]?.name;
    const uploadName = document.querySelector(".image-upload-name");
    uploadName.textContent = fileName;
    imagenInput.classList.remove("is-invalid");
    invalidImagenFeedback.style.display = "none";
});

const modal = document.querySelector("#productoForm");

modal.addEventListener("hidden.bs.modal", function () {
    form.reset();
    nombreInput.classList.remove("is-invalid");
    invalidNombreFeedback.style.display = "none";
    imagenInput.classList.remove("is-invalid");
    invalidImagenFeedback.style.display = "none";
});

form.addEventListener("submit", function (event) {
    const button = document.querySelector("button[id='subir']");

    if (!nombreInput.value) {
        event.preventDefault();
        nombreInput.classList.add("is-invalid");
        invalidNombreFeedback.style.display = "block";
    } else if (!imagenInput.files || imagenInput.files.length === 0) {
        event.preventDefault();
        imagenInput.classList.add("is-invalid");
        invalidImagenFeedback.style.display = "block";
    } else {
        if (!form.checkValidity()) {
            alert("Por favor complete todos los campos requeridos");
        } else {
            button.innerHTML = "Cargando...";
            button.classList.add("disabled");
            form.submit();
        }
    }
});
