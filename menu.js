document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-nav');

    if (toggleButton && nav) {
        toggleButton.addEventListener('click', function() {
            nav.classList.toggle('open');
            const isExpanded = nav.classList.contains('open');
            toggleButton.setAttribute('aria-expanded', isExpanded);
            toggleButton.innerHTML = isExpanded ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>'; // Icon wechseln (X für schließen)
        });
    }
});