<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<div class="topbar">
    {{-- Logo --}}
    <div class="topbar-logo">
        <img src="{{ asset('images/eVuba.png') }}" alt="eVubaConnect">
        <span>eVubaConnect</span>
    </div>

    {{-- Mega Search --}}
    <div class="mega-search">
        <button class="search-icon" id="searchBtn">🔍</button>
        <input type="text" placeholder="Search Everything" class="search-input" id="searchInput">
    </div>

    {{-- Icons --}}
    <div class="topbar-icons">
        {{-- Add Button --}}
        <button class="btn-circle btn-blue">+</button>

        {{-- Theme Toggle --}}
        <button class="icon-button">🌗</button>

        {{-- Notifications --}}
        <button class="icon-button" title="Notifications">🔔</button>

        {{-- Messages --}}
        <button class="icon-button" title="Messages">✉️</button>

        {{-- User Avatar (Clickable Link) --}}
        <a href="{{ route('profile.show') }}">
            @auth
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" alt="Avatar" class="avatar-img">
                @else
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            @else
                <div class="avatar">👤</div>
            @endauth
        </a>
    </div>
</div>

<script>
    document.getElementById('searchBtn').addEventListener('click', function (e) {
        e.preventDefault();
        const query = document.getElementById('searchInput').value.trim();

        if (query) {
            console.log('Searching for:', query);
            // Example: redirect to a search results page
            // window.location.href = `/search?q=${encodeURIComponent(query)}`;
        } else {
            alert('Please enter a search term.');
        }
    });
</script>
