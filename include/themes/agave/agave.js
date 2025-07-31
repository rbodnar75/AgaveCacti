/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Theme - JavaScript                                    |
 +-------------------------------------------------------------------------+
*/

class AgaveCacti {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.setupMobileNavigation();
            this.enhanceGraphs();
            this.initializeTheme();
        });
        
        // Also run immediately in case DOM is already loaded
        if (document.readyState === 'loading') {
            // Wait for DOMContentLoaded
        } else {
            this.setupMobileNavigation();
            this.enhanceGraphs();
            this.initializeTheme();
        }
    }

    setupMobileNavigation() {
        const mobileToggle = document.querySelector('.agave-mobile-menu-toggle');
        const sidebar = document.querySelector('.agave-sidebar');
        const overlay = document.querySelector('.agave-overlay');

        if (mobileToggle && sidebar) {
            mobileToggle.addEventListener('click', () => {
                this.toggleMobileMenu();
            });

            // Close menu when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', () => {
                    this.closeMobileMenu();
                });
            }

            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                    this.closeMobileMenu();
                }
            });

            // Close menu when navigating to a new page
            const navLinks = sidebar.querySelectorAll('.agave-nav-item');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1024) {
                        this.closeMobileMenu();
                    }
                });
            });
        }
    }

    toggleMobileMenu() {
        const sidebar = document.querySelector('.agave-sidebar');
        const overlay = document.querySelector('.agave-overlay');
        
        if (sidebar) {
            sidebar.classList.toggle('open');
            if (overlay) {
                overlay.classList.toggle('active');
            }
        }
    }

    closeMobileMenu() {
        const sidebar = document.querySelector('.agave-sidebar');
        const overlay = document.querySelector('.agave-overlay');
        
        if (sidebar) {
            sidebar.classList.remove('open');
            if (overlay) {
                overlay.classList.remove('active');
            }
        }
    }

    enhanceGraphs() {
        this.ensureGraphsVisible();
        
        // Re-run graph enhancement after page updates
        const observer = new MutationObserver(() => {
            this.ensureGraphsVisible();
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    ensureGraphsVisible() {
        // Force visibility on all graph-related elements
        const graphSelectors = [
            '.cactiGraphContentArea',
            '.cactiGraphContentAreaPreview',
            '.graphWrapper',
            '.graphContainer',
            '.graphimage',
            'img[src*="graph_image.php"]',
            'img[src*="graph.php"]',
            'div[id*="wrapper_"]',
            'div[id*="graph_"]',
            '[id*="graph"]',
            '[class*="graph"]'
        ];

        graphSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                element.style.display = 'block';
                element.style.visibility = 'visible';
                element.style.opacity = '1';
                
                // Remove any inline styles that might hide the element
                if (element.style.display === 'none') {
                    element.style.display = 'block';
                }
            });
        });

        // Specifically handle graph images
        const graphImages = document.querySelectorAll('img[src*="graph"]');
        graphImages.forEach(img => {
            img.style.display = 'inline-block';
            img.style.visibility = 'visible';
            img.style.opacity = '1';
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
        });

        console.log('AgaveCacti: Enhanced', graphImages.length, 'graph images');
    }

    initializeTheme() {
        // Add active states to navigation
        this.setActiveNavigation();
        
        // Initialize any tooltips or interactive elements
        this.initializeInteractiveElements();
        
        // Add smooth scrolling
        this.enableSmoothScrolling();
        
        // Enhance contrast for accessibility
        this.enhanceAccessibility();
    }

    setActiveNavigation() {
        const currentPath = window.location.pathname;
        const navItems = document.querySelectorAll('.agave-nav-item');
        
        navItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.includes(href.split('/').pop().split('?')[0])) {
                item.classList.add('active');
            }
        });
    }

    initializeInteractiveElements() {
        // Add click handlers for enhanced UX
        const tables = document.querySelectorAll('.cactiTable');
        tables.forEach(table => {
            // Add hover effects and sorting enhancement
            this.enhanceTable(table);
        });
        
        // Enhance form accessibility
        this.enhanceFormAccessibility();
    }

    enhanceTable(table) {
        // Add better responsive behavior to tables
        if (table.scrollWidth > table.clientWidth) {
            table.style.overflowX = 'auto';
            table.style.webkitOverflowScrolling = 'touch';
        }
        
        // Add zebra striping for better readability
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            if (index % 2 === 0) {
                row.style.backgroundColor = 'var(--gray-50)';
            }
        });
    }

    enhanceFormAccessibility() {
        // Add focus indicators to form elements
        const formElements = document.querySelectorAll('input, select, textarea, button');
        formElements.forEach(element => {
            element.addEventListener('focus', () => {
                element.style.outline = '3px solid var(--primary-300)';
                element.style.outlineOffset = '2px';
            });
            
            element.addEventListener('blur', () => {
                element.style.outline = 'none';
                element.style.outlineOffset = '0';
            });
        });
    }

    enhanceAccessibility() {
        // Ensure sufficient color contrast
        this.checkColorContrast();
        
        // Add keyboard navigation support
        this.addKeyboardNavigation();
        
        // Add ARIA labels where missing
        this.addAriaLabels();
    }

    checkColorContrast() {
        // Function to ensure text has sufficient contrast
        const elements = document.querySelectorAll('*');
        elements.forEach(element => {
            const style = window.getComputedStyle(element);
            const color = style.color;
            const backgroundColor = style.backgroundColor;
            
            // Log elements with potentially low contrast
            if (color && backgroundColor && color !== 'rgba(0, 0, 0, 0)' && backgroundColor !== 'rgba(0, 0, 0, 0)') {
                // This is a simplified check - in production you'd want a more robust contrast checker
                console.log('Checking contrast for:', element, 'Color:', color, 'Background:', backgroundColor);
            }
        });
    }

    addKeyboardNavigation() {
        // Enhance keyboard navigation for navigation items
        const navItems = document.querySelectorAll('.agave-nav-item');
        navItems.forEach((item, index) => {
            item.setAttribute('tabindex', '0');
            
            item.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    item.click();
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    const nextItem = navItems[index + 1];
                    if (nextItem) nextItem.focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    const prevItem = navItems[index - 1];
                    if (prevItem) prevItem.focus();
                }
            });
        });
    }

    addAriaLabels() {
        // Add ARIA labels to navigation sections
        const navSections = document.querySelectorAll('.agave-nav-section');
        navSections.forEach(section => {
            const header = section.querySelector('.agave-nav-header');
            if (header) {
                section.setAttribute('role', 'navigation');
                section.setAttribute('aria-label', header.textContent);
            }
        });
        
        // Add ARIA labels to interactive elements
        const buttons = document.querySelectorAll('button:not([aria-label])');
        buttons.forEach(button => {
            if (!button.getAttribute('aria-label') && button.textContent) {
                button.setAttribute('aria-label', button.textContent.trim());
            }
        });
    }

    enableSmoothScrolling() {
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    }

    // Utility methods
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
}

// Initialize AgaveCacti
const agaveCacti = new AgaveCacti();

// Export for global access if needed
window.AgaveCacti = AgaveCacti;
