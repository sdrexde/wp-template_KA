(function() {
    // Schutzbedingung, um Mehrfachausführung zu verhindern
    if (window.snowInitialized) return;
    window.snowInitialized = true;

    document.addEventListener('DOMContentLoaded', function() {
        const canvases = document.querySelectorAll('.snow-canvas');
        const ctxs = [];
        const snowflakes = [];
        const isAnimating = []; // Animationsstatus pro Canvas

        // Initialisiere Canvas-Elemente
        canvases.forEach((canvas, index) => {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
            ctxs.push(canvas.getContext('2d'));
            snowflakes[index] = [];
            isAnimating[index] = false; // Initial nicht animieren
            for (let i = 0; i < 10; i++) {
                snowflakes[index].push(createSnowflake());
            }
        });

        // Erstelle Schneeflocken
        function createSnowflake() {
            return {
                x: Math.random() * window.innerWidth,
                y: 0,
                size: Math.random() * 2 + 1,
                speed: Math.random() * 2 + 1,
                opacity: Math.random() * 1.5 + 0.5
            };
        }

        // Zeichne eine Schneeflocke
        function drawSnowflake(ctx, snowflake) {
            ctx.beginPath();
            ctx.arc(snowflake.x, snowflake.y, snowflake.size, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(255, 255, 255, ' + snowflake.opacity + ')';
            ctx.fill();
        }

        // Animationsschleife
        function animateSnowflakes() {
            ctxs.forEach((ctx, index) => {
                if (!isAnimating[index]) return; // Nur animieren, wenn aktiv
                ctx.clearRect(0, 0, canvases[index].width, canvases[index].height);
                snowflakes[index].forEach(snowflake => {
                    snowflake.y += snowflake.speed;
                    if (snowflake.y > canvases[index].height) {
                        snowflake.y = -10;
                        snowflake.x = Math.random() * canvases[index].width;
                    }
                    drawSnowflake(ctx, snowflake);
                });
            });
            requestAnimationFrame(animateSnowflakes);
        }

        // Event-Listener für Mouseover und Mouseleave
        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach((link, index) => {
            link.addEventListener('mouseover', () => {
                isAnimating[index] = true; // Animation starten
            });
            link.addEventListener('mouseleave', () => {
                isAnimating[index] = false; // Animation stoppen
                ctxs[index].clearRect(0, 0, canvases[index].width, canvases[index].height); // Canvas leeren
            });
        });

        // Animation starten
        animateSnowflakes();
    });
})();