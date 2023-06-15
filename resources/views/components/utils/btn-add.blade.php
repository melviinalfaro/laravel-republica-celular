<div class="dropdown" id="dropdown-content">
    <button class="dropdown__button" id="dropdown-button">
        <i class="material-icons-outlined dropdown__icon">add_circle_outline</i>
        <span class="dropdown__name">Agregar</span>

        <div class="dropdown__icons">
            <i class="material-icons-outlined dropdown__arrow">arrow_drop_up</i>
            <i class="material-icons-outlined dropdown__close">close</i>
        </div>
    </button>

    <ul class="dropdown__menu">
        <li class="dropdown__item">
            <i class="material-icons-outlined dropdown__icon icon">inventory_2</i>
            <a href="{{ route('productos') }}" class="dropdown__name text">Producto</a>
        </li>

        <li class="dropdown__item">
            <i class="material-icons-outlined dropdown__icon icon">add_photo_alternate</i>
            <a href="{{ route('ver.carrusel') }}" class="dropdown__name text">Carrusel</a>
        </li>

        <li class="dropdown__item">
            <i class="material-icons-outlined dropdown__icon icon">account_circle</i>
            <a href="#" class="dropdown__name text">Usuario</a>
        </li>
    </ul>
</div>

<script>
    const toggleDropdown = (content, button) => {
        const dropdownContent = document.getElementById(content),
            dropdownButton = document.getElementById(button);

        let isDropdownOpen = false;
        let isHovering = false;

        const openDropdown = () => {
            dropdownContent.classList.add("show-dropdown");
            isDropdownOpen = true;
        };

        const closeDropdown = () => {
            dropdownContent.classList.remove("show-dropdown");
            isDropdownOpen = false;
        };

        const handleButtonClick = () => {
            if (isDropdownOpen) {
                closeDropdown();
            } else {
                openDropdown();
            }
        };

        const handleOutsideClick = (event) => {
            if (!dropdownContent.contains(event.target) && !dropdownButton.contains(event.target)) {
                closeDropdown();
            }
        };

        const handleHover = () => {
            if (!isDropdownOpen && isHovering) {
                openDropdown();
            }
        };

        dropdownButton.addEventListener("click", handleButtonClick);
        dropdownButton.addEventListener("mouseover", () => {
            isHovering = true;
            handleHover();
        });
        dropdownButton.addEventListener("mouseout", () => {
            isHovering = false;
            handleHover();
        });
        dropdownContent.addEventListener("click", (event) => {
            event.stopPropagation();
        });

        document.addEventListener("click", handleOutsideClick);
    };

    toggleDropdown("dropdown-content", "dropdown-button");
</script>
