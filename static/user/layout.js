// for menu icon in navbar

document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.querySelector('.toggle-menu');
    const navbarLinks = document.querySelector('.navbar-links');

    toggleButton.addEventListener('click', () => {
        navbarLinks.classList.toggle('active');
    });
});
