document.addEventListener('DOMContentLoaded', (event) => {
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        const link = item.querySelector('a');
        if (link && link.href === window.location.href) {
            item.classList.add('active');
        }
    });
});
