// // Selección del formulario para agregar producto
// const form = document.querySelector("#productoForm");

// // Validación del input "Nombre"
// const nombreInput = document.querySelector("#nombre-input");
// const invalidNombreFeedback = document.querySelector(
//     ".invalid-feedback-nombre"
// );
// nombreInput.addEventListener("input", () => {
//     nombreInput.classList.remove("is-invalid");
//     invalidNombreFeedback.style.display = "none";
// });

// // Validación del select "Estado"
// const estadoSelect = document.querySelector("#estado-select");
// const invalidEstadoFeedback = document.querySelector(
//     ".invalid-feedback-estado"
// );
// estadoSelect.addEventListener("change", () => {
//     estadoSelect.classList.remove("is-invalid");
//     invalidEstadoFeedback.style.display = "none";
// });

// // Validación del input "Color"
// const colorInput = document.querySelector("#color-input");
// const invalidColorFeedback = document.querySelector(".invalid-feedback-color");
// colorInput.addEventListener("input", () => {
//     colorInput.classList.remove("is-invalid");
//     invalidColorFeedback.style.display = "none";
// });

// // Validación del input "Precio"
// const precioInput = document.querySelector("#precio-input");
// const invalidPrecioFeedback = document.querySelector(
//     ".invalid-feedback-precio"
// );
// precioInput.addEventListener("input", () => {
//     precioInput.classList.remove("is-invalid");
//     invalidPrecioFeedback.style.display = "none";
// });

// // Validación del select "Almacenamiento"
// const storageSelect = document.querySelector("#storage-select");
// const invalidStorageFeedback = document.querySelector(
//     ".invalid-feedback-storage"
// );
// storageSelect.addEventListener("change", () => {
//     storageSelect.classList.remove("is-invalid");
//     invalidStorageFeedback.style.display = "none";
// });

// // Validación del select "Liberación"
// const liberacionSelect = document.querySelector("#liberacion-select");
// const invalidLiberacionFeedback = document.querySelector(
//     ".invalid-feedback-liberacion"
// );
// liberacionSelect.addEventListener("change", () => {
//     liberacionSelect.classList.remove("is-invalid");
//     invalidLiberacionFeedback.style.display = "none";
// });

// // Validación del select "Categoría"
// const categoriaSelect = document.querySelector("#categoria-select");
// const invalidCategoriaFeedback = document.querySelector(
//     ".invalid-feedback-categoria"
// );
// categoriaSelect.addEventListener("change", () => {
//     categoriaSelect.classList.remove("is-invalid");
//     invalidCategoriaFeedback.style.display = "none";
// });

// // Validación del select "Marca"
// const marcaSelect = document.querySelector("#marca-select");
// const invalidMarcaFeedback = document.querySelector(".invalid-feedback-marca");
// marcaSelect.addEventListener("change", () => {
//     marcaSelect.classList.remove("is-invalid");
//     invalidMarcaFeedback.style.display = "none";
// });

// // Validación del toggle que verifica si el producto estará en venta o no
// const stockToggle = document.querySelector("#stock-toggle");
// const stockInput = document.querySelector("#stock-input");
// const availabilityText = document.querySelector(".availability-text");
// const invalidVentaFeedback = document.querySelector(".invalid-feedback-venta");
// stockToggle.addEventListener("change", () => {
//     if (stockToggle.checked) {
//         stockInput.value = "true";
//         availabilityText.textContent = "Sí";
//         invalidVentaFeedback.style.display = "none";
//     } else {
//         stockInput.value = "false";
//         availabilityText.textContent = "No";
//         invalidVentaFeedback.style.display = "none";
//     }
// });

// // Validación del textarea "Descripción"
// const descripcionInput = document.querySelector("#descripcion-input");
// const invalidDescripcionFeedback = document.querySelector(
//     ".invalid-feedback-descripcion"
// );
// descripcionInput.addEventListener("input", () => {
//     descripcionInput.classList.remove("is-invalid");
//     invalidDescripcionFeedback.style.display = "none";
// });

// // Validación del input "Imagen"
// const imagenInput = document.querySelector("#image-upload-input");
// const invalidImagenFeedback = document.querySelector(
//     ".invalid-feedback-imagen"
// );
// imagenInput.addEventListener("change", () => {
//     const fileName = imagenInput.files[0]?.name;
//     const uploadName = document.querySelector(".image-upload-name");
//     uploadName.textContent = fileName;
//     imagenInput.classList.remove("is-invalid");
//     invalidImagenFeedback.style.display = "none";
// });

