(function() {
    // Schutzbedingung, um Mehrfachausführung zu verhindern
    if (window.sliderInitialized) return;
    window.sliderInitialized = true;

    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        // Exit early if no slides or dots are found
        if (slides.length === 0 || dots.length === 0) return;

        let slideIndex = 0;
        let isPaused = false;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                dots[i].classList.remove('active');
            });
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            if (isPaused) return;
            slideIndex = (slideIndex + 1) % slides.length;
            showSlide(slideIndex);
        }

        function prevSlide() {
            if (isPaused) return;
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            showSlide(slideIndex);
        }

        function currentSlide(index) {
            slideIndex = index;
            showSlide(slideIndex);
        }

        // Event-Listener für Steuerung
        const nextButton = document.querySelector('.slider-control.next');
        const prevButton = document.querySelector('.slider-control.prev');
        const pauseButton = document.querySelector('.slider-control.pause');

        if (nextButton) nextButton.addEventListener('click', nextSlide);
        if (prevButton) prevButton.addEventListener('click', prevSlide);
        if (pauseButton) {
            pauseButton.addEventListener('click', () => {
                isPaused = !isPaused;
                pauseButton.textContent = isPaused ? 'Slider fortfahren' : 'Slider pausieren';
                pauseButton.setAttribute('aria-label', isPaused ? 'Slider fortfahren' : 'Slider pausieren');
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => currentSlide(index));
        });

        // Automatischer Wechsel alle 5 Sekunden
        setInterval(nextSlide, 5000);

        // Initiale Anzeige
        showSlide(slideIndex);
    });
})();