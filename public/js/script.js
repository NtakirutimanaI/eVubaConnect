
    // Optional: Expand sidebar via JS if you prefer class toggling
    const sidebar = document.getElementById('sidebar');
    sidebar.addEventListener('mouseenter', () => {
        sidebar.classList.add('hovered');
    });

    sidebar.addEventListener('mouseleave', () => {
        sidebar.classList.remove('hovered');
    });


    document.querySelectorAll('.stat-card')[1].querySelector('.stat-value').textContent = 42;
    document.querySelectorAll('.stat-card')[1].querySelector('.stat-change').textContent = '↑ 12%';

    lucide.createIcons();

    // Toggle sidebar on small screen
    document.getElementById('hamburger').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('show');
    });

       lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        if (hamburger && sidebar) {
            hamburger.addEventListener('click', function () {
                sidebar.classList.toggle('show');
            });
        }
    });