// // Selección del modal para limpiarlo
// const modal = document.querySelector("#subirModalProducto");
// modal.addEventListener("hidden.bs.modal", function () {
//     form.reset();
//     nombreInput.classList.remove("is-invalid");
//     invalidNombreFeedback.style.display = "none";
//     estadoSelect.classList.remove("is-invalid");
//     invalidEstadoFeedback.style.display = "none";
//     colorInput.classList.remove("is-invalid");
//     invalidColorFeedback.style.display = "none";
//     precioInput.classList.remove("is-invalid");
//     invalidPrecioFeedback.style.display = "none";
//     storageSelect.classList.remove("is-invalid");
//     invalidStorageFeedback.style.display = "none";
//     liberacionSelect.classList.remove("is-invalid");
//     invalidLiberacionFeedback.style.display = "none";
//     categoriaSelect.classList.remove("is-invalid");
//     invalidCategoriaFeedback.style.display = "none";
//     marcaSelect.classList.remove("is-invalid");
//     invalidMarcaFeedback.style.display = "none";
//     descripcionInput.classList.remove("is-invalid");
//     invalidDescripcionFeedback.style.display = "none";
//     imagenInput.classList.remove("is-invalid");
//     invalidImagenFeedback.style.display = "none";
// });

// // Enviar el formulario validando los campos
// form.addEventListener("submit", function (event) {
//     event.preventDefault();

//     const button = document.querySelector("button[id='subir']");
//     const stockValue = stockToggle.checked ? "true" : "false";
//     const categoriaValue =
//         categoriaSelect.value === "" ? null : categoriaSelect.value;
//     const marcaValue = marcaSelect.value === "" ? null : marcaSelect.value;

//     let isValid = true;

//     if (!nombreInput.value) {
//         nombreInput.classList.add("is-invalid");
//         invalidNombreFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!estadoSelect.value) {
//         estadoSelect.classList.add("is-invalid");
//         invalidEstadoFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!colorInput.value) {
//         colorInput.classList.add("is-invalid");
//         invalidColorFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!precioInput.value) {
//         precioInput.classList.add("is-invalid");
//         invalidPrecioFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!storageSelect.value) {
//         storageSelect.classList.add("is-invalid");
//         invalidStorageFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!liberacionSelect.value) {
//         liberacionSelect.classList.add("is-invalid");
//         invalidLiberacionFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!descripcionInput.value) {
//         descripcionInput.classList.add("is-invalid");
//         invalidDescripcionFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (!imagenInput.files || imagenInput.files.length === 0) {
//         imagenInput.classList.add("is-invalid");
//         invalidImagenFeedback.style.display = "block";
//         isValid = false;
//     }

//     // Validar las selecciones de marca y categoría solo si no están vacías
//     if (
//         categoriaSelect.value === "" &&
//         categoriaSelect.getAttribute("required")
//     ) {
//         categoriaSelect.classList.add("is-invalid");
//         invalidCategoriaFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (marcaSelect.value === "" && marcaSelect.getAttribute("required")) {
//         marcaSelect.classList.add("is-invalid");
//         invalidMarcaFeedback.style.display = "block";
//         isValid = false;
//     }

//     if (isValid) {
//         const stockInput = document.createElement("input");
//         stockInput.setAttribute("type", "hidden");
//         stockInput.setAttribute("name", "stock");
//         stockInput.setAttribute("value", stockValue);
//         form.appendChild(stockInput);

//         const categoriaInput = document.createElement("input");
//         categoriaInput.setAttribute("type", "hidden");
//         categoriaInput.setAttribute("name", "categoria");
//         categoriaInput.setAttribute("value", categoriaValue);
//         form.appendChild(categoriaInput);

//         const marcaInput = document.createElement("input");
//         marcaInput.setAttribute("type", "hidden");
//         marcaInput.setAttribute("name", "marca");
//         marcaInput.setAttribute("value", marcaValue);
//         form.appendChild(marcaInput);

//         button.innerHTML = "Cargando...";
//         button.classList.add("disabled");
//         form.submit();
//     } else {
//         alert("Por favor complete todos los campos requeridos");
//     }
// });
