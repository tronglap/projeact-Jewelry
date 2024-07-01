document.addEventListener("DOMContentLoaded", (event) => {
    const inputs = document.querySelectorAll(".input");

    inputs.forEach((input) => {
        input.addEventListener("focus", () => {
            input.classList.add("active");
        });

        input.addEventListener("blur", () => {
            input.classList.remove("active");
        });
    });
});
