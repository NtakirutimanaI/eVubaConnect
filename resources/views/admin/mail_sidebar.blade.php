<style>
    /* Sidebar Layout */
    .sidebar {
        position: fixed;
        top: 60px; /* Top offset */
        left: 0;
        width: 220px;
        height: calc(100vh - 60px);
        background-color: #f8f9fa;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 10000;
        overflow-y: auto;
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mail-hover-container {
        position: relative;
    }

    .mail-trigger {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    .mail-trigger img.icon {
        margin-right: 10px;
    }

    .mail-submenu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .mail-submenu li a {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
    }

    .mail-submenu li a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .mail-submenu li a img {
        margin-right: 10px;
        width: 20px;
        height: 20px;
    }

    .mail-trigger i.fas {
        margin-left: auto;
        font-size: 12px;
        color: #888;
    }

    /* Responsive behavior */

    /* Hide sidebar on small screens by default */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            height: 100vh;
            top: 60px;
            left: 0;
            width: 140px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.2);
            transition: transform 0.3s ease-in-out;
        }

        /* When sidebar is active/show */
        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<!-- Sidebar Container -->
<aside class="sidebar" id="sidebar">
    <!-- Mailing with Submenu -->
    <ul class="sidebar-menu">
        <li class="mail-hover-container">
            <a href="#" class="mail-trigger" title="Mailing">
                <span class="label">eVubaConnect Mail</span>
                <i class="fas fa-chevron-right"></i>
            </a>

            <!-- Submenu always visible in sidebar -->
            <ul class="mail-submenu">
                <li><a href="{{ route('compose') }}">
                    <img src="https://img.icons8.com/ios/24/new-post--v1.png" alt="Compose Icon"/>Compose</a></li>
                <li><a href="{{ route('inbox') }}">
                    <img src="https://img.icons8.com/ios/24/inbox--v1.png" alt="Inbox Icon"/>Inbox</a></li>
                <li><a href="{{ route('sent') }}">
                    <img src="https://img.icons8.com/ios/24/sent.png" alt="Sent Icon"/>Sent</a></li>
                <li><a href="{{ route('drafts') }}">
                    <img src="https://img.icons8.com/ios/24/save-as.png" alt="Drafts Icon"/>Drafts</a></li>
                <li><a href="{{ route('chats') }}">
                    <img src="https://img.icons8.com/ios/24/speech-bubble--v1.png" alt="Chats Icon"/>Chats</a></li>
                <li><a href="{{ route('all_mail') }}">
                    <img src="https://img.icons8.com/ios/24/open-envelope--v1.png" alt="All Mail Icon"/>All Mail</a></li>
                <li><a href="{{ route('trash') }}">
                    <img src="https://img.icons8.com/ios/24/delete--v1.png" alt="Trash Icon"/>Trash</a></li>
                <li><a href="{{ route('meetings') }}">
                    <img src="https://img.icons8.com/ios/24/video-call--v1.png" alt="Meetings Icon"/>Meetings</a></li>
                <li><a href="{{ route('whatsapp') }}">
                    <img src="https://img.icons8.com/ios/24/whatsapp--v1.png" alt="WhatsApp Icon"/>WhatsApp</a></li>
            </ul>
        </li>
    </ul>
</aside>

<!-- Optional toggle button for small screens -->
<button id="sidebarToggle" style="position: fixed; top: 19px; left: 19px; width:30px; z-index:11000;">☰</button>

<script>
    // Toggle sidebar on small screens
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>
