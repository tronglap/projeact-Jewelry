const closeIcon = document.querySelector(".site-search-popup-close");
const outSide = document.querySelector("#searchOverlay");

//Check if onClick class site-search-popup-close then Remove class active of id="searchBar"
closeIcon.addEventListener("click", function () {
    const searchBar = document.getElementById("searchBar");
    if (searchBar) {
        searchBar.classList.remove("active");
        document.body.style.overflow = "";
    }
});

// Check if onClick outside class have id="searchBar" then Remove class active of id="searchBar"
outSide.addEventListener("click", function (event) {
    const searchBar = document.getElementById("searchBar");
    if (searchBar) {
        searchBar.classList.remove("active");
        document.body.style.overflow = "";
    }
});
