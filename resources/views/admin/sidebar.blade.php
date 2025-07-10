<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="sidebar" id="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" title="Dashboard" style="background-color: #007bff; color: white; display: flex; align-items: center; padding: 8px 12px; text-decoration: none;">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/home.png" class="icon" alt="Dashboard Icon" style="margin-right: 8px;" />
                <span class="label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('scheduling') }}" title="Scheduling System" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/timeline-week.png" class="icon" alt="Scheduling Icon" style="margin-right: 8px;" />
                <span class="label">Scheduling</span>
            </a>
        </li>
        <li>
            <a href="#" title="Inventory" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/documents.png" class="icon" alt="Inventory Icon" style="margin-right: 8px;" />
                <span class="label">Inventory</span>
            </a>
        </li>
        <li>
            <a href="#" title="Workforce Monitoring" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/conference-call.png" class="icon" alt="Workforce Icon" style="margin-right: 8px;" />
                <span class="label">Workforce</span>
            </a>
        </li>
        <li>
            <a href="#" title="Analytics & Reporting" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/combo-chart--v1.png" class="icon" alt="Analytics Icon" style="margin-right: 8px;" />
                <span class="label">Analytics</span>
            </a>
        </li>
        <li>
            <a href="#" title="Reports" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/news.png" class="icon" alt="Reports Icon" style="margin-right: 8px;" />
                <span class="label">Reports</span>
            </a>
        </li>
        <li>
            <a href="#" title="Permissions" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/lock-2.png" class="icon" alt="Permissions Icon" style="margin-right: 8px;" />
                <span class="label">Permissions</span>
            </a>
        </li>
        <li>
            <a href="#" title="Settings" style="display: flex; align-items: center; padding: 8px 12px; text-decoration: none; color: inherit;">
                <img src="https://img.icons8.com/ios-filled/50/000000/settings.png" class="icon" alt="Settings Icon" style="margin-right: 8px;" />
                <span class="label">Settings</span>
            </a>
        </li>
    </ul>
</div>

<script>
    lucide.createIcons();
</script>

@section('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
