// Cookie-Banner JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('accept-cookies');
    const declineBtn = document.getElementById('decline-cookies');

    // Überprüfen, ob Einwilligung schon vorliegt
    if (!localStorage.getItem('cookieConsent')) {
        banner.style.display = 'block';
    }

    // Akzeptieren: Speichern und Banner schließen
    acceptBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        banner.style.display = 'none';
        // Hier kannst du Tracking-Scripts laden, z.B. Google Analytics, falls verwendet
    });

    // Ablehnen: Speichern und Banner schließen (keine Cookies laden)
    declineBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'declined');
        banner.style.display = 'none';
        // Optional: Nicht-essentielle Cookies löschen oder blocken
    });
});