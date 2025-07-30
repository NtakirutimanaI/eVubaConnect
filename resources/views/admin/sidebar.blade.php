<!-- CSS Links -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Hamburger Button -->
<div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar" style="margin-top: 0px;">
    <ul class="sidebar-menu">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}" title="Dashboard" style="background-color: #007bff; color: white; display: flex; align-items: center; padding: 8px 12px; text-decoration: none;">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/home.png" class="icon" alt="Dashboard Icon" style="margin-right: 8px;" />
                <span class="label">Dashboard</span>
            </a>
        </li>

        <!-- Scheduling -->
        <li>
            <a href="{{ route('scheduling') }}" title="Scheduling System" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/timeline-week.png" class="icon" alt="Scheduling Icon" style="margin-right: 8px;" />
                <span class="label">Scheduling</span>
            </a>
        </li>

        <!-- Inventory -->
        <li>
            <a href="{{ route('inventory') }}" title="Inventory" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/documents.png" class="icon" alt="Inventory Icon" style="margin-right: 8px;" />
                <span class="label">Inventory</span>
            </a>
        </li>

        <!-- Workforce -->
        <li>
            <a href="{{ route('workforce') }}" title="Workforce Monitoring" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/conference-call.png" class="icon" alt="Workforce Icon" style="margin-right: 8px;" />
                <span class="label">Workforce</span>
            </a>
        </li>

        <!-- Analytics -->
        <li>
            <a href="{{ route('analytics') }}" title="Analytics & Reporting" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/combo-chart--v1.png" class="icon" alt="Analytics Icon" style="margin-right: 8px;" />
                <span class="label">Analytics</span>
            </a>
        </li>

        <!-- Mailing -->
        <li class="mail-hover-container" style="position: relative;">
            <a href="#" class="mail-trigger" title="Mailing" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/new-post.png" class="icon" alt="Mailing Icon" style="margin-right: 8px;" />
                <span class="label">Mailing</span>
                <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
            </a>
            <ul class="mail-submenu">
                <li><a href="{{ route('compose') }}">Compose</a></li>
                <li><a href="{{ route('inbox') }}">Inbox</a></li>
                <li><a href="{{ route('sent') }}">Sent</a></li>
                <li><a href="{{ route('drafts') }}">Drafts</a></li>
                <li><a href="{{ route('chats') }}">Chats</a></li>
                <li><a href="{{ route('all_mails') }}">All Mail</a></li>
                <li><a href="{{ route('trash') }}">Trash</a></li>
                <li><a href="{{ route('meetings') }}">Meetings</a></li>
                <li><a href="{{ route('whatsapp') }}">WhatsApp</a></li>
            </ul>
        </li>

        <!-- Reports -->
        <li>
            <a href="{{ route('reports') }}" title="Reports" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/news.png" class="icon" alt="Reports Icon" style="margin-right: 8px;" />
                <span class="label">Reports</span>
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a href="{{ route('settings') }}" title="Settings" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/24/000000/settings.png" class="icon" alt="Settings Icon" style="margin-right: 8px;" />
                <span class="label">Settings</span>
            </a>
        </li>

        <!-- Logout -->
        <li>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" title="Logout" style="background: none; border: none; width: 100%; text-align: left; display: flex; align-items: center; padding: 8px 12px; cursor: pointer; color: inherit;">
                    <img src="https://img.icons8.com/ios-filled/24/000000/logout-rounded-left.png" class="icon" alt="Logout Icon" style="margin-right: 8px;" />
                    <span class="label">Logout</span>
                </button>
            </form>
        </li>

    </ul>
</div>

<!-- Submenu Styling -->
<style>
    .mail-submenu {
        display: none;
        position: fixed;
        top: 105px;
        left: 150px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        list-style: none;
        padding: 0;
        margin: 0;
        min-width: 80px;
        z-index: 9999;
        height: 600px;
    }

    .mail-submenu li a {
        display: block;
        padding: 10px 14px;
        color: #333;
        text-decoration: none;
    }

    .mail-submenu li a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .mail-hover-container:hover .mail-submenu {
        display: block;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: fixed;
            z-index: 999;
            background-color: white;
            left: -100%;
            top: 0;
            height: 100vh;
            transition: left 0.3s ease;
        }

        .sidebar.active {
            left: 0;
        }

        .hamburger {
            position: fixed;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            z-index: 1000;
        }

        .hamburger span {
            height: 3px;
            width: 25px;
            background-color: black;
            margin: 4px 0;
        }
    }
</style>

<!-- Sidebar Script -->
@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    // Responsive sidebar toggle
    document.getElementById("hamburger").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("active");
    });
</script>
@endsection
