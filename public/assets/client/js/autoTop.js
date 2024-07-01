function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}

// Sự kiện `popstate` được kích hoạt khi sử dụng `history.back()`, `history.forward()`, hoặc `history.go()`.
window.addEventListener("popstate", scrollToTop);

// Sự kiện `hashchange` được kích hoạt khi thay đổi hash trong URL.
window.addEventListener("hashchange", scrollToTop);

// Gọi hàm cuộn lên đầu ngay khi tải trang.
scrollToTop();
