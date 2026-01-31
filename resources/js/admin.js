import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Register Alpine.js plugins
Alpine.plugin(collapse);

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Sidebar state management
document.addEventListener('alpine:init', () => {
    // Handle sidebar state on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            // Close mobile sidebar on desktop
            Alpine.store('sidebar').mobileOpen = false;
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // CMD/CTRL + K for search focus
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('input[type="text"][placeholder*="Search"]');
        if (searchInput) {
            searchInput.focus();
        }
    }

    // ESC to close modals/dropdowns
    if (e.key === 'Escape') {
        // Close any open dropdowns
        document.querySelectorAll('[x-data]').forEach((el) => {
            if (el.__x) {
                const data = el.__x.$data;
                if (data.isOpen !== undefined) data.isOpen = false;
                if (data.open !== undefined) data.open = false;
            }
        });
    }
});

// Dark mode initialization
const initDarkMode = () => {
    const darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'true' || (!darkMode && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }
};

initDarkMode();

// Export for use in other scripts
export { Alpine };
