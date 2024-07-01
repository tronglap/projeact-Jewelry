let lastClickTime = 0;

function handleClick(event) {
    const currentTime = new Date().getTime();
    const timeDiff = currentTime - lastClickTime;

    if (timeDiff < 50) {
        // 300ms là khoảng thời gian ngăn chặn double click
        event.preventDefault();
        event.stopImmediatePropagation();
        return false;
    }

    lastClickTime = currentTime;
}

document.addEventListener("click", handleClick, true);
