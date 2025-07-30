<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Customer Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        color: #333;
    }
    .container {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    header {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #ddd;
    }
    .username {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1f2937;
    }
    form.logout-form {
        margin: 0;
    }
    button.logout-btn {
        background-color: #ef4444;
        border: none;
        color: white;
        padding: 0.5rem 1.1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    button.logout-btn:hover {
        background-color: #dc2626;
    }
    main {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
        margin-top: 2rem;
    }
    /* Profile Summary */
    .profile-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
        text-align: center;
    }
    .profile-card img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #4f46e5;
        margin-bottom: 1rem;
    }
    .profile-card h2 {
        margin: 0.3rem 0 0.5rem;
        font-size: 1.6rem;
        color: #111827;
    }
    .profile-card p.role {
        font-size: 1rem;
        color: #6b7280;
        margin: 0 0 1.5rem;
    }
    .actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }
    .actions a {
        background-color: #4f46e5;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }
    .actions a:hover {
        background-color: #4338ca;
    }
    /* Dashboard stats */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(150px,1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem 2rem;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .stat-card h3 {
        font-size: 1.25rem;
        margin: 0 0 0.5rem;
        color: #4f46e5;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #111827;
    }
    /* Recent updates */
    .updates {
        background: white;
        border-radius: 12px;
        padding: 1.5rem 2rem;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
    }
    .updates h3 {
        margin-top: 0;
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .update-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 0.75rem 0;
        font-size: 0.95rem;
        color: #374151;
    }
    .update-item:last-child {
        border-bottom: none;
    }
    .update-item span.date {
        float: right;
        font-size: 0.85rem;
        color: #9ca3af;
        font-style: italic;
    }

    /* Responsive */
    @media (max-width: 800px) {
        main {
            grid-template-columns: 1fr;
        }
        .actions {
            flex-direction: column;
            gap: 0.7rem;
        }
    }
</style>
</head>
<body>
<div class="container">
    <header>
        <div class="username">Hi, {{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>

    <main>
        <section class="profile-card">
            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4f46e5&color=fff&size=120' }}" alt="Profile Picture" />
            <h2>{{ Auth::user()->name }}</h2>
            <p class="role">Role: {{ ucfirst(Auth::user()->role) }}</p>

            <div class="actions">
                <a href="{{ route('profile.show') }}">View Profile</a>
                <a href="{{ route('profile.edit') }}">Edit Info</a>
                <a href="{{ route('password.change') }}">Change Password</a>
            </div>
        </section>

        <section>
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Events</h3>
                    <div class="stat-number">12</div>
                </div>
                <div class="stat-card">
                    <h3>Projects</h3>
                    <div class="stat-number">7</div>
                </div>
                <div class="stat-card">
                    <h3>Products</h3>
                    <div class="stat-number">24</div>
                </div>
                <div class="stat-card">
                    <h3>Services</h3>
                    <div class="stat-number">5</div>
                </div>
            </div>

            <div class="updates">
                <h3>Recent Updates</h3>
                <div class="update-item">
                    <strong>New Project launched:</strong> "Website Redesign" <span class="date">2025-07-28</span>
                </div>
                <div class="update-item">
                    <strong>Service updated:</strong> Premium Support Plan <span class="date">2025-07-25</span>
                </div>
                <div class="update-item">
                    <strong>Event reminder:</strong> Webinar on Digital Marketing <span class="date">2025-07-20</span>
                </div>
                <div class="update-item">
                    <strong>Product back in stock:</strong> Wireless Headphones <span class="date">2025-07-15</span>
                </div>
                <div class="update-item">
                    <strong>Appointments: <a href="#">View</a></span>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
