<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="dashboard-title">
        <h1>Dashboard</h1>
        @auth
            <p>Hi, {{ Auth::user()->name }}. Welcome back to eVubaConnect Admin!</p>
        @else
            <p>Welcome to eVubaConnect Admin!</p>
        @endauth
    </div>

    <div class="filter-card" onclick="toggleFilterDropdown()">
        <div class="filter-icon">
            <div class="icon-circle">
                <img src="{{ asset('images/calendar.png') }}" alt="Calendar Icon">
            </div>
        </div>
        <div class="filter-text">
            <span class="filter-title">Filter Periode</span>
            <span class="filter-dates">17 April 2020 - 21 May 2020</span>
        </div>
        <div class="dropdown-icon">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.585l3.71-4.355a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="filter-dropdown" id="filterDropdown" style="display: none;">
        <ul>
            <li><a href="#">Today</a></li>
            <li><a href="#">This Week</a></li>
            <li><a href="#">This Month</a></li>
            <li><a href="#">Custom Range</a></li>
        </ul>
    </div>
</div>

<!-- JavaScript to toggle dropdown -->
<script>
    function toggleFilterDropdown() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const filterCard = document.querySelector('.filter-card');
        const dropdown = document.getElementById('filterDropdown');

        filterCard.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });

        document.addEventListener('click', function (event) {
            if (!filterCard.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    });
</script>
