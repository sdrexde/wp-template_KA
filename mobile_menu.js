// Mobile Menu JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const body = document.body;
    
    if (menuToggle && mainNav) {
        // Toggle menu function
        function toggleMenu() {
            const isOpen = mainNav.classList.contains('open');
            
            if (isOpen) {
                // Close menu
                mainNav.classList.remove('open');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = ''; // Re-enable scrolling
            } else {
                // Open menu
                mainNav.classList.add('open');
                menuToggle.classList.add('active');
                menuToggle.setAttribute('aria-expanded', 'true');
                body.style.overflow = 'hidden'; // Prevent background scrolling on mobile
            }
        }
        
        // Click event for menu toggle
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleMenu();
        });
        
        // Close menu when clicking on menu links (for anchor links)
        const menuLinks = mainNav.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Only close menu for internal anchor links
                const href = this.getAttribute('href');
                if (href && href.startsWith('#')) {
                    // Close menu after a short delay to allow smooth scrolling
                    setTimeout(() => {
                        if (mainNav.classList.contains('open')) {
                            toggleMenu();
                        }
                    }, 300);
                }
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mainNav.classList.contains('open')) {
                if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                    toggleMenu();
                }
            }
        });
        
        // Close menu on window resize (if switching from mobile to desktop)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && mainNav.classList.contains('open')) {
                mainNav.classList.remove('open');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                body.style.overflow = '';
            }
        });
        
        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mainNav.classList.contains('open')) {
                toggleMenu();
                menuToggle.focus(); // Return focus to toggle button
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                e.preventDefault();
                
                // Calculate offset for sticky header
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20; // 20px extra padding
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Function to ensure menu state is correct on page load
window.addEventListener('load', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (menuToggle && mainNav) {
        // Ensure menu starts closed on mobile
        if (window.innerWidth <= 768) {
            mainNav.classList.remove('open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    }
});