document.addEventListener("DOMContentLoaded", () => {

    const dropdownButtons = document.querySelectorAll(".dropdown-nav-btn, .dropdown-btn");
    const dropdownMenus = document.querySelectorAll(".dropdown-nav-menu, .dropdown-menu");

    function closeAllDropdowns() {
        dropdownMenus.forEach(menu => {
            menu.classList.add("hidden");
            menu.classList.remove("scale-100","opacity-100");
            menu.classList.add("scale-95","opacity-0");
        });

        document.querySelectorAll(".dropdown-icon").forEach(icon=>{
            icon.classList.remove("rotate-180");
        });
    }

    dropdownButtons.forEach(button => {
        button.addEventListener("click", function(e) {
            e.stopPropagation();

            const parent = this.closest("li, td, div");
            const menu = parent.querySelector(".dropdown-nav-menu, .dropdown-menu");
            const icon = this.querySelector(".dropdown-icon");

            const isOpen = !menu.classList.contains("hidden");

            closeAllDropdowns();

            if (!isOpen) {
                menu.classList.remove("hidden");
                menu.classList.add("scale-100","opacity-100");
                menu.classList.remove("scale-95","opacity-0");

                if(icon){
                    icon.classList.add("rotate-180");
                }
            }
        });
    });

    document.addEventListener("click", () => {
        closeAllDropdowns();
    });

});