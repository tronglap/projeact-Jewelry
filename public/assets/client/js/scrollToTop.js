document.addEventListener("DOMContentLoaded", function () {
    const toTopButton = document.getElementById("toTop");

    // Show or hide the button based on scroll position
    function handleScroll() {
        const scrollPosition = window.scrollY;
        if (scrollPosition > 100) {
            toTopButton.classList.add("visible");
        } else {
            toTopButton.classList.remove("visible");
        }
    }

    // Scroll to the top smoothly
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    }

    // Attach the scroll event listener
    window.addEventListener("scroll", handleScroll);

    // Attach the click event listener
    toTopButton.addEventListener("click", scrollToTop);
});
