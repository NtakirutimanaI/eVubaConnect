@include('admin.header')
@include('admin.sidebar')

<title>eVubaConnect Settings</title>

<style>
    body {
        background-color: #f4f6f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12px;
        color: #333;
    }

    .settings-container {
        margin-left: 17%;
        margin-top: 70px;
        padding: 20px;
        background-color: #f4f6f8;
    }

    .settings-header {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .grid-settings {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .setting-box {
        background-color: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .setting-box:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .setting-box h5 {
        font-size: 13px;
        font-weight: 600;
        color: #0078d7;
        margin-top: 10px;
    }

    .setting-box img {
        width: 40px;
        height: 40px;
        margin-bottom: 8px;
    }

    .setting-box p {
        font-size: 11px;
        color: #666;
        margin: 4px 0 0 0;
    }

    .settings-section {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        display: none; /* Hide all sections by default */
    }

    .settings-section.active {
        display: block;
    }

    .settings-section h4 {
        color: #2c3e50;
        font-size: 13px;
        border-bottom: 1px solid #e2e2e2;
        padding-bottom: 5px;
        margin-bottom: 12px;
    }

    .settings-section label {
        font-weight: 600;
        font-size: 11px;
        display: block;
        margin-top: 6px;
        color: #333;
    }

    .settings-section input,
    .settings-section select,
    .settings-section textarea {
        width: 100%;
        padding: 6px;
        font-size: 11px;
        margin-top: 4px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background: #fdfdfd;
    }

    .settings-section textarea {
        resize: vertical;
    }

    .settings-section button,
    button[type="submit"] {
        margin-top: 10px;
        background: #0078d7;
        color: white;
        padding: 6px 14px;
        font-size: 11px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>

<div class="settings-container">
    <h2 class="settings-header">⚙️ eVubaConnect System Settings</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="grid-settings">
        <div class="setting-box" onclick="openSetting('general')">
            <img src="https://img.icons8.com/ios/50/settings--v1.png"/>
            <h5>General</h5>
            <p>Brand name, timezone, language</p>
        </div>
        <div class="setting-box" onclick="openSetting('user_roles')">
            <img src="https://img.icons8.com/ios/50/conference.png"/>
            <h5>User Roles</h5>
            <p>Permissions, defaults, roles</p>
        </div>
        <div class="setting-box" onclick="openSetting('ai')">
            <img src="https://img.icons8.com/ios/50/artificial-intelligence.png"/>
            <h5>AI & Automation</h5>
            <p>Bot settings, follow-ups</p>
        </div>
        <div class="setting-box" onclick="openSetting('appointments')">
            <img src="https://img.icons8.com/ios/50/calendar--v1.png"/>
            <h5>Appointments</h5>
            <p>Working hours, buffer time</p>
        </div>
        <div class="setting-box" onclick="openSetting('inventory')">
            <img src="https://img.icons8.com/ios/50/box.png"/>
            <h5>Inventory</h5>
            <p>Stock alerts, auto-reorder</p>
        </div>
        <div class="setting-box" onclick="openSetting('notifications')">
            <img src="https://img.icons8.com/ios/50/appointment-reminders--v1.png"/>
            <h5>Notifications</h5>
            <p>Email/SMS setup</p>
        </div>
        <div class="setting-box" onclick="openSetting('reports')">
            <img src="https://img.icons8.com/ios/50/combo-chart--v1.png"/>
            <h5>Reports</h5>
            <p>Schedule, key metrics</p>
        </div>
        <div class="setting-box" onclick="openSetting('integrations')">
            <img src="https://img.icons8.com/ios/50/api-settings.png"/>
            <h5>Integrations</h5>
            <p>CRM, calendar, payments</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="settings-section" id="section-general">
            <h4>1. General Settings</h4>
            <label>Company Name</label>
            <input type="text" name="company_name" value="{{ $settings['company_name'] ?? '' }}">
            <label>Logo Upload</label>
            <input type="file" name="logo">
            <label>Default Timezone</label>
            <select name="timezone">
                <option value="Africa/Kigali" {{ ($settings['timezone'] ?? '') === 'Africa/Kigali' ? 'selected' : '' }}>Africa/Kigali</option>
                <option value="UTC" {{ ($settings['timezone'] ?? '') === 'UTC' ? 'selected' : '' }}>UTC</option>
            </select>
            <label>Default Language</label>
            <select name="language">
                <option value="English" {{ ($settings['language'] ?? '') === 'English' ? 'selected' : '' }}>English</option>
                <option value="Kinyarwanda" {{ ($settings['language'] ?? '') === 'Kinyarwanda' ? 'selected' : '' }}>Kinyarwanda</option>
            </select>
            <label>Date/Time Format</label>
            <input type="text" name="datetime_format" value="{{ $settings['datetime_format'] ?? 'Y-m-d H:i' }}">
        </div>

        <div class="settings-section" id="section-user_roles">
            <h4>2. User & Role Settings</h4>
            <label>Default Role for New Users</label>
            <select name="default_role">
                <option>Staff</option>
                <option>Manager</option>
                <option>Admin</option>
            </select>
            <label>Manage Permissions</label>
            <textarea name="role_permissions">{{ $settings['role_permissions'] ?? '' }}</textarea>
        </div>

        <div class="settings-section" id="section-ai">
            <h4>3. AI & Automation Settings</h4>
            <label>Enable Chatbot</label>
            <select name="chatbot_enabled">
                <option>Yes</option>
                <option>No</option>
            </select>
            <label>Auto-Response Threshold (seconds)</label>
            <input type="number" name="response_threshold" value="{{ $settings['response_threshold'] ?? '5' }}">
            <label>Follow-up Frequency (days)</label>
            <input type="number" name="followup_days" value="{{ $settings['followup_days'] ?? '3' }}">
        </div>

        <div class="settings-section" id="section-appointments">
            <h4>4. Appointment & Visit Settings</h4>
            <label>Working Hours</label>
            <input type="text" name="working_hours" value="{{ $settings['working_hours'] ?? '08:00 - 17:00' }}">
            <label>Appointment Buffer (minutes)</label>
            <input type="number" name="appointment_buffer" value="{{ $settings['appointment_buffer'] ?? '15' }}">
        </div>

        <div class="settings-section" id="section-inventory">
            <h4>5. Inventory Management Settings</h4>
            <label>Default Stock Alert Threshold</label>
            <input type="number" name="stock_threshold" value="{{ $settings['stock_threshold'] ?? '10' }}">
            <label>Enable Auto-Reorder Suggestion</label>
            <select name="auto_reorder">
                <option>Yes</option>
                <option>No</option>
            </select>
        </div>

        <div class="settings-section" id="section-notifications">
            <h4>6. Notification & Messaging</h4>
            <label>Email Gateway</label>
            <input type="text" name="email_gateway" value="{{ $settings['email_gateway'] ?? '' }}">
            <label>SMS Gateway</label>
            <input type="text" name="sms_gateway" value="{{ $settings['sms_gateway'] ?? '' }}">
            <label>Custom Notification Template</label>
            <textarea name="notification_template">{{ $settings['notification_template'] ?? '' }}</textarea>
        </div>

        <div class="settings-section" id="section-reports">
            <h4>7. Report & Analytics Preferences</h4>
            <label>Schedule Report Generation</label>
            <select name="report_schedule">
                <option>Daily</option>
                <option>Weekly</option>
                <option>Monthly</option>
            </select>
            <label>Key Metrics to Track</label>
            <textarea name="metrics_to_track">{{ $settings['metrics_to_track'] ?? '' }}</textarea>
        </div>

        <div class="settings-section" id="section-integrations">
            <h4>8. Integration Settings</h4>
            <label>CRM Integration</label>
            <input type="text" name="crm_integration" value="{{ $settings['crm_integration'] ?? '' }}">
            <label>Payment Gateway</label>
            <input type="text" name="payment_gateway" value="{{ $settings['payment_gateway'] ?? '' }}">
            <label>Calendar Sync</label>
            <select name="calendar_sync">
                <option>Google Calendar</option>
                <option>Outlook</option>
            </select>
        </div>

        <button type="submit">💾 Save Settings</button>
    </form>
</div>

@include('admin.footer')

<script>
    function openSetting(settingKey) {
        const sections = document.querySelectorAll('.settings-section');
        sections.forEach(section => section.classList.remove('active'));

        const target = document.getElementById(`section-${settingKey.toLowerCase()}`);
        if (target) {
            target.classList.add('active');
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
