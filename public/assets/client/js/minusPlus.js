document.addEventListener("DOMContentLoaded", (event) => {
    const minusButtons = document.querySelectorAll(".minus");
    const plusButtons = document.querySelectorAll(".plus");

    let action;

    function updateValue(input, delta) {
        let value = parseInt(input.value);
        if (delta < 0 && value > 1) {
            input.value = value + delta;
        } else if (delta > 0 && value < 20) {
            input.value = value + delta;
        }
    }

    minusButtons.forEach((button) => {
        button.addEventListener("mousedown", function () {
            let input = this.nextElementSibling;
            action = setInterval(() => updateValue(input, -1), 100);
        });

        button.addEventListener("mouseup", function () {
            clearInterval(action);
        });

        button.addEventListener("mouseleave", function () {
            clearInterval(action);
        });
    });

    plusButtons.forEach((button) => {
        button.addEventListener("mousedown", function () {
            let input = this.previousElementSibling;
            action = setInterval(() => updateValue(input, 1), 100);
        });

        button.addEventListener("mouseup", function () {
            clearInterval(action);
        });

        button.addEventListener("mouseleave", function () {
            clearInterval(action);
        });
    });

    minusButtons.forEach((button) => {
        button.addEventListener("click", function () {
            let input = this.nextElementSibling;
            updateValue(input, -1);
        });
    });

    plusButtons.forEach((button) => {
        button.addEventListener("click", function () {
            let input = this.previousElementSibling;
            updateValue(input, 1);
        });
    });
});
