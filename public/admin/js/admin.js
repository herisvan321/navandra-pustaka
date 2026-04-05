/**
 * Nevandra Admin Dashboard - Core UI Logic
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        // Core Elements
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const themeToggle = document.getElementById('themeToggle');
        const fullscreenToggle = document.getElementById('fullscreenToggle');

        // Sidebar Toggles
        if (sidebarToggle && sidebar && sidebarOverlay) {
            sidebarToggle.addEventListener('click', () => {
                if (window.innerWidth <= 1024) {
                    sidebar.classList.toggle('mobile-active');
                    sidebarOverlay.classList.toggle('active');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('mobile-active');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Theme Toggle
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark-mode');
                const icon = themeToggle.querySelector('i');
                const isDark = document.documentElement.classList.contains('dark-mode');
                
                if (icon) {
                    icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
                }
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });

            // Initial Theme Icon Sync
            const icon = themeToggle.querySelector('i');
            if (icon && document.documentElement.classList.contains('dark-mode')) {
                icon.className = 'fas fa-sun';
            }
        }

        // Fullscreen Toggle
        if (fullscreenToggle) {
            fullscreenToggle.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    const icon = fullscreenToggle.querySelector('i');
                    if (icon) icon.className = 'fas fa-compress';
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                        const icon = fullscreenToggle.querySelector('i');
                        if (icon) icon.className = 'fas fa-expand';
                    }
                }
            });
        }
    });
})();
