document.addEventListener("DOMContentLoaded", function () {
    const sortElement = document.querySelector(".sort");
    const sortsElement = document.querySelector(".sorts");
    const iconElement = sortElement.querySelector(".fa-angle-down");

    sortElement.addEventListener("click", function () {
        sortsElement.classList.toggle("active");
        iconElement.classList.toggle("active");
    });
});
