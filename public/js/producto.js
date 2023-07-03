const productoForm = document.querySelector("#productoForm");
const nombreProductoInput = document.querySelector("#nombre-producto-input");
const invalidNombreProductoFeedback = document.querySelector(
    ".invalid-feedback-nombre"
);
const precioProductoInput = document.querySelector("#precio-producto-input");
const invalidPrecioProductoFeedback = document.querySelector(
    ".invalid-feedback-precio"
);
const colorProductoInput = document.querySelector("#color-producto-input");
const invalidColorProductoFeedback = document.querySelector(
    ".invalid-feedback-color"
);
const stockProductoInput = document.querySelector("#stock-producto-input");
const invalidStockProductoFeedback = document.querySelector(
    ".invalid-feedback-stock"
);
const imagenProductoInput = document.querySelector("#image-producto-input");
const invalidImagenProductoFeedback = document.querySelector(
    ".invalid-feedback-imagen"
);
const descripcionProductoInput = document.querySelector("#descripcion-textarea");
const invalidDescripcionProductoFeedback = document.querySelector(
    ".invalid-feedback-descripcion"
);
const estadoSelect = document.querySelector("#estado-select");
const invalidEstadoFeedback = document.querySelector(
    ".invalid-feedback-estado"
);
const marcaSelect = document.querySelector("#marca-select");
const invalidMarcaFeedback = document.querySelector(".invalid-feedback-marca");
const capacidadSelect = document.querySelector("#capacidad-select");
const invalidCapacidadFeedback = document.querySelector(
    ".invalid-feedback-capacidad"
);
const categoriaSelect = document.querySelector("#categoria-select");
const invalidCategoriaFeedback = document.querySelector(
    ".invalid-feedback-categoria"
);
const liberacionSelect = document.querySelector("#liberacion-select");
const invalidLiberacionFeedback = document.querySelector(
    ".invalid-feedback-liberacion"
);

nombreProductoInput.addEventListener("input", () => {
    clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
});

precioProductoInput.addEventListener("input", () => {
    clearInputError(precioProductoInput, invalidPrecioProductoFeedback);
});

colorProductoInput.addEventListener("input", () => {
    clearInputError(colorProductoInput, invalidColorProductoFeedback);
});

stockProductoInput.addEventListener("input", () => {
    clearInputError(stockProductoInput, invalidStockProductoFeedback);
});

imagenProductoInput.addEventListener("change", () => {
    const fileName = imagenProductoInput.files[0]?.name;
    const uploadName = document.querySelector(".image-producto-name");
    uploadName.textContent = fileName;
    clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
});

descripcionProductoInput.addEventListener("input", () => {
    clearInputError(descripcionProductoInput, invalidDescripcionProductoFeedback);
});

estadoSelect.addEventListener("change", () => {
    clearInputError(estadoSelect, invalidEstadoFeedback);
});

marcaSelect.addEventListener("change", () => {
    clearInputError(marcaSelect, invalidMarcaFeedback);
});

capacidadSelect.addEventListener("change", () => {
    clearInputError(capacidadSelect, invalidCapacidadFeedback);
});

categoriaSelect.addEventListener("change", () => {
    clearInputError(categoriaSelect, invalidCategoriaFeedback);
});

liberacionSelect.addEventListener("change", () => {
    clearInputError(liberacionSelect, invalidLiberacionFeedback);
});

const modalProducto = document.querySelector("#subirModalProducto");

modalProducto.addEventListener("hidden.bs.modal", function () {
    resetModal();
});

function resetModal() {
    productoForm.reset();
    clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
    clearInputError(precioProductoInput, invalidPrecioProductoFeedback);
    clearInputError(colorProductoInput, invalidColorProductoFeedback);
    clearInputError(stockProductoInput, invalidStockProductoFeedback);
    clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
    clearInputError(descripcionProductoInput, invalidDescripcionProductoFeedback);
    clearInputError(estadoSelect, invalidEstadoFeedback);
    clearInputError(marcaSelect, invalidMarcaFeedback);
    clearInputError(capacidadSelect, invalidCapacidadFeedback);
    clearInputError(categoriaSelect, invalidCategoriaFeedback);
    clearInputError(liberacionSelect, invalidLiberacionFeedback);
}

productoForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const nombreValue = nombreProductoInput.value.trim();
    const precioValue = precioProductoInput.value.trim();
    const colorValue = colorProductoInput.value.trim();
    const stockValue = stockProductoInput.value.trim();
    const descripcionValue = descripcionProductoInput.value.trim();
    const imagenValue = imagenProductoInput.files[0];
    const estadoValue = estadoSelect.value;
    const marcaValue = marcaSelect.value;
    const capacidadValue = capacidadSelect.value;
    const categoriaValue = categoriaSelect.value;
    const liberacionValue = liberacionSelect.value;

    let isValid = true;

    if (!nombreValue) {
        showInputError(nombreProductoInput, invalidNombreProductoFeedback);
        isValid = false;
    } else {
        clearInputError(nombreProductoInput, invalidNombreProductoFeedback);
    }

    if (!precioValue) {
        showInputError(precioProductoInput, invalidPrecioProductoFeedback);
        isValid = false;
    } else {
        clearInputError(precioProductoInput, invalidPrecioProductoFeedback);
    }

    if (!colorValue) {
        showInputError(colorProductoInput, invalidColorProductoFeedback);
        isValid = false;
    } else {
        clearInputError(colorProductoInput, invalidColorProductoFeedback);
    }

    if (!stockValue) {
        showInputError(stockProductoInput, invalidStockProductoFeedback);
        isValid = false;
    } else {
        clearInputError(stockProductoInput, invalidStockProductoFeedback);
    }

    if (!imagenValue) {
        showInputError(imagenProductoInput, invalidImagenProductoFeedback);
        isValid = false;
    } else {
        clearInputError(imagenProductoInput, invalidImagenProductoFeedback);
    }

    if (!estadoValue) {
        showInputError(estadoSelect, invalidEstadoFeedback);
        isValid = false;
    } else {
        clearInputError(estadoSelect, invalidEstadoFeedback);
    }

    if (!marcaValue) {
        showInputError(marcaSelect, invalidMarcaFeedback);
        isValid = false;
    } else {
        clearInputError(marcaSelect, invalidMarcaFeedback);
    }

    if (!capacidadValue) {
        showInputError(capacidadSelect, invalidCapacidadFeedback);
        isValid = false;
    } else {
        clearInputError(capacidadSelect, invalidCapacidadFeedback);
    }

    if (!categoriaValue) {
        showInputError(categoriaSelect, invalidCategoriaFeedback);
        isValid = false;
    } else {
        clearInputError(categoriaSelect, invalidCategoriaFeedback);
    }

    if (!liberacionValue) {
        showInputError(liberacionSelect, invalidLiberacionFeedback);
        isValid = false;
    } else {
        clearInputError(liberacionSelect, invalidLiberacionFeedback);
    }

    if (!descripcionValue) {
        showInputError(descripcionProductoInput, invalidDescripcionProductoFeedback);
        isValid = false;
    } else {
        clearInputError(descripcionProductoInput, invalidDescripcionProductoFeedback);
    }

    if (isValid) {
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
