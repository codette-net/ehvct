import './bootstrap';

(() => {
    const button = document.getElementById('nav-menu-button');
    const menu = document.getElementById('mobile-nav-menu');

    if (!button || !menu) return;

    const openMenu = () => {
        menu.classList.remove('hidden');
        button.setAttribute('aria-expanded', 'true');
    };

    const closeMenu = () => {
        menu.classList.add('hidden');
        button.setAttribute('aria-expanded', 'false');
    };

    const toggleMenu = (event) => {
        event.stopPropagation();

        if (menu.classList.contains('hidden')) {
            openMenu();
        } else {
            closeMenu();
        }
    };

    button.addEventListener('click', toggleMenu);

    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && !button.contains(event.target)) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });
})();
