// Animation Configuration
const animationConfig = {
    threshold: 0.2,
    rootMargin: '50px',
    elements: {
        '.hero-content': { delay: 0, duration: 1 },
        '.feature-card': { delay: 0.2, duration: 0.8 },
        '.about-content': { delay: 0.3, duration: 0.8 },
        '.about-image': { delay: 0.4, duration: 0.8 },
        '.category-card': { delay: 0.2, duration: 0.6 },
        '.menu-item, .menu-item-p': { delay: 0.15, duration: 0.8 },
        '.comment-card': { delay: 0.25, duration: 0.7 },
        '.promo-banner': { delay: 0.3, duration: 0.9 }
    }
};

// Animation Observer
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const config = Object.entries(animationConfig.elements).find(([selector]) => 
                    element.matches(selector)
                );

                if (config) {
                    const [, { delay }] = config;
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, delay * 1000);
                }
                observer.unobserve(element);
            }
        });
    }, {
        threshold: animationConfig.threshold,
        rootMargin: animationConfig.rootMargin
    });

    // Initialize elements for animation
    Object.entries(animationConfig.elements).forEach(([selector, { duration }]) => {
        document.querySelectorAll(selector).forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = `all ${duration}s cubic-bezier(0.4, 0, 0.2, 1)`;
            observer.observe(element);
        });
    });
}

// Smooth Scroll Navigation
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
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
}

// Parallax Effect for Hero
function initParallax() {
    const hero = document.querySelector('.hero');
    if (!hero) return;
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        hero.style.backgroundPositionY = `${scrolled * 0.5}px`;
    });
}

// Hover Animations
function initHoverAnimations() {
    const interactiveElements = document.querySelectorAll('.cta-button, .btn-shop, .feature-card, .category-card');
    
    interactiveElements.forEach(element => {
        element.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
}

// Scroll to Categories Function
function scrollToCategories(e) {
    e.preventDefault();
    const categoriesSection = document.querySelector('.category-section');
    if (categoriesSection) {
        categoriesSection.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Main Initialization
document.addEventListener('DOMContentLoaded', function() {
    initScrollAnimations();
    initSmoothScroll();
    initParallax();
    initHoverAnimations();
});

// Export functions for global access
window.scrollToCategories = scrollToCategories;