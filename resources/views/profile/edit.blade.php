@section('title', 'Edit Profile')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-container">
    <h1 class="profile-title">Edit Profile</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

    {{-- Edit Profile Form --}}
    <form action="{{ route('profile.update') }}" method="POST" class="edit-profile-form">
        @csrf
        @method('PUT')

        <div class="profile-field">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="profile-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="profile-field">
            <label for="password">New Password: <small>(Leave blank to keep current password)</small></label>
            <input type="password" id="password" name="password" autocomplete="new-password">
        </div>

        <div class="profile-field">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-icon save-icon" title="Save Changes">💾</button>
        <a href="{{ route('profile.show') }}" class="btn btn-icon cancel-icon" title="Cancel">✕</a>
    </form>
</div>

{{-- JS for alert hiding --}}
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 4000);
        }
    });
</script>
