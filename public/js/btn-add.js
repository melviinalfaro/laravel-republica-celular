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

toggleDropdown("dropdown-content", "dropdown-button");
