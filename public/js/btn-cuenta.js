const toggleDropdownNew = (content, button) => {
    const dropdownContent = document.getElementById(content),
        dropdownButton = document.getElementById(button);

    let isDropdownOpen = false;
    let isHovering = false;

    const openDropdown = () => {
        dropdownContent.classList.add("show-dropdown-new");
        isDropdownOpen = true;
    };

    const closeDropdown = () => {
        dropdownContent.classList.remove("show-dropdown-new");
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
        if (
            !dropdownContent.contains(event.target) &&
            !dropdownButton.contains(event.target)
        ) {
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

toggleDropdownNew("dropdown-content-new", "dropdown-button-new");
