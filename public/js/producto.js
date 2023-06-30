const productoForm = document.querySelector("#productoForm");
const nombreProductoInput = document.querySelector("#nombre-producto-input");
const invalidNombreProductoFeedback = document.querySelector(
    ".invalid-feedback-nombre"
);
const imagenProductoInput = document.querySelector("#image-producto-input");
const invalidImagenProductoFeedback = document.querySelector(
    ".invalid-feedback-imagen"
);

nombreProductoInput.addEventListener("input", () => {
    clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
});

imagenProductoInput.addEventListener("change", () => {
    const fileName = imagenProductoInput.files[0]?.name;
    const uploadName = document.querySelector(".image-producto-name");
    uploadName.textContent = fileName;
    clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
});

const modalProducto = document.querySelector("#subirModalProducto");

modalProducto.addEventListener("hidden.bs.modal", function () {
    resetModal();
});

function resetModal() {
    const nombreProductoInput = document.querySelector(
        "#nombre-producto-input"
    );
    const invalidNombreProductoFeedback = document.querySelector(
        ".invalid-feedback-nombre"
    );
    const imagenProductoInput = document.querySelector("#image-producto-input");
    const invalidImagenProductoFeedback = document.querySelector(
        ".invalid-feedback-imagen"
    );

    nombreProductoInput.value = "";
    imagenProductoInput.value = "";

    clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
    clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
}

productoForm.addEventListener("submit", function (event) {
    event.preventDefault();

    if (!nombreProductoInput.value) {
        showInputError(nombreProductoInput, invalidNombreProductoFeedback);
    } else if (
        !imagenProductoInput.files ||
        imagenProductoInput.files.length === 0
    ) {
        showInputError(imagenProductoInput, invalidImagenProductoFeedback);
    } else if (!productoForm.checkValidity()) {
        alert("Por favor complete todos los campos requeridos");
    } else {
        const buttonProducto = document.querySelector("button[id='subir']");
        buttonProducto.innerHTML = "Cargando...";
        buttonProducto.classList.add("disabled");
        productoForm.submit();
    }
});

function showInputError(inputElement, feedbackElement) {
    inputElement.classList.add("is-invalid");
    feedbackElement.style.display = "block";
}

function clearInputError(inputElement, feedbackElement) {
    inputElement.classList.remove("is-invalid");
    feedbackElement.style.display = "none";
}

function resetForm() {
    productoForm.reset();
    clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
    clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
}
