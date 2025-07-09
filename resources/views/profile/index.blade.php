@section('title', 'My Profile')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-container">
    <h1 class="profile-title">My Profile</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Image Section --}}
    <div class="profile-image-section">
        <form action="{{ route('profile.uploadImage') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <label for="imageUpload" class="image-upload-label">
                @if($user->profile_image)
                    <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="Profile Image" class="profile-image">
                @else
                    <div class="profile-image-placeholder">No Image</div>
                @endif
                <span class="upload-icon">＋</span>
            </label>
            <input type="file" name="profile_image" id="imageUpload" accept="image/*" onchange="document.getElementById('uploadForm').submit();">
        </form>
    </div>

    {{-- Profile Details --}}
    <div class="profile-details">
        <div class="profile-field">
            <label>Name:</label>
            <p>{{ $user->name }}</p>
        </div>

        <div class="profile-field">
            <label>Email:</label>
            <p>{{ $user->email }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="profile-actions">
        <a href="{{ route('profile.edit') }}" class="btn btn-icon edit-icon" title="Edit Profile">✎</a>

        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?')">
            @csrf
            <button type="submit" class="btn btn-icon delete-icon" title="Delete Account">🗑️</button>
        </form>
    </div>
</div>



{{-- JS for alert & toggle --}}
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 4000);
        }

        const toggleBtn = document.getElementById('toggle-more');
        const extra = document.getElementById('extra-fields');

        toggleBtn.addEventListener('click', () => {
            extra.style.display = extra.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
