</main>

<footer>
    <div class="social-media" aria-label="Soziale Medien Links">
        <?php
        $social_networks = array(
            'facebook' => array('icon' => 'fa-facebook-f', 'label' => 'Facebook'),
            'instagram' => array('icon' => 'fa-instagram', 'label' => 'Instagram'),
            'tiktok' => array('icon' => 'fa-tiktok', 'label' => 'TikTok'),
            'linkedin' => array('icon' => 'fa-linkedin-in', 'label' => 'LinkedIn')
        );
        
        foreach ($social_networks as $network => $data) {
            $url = get_theme_mod("social_$network");
            if ($url) {
                echo '<a href="' . esc_url($url) . '" target="_blank" class="social-icon" aria-label="' . esc_attr($data['label']) . '">';
                echo '<i class="fa-brands ' . esc_attr($data['icon']) . '"></i>';
                echo '</a>';
            }
        }
        
        // Default social links if none are set
        if (!get_theme_mod('social_facebook') && !get_theme_mod('social_instagram') && !get_theme_mod('social_tiktok') && !get_theme_mod('social_linkedin')) {
            ?>
            <a href="https://facebook.com/61579131704751" target="_blank" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://instagram.com/kaelte_apel" target="_blank" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://tiktok.com/@kaelte_apel" target="_blank" class="social-icon" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://linkedin.com/company/kaelteapel" target="_blank" class="social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <?php
        }
        ?>
    </div>
    <?php if (is_active_sidebar('footer-widgets')): ?>
        <div class="footer-widgets">
            <?php dynamic_sidebar('footer-widgets'); ?>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>

<script>
// Initialize slider functionality
document.addEventListener('DOMContentLoaded', function() {
        
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Slider functions for global access
function currentSlide(n) {
    if (typeof showSlide === 'function') {
        showSlide(slideIndex = n);
    }
}

function nextSlide() {
    if (typeof showSlide === 'function') {
        slideIndex = (slideIndex + 1) % document.querySelectorAll('.slide').length;
        showSlide(slideIndex);
    }
}

function prevSlide() {
    if (typeof showSlide === 'function') {
        const slides = document.querySelectorAll('.slide');
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlide(slideIndex);
    }
}
</script>

</body>
</html>