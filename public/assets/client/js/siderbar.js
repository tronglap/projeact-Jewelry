document.addEventListener("DOMContentLoaded", function () {
    const toggleNavBar = document.getElementById("toggleNavBar");
    const NavBar = document.getElementById("NavBar");
    const List = document.getElementById("List");
    const icon_close = document.getElementById("icon_close");
    const Categories = document.getElementById("Categories");
    const submenuCate = document.getElementById("submenu-cate");
    let isActive = false;
    let rotate = false;

    const blockScroll = () => {
        document.documentElement.style.position = "relative";
        document.documentElement.style.overflow = "hidden";
        document.body.style.position = "relative";
        document.body.style.overflow = "hidden";
        const scrollBarWidth =
            window.innerWidth - document.documentElement.clientWidth;
        const bodyPaddingRight =
            parseInt(
                window
                    .getComputedStyle(document.body)
                    .getPropertyValue("padding-right")
            ) || 0;
        document.body.style.paddingRight = `${
            bodyPaddingRight + scrollBarWidth
        }px`;
    };

    const allowScroll = () => {
        document.documentElement.style.position = "";
        document.documentElement.style.overflow = "";
        document.body.style.position = "";
        document.body.style.overflow = "";
        document.body.style.paddingRight = "";
    };

    const toggleNavBarHandler = () => {
        isActive = !isActive;
        if (isActive) {
            NavBar.classList.add("active");
            List.classList.add("active");
            blockScroll();
        } else {
            NavBar.classList.remove("active");
            List.classList.remove("active");
            allowScroll();
        }
    };

    const toggleRotateHandler = () => {
        rotate = !rotate;
        if (rotate) {
            Categories.classList.add("active");
        } else {
            Categories.classList.remove("active");
        }
    };

    const fetchCategories = async () => {
        try {
            const response = await fetch(
                "https://65f3b3d2105614e654a0e686.mockapi.io/Categories"
            );
            if (!response.ok) {
                throw new Error("Không thể lấy dữ liệu từ API");
            }
            const data = await response.json();
            submenuCate.innerHTML = "";
            data.forEach((item) => {
                const link = document.createElement("a");
                link.href = "/home";
                link.className = "name-cate";
                link.textContent = item.categories;
                submenuCate.appendChild(link);
            });
        } catch (error) {
            console.error(error);
        }
    };


    toggleNavBar.addEventListener("click", toggleNavBarHandler);
    icon_close.addEventListener("click", toggleNavBarHandler);
    Categories.addEventListener("click", toggleRotateHandler);

    fetchCategories();

    window.addEventListener("unload", allowScroll);
});
