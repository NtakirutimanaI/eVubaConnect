
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