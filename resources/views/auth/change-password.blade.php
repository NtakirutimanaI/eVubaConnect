
<div style="max-width: 500px; margin: 2rem auto; font-family: 'Inter', sans-serif; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <h2 style="margin-bottom: 20px; font-size: 1.5rem; color: #1f2937;">Change Password</h2>

    @if (session('status'))
        <div style="color: green; margin-bottom: 15px; font-size: 0.95rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="current_password" style="display: block; margin-bottom: 5px; font-weight: 600;">Current Password</label>
            <input id="current_password" type="password" name="current_password" required
                   style="width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 6px;" />
            @error('current_password')
                <div style="color: red; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: 600;">New Password</label>
            <input id="password" type="password" name="password" required
                   style="width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 6px;" />
            @error('password')
                <div style="color: red; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: 600;">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   style="width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 6px;" />
        </div>

        <button type="submit" style="padding: 0.6rem 1.2rem; background-color: #4f46e5; color: white; font-weight: 600; border: none; border-radius: 6px; cursor: pointer;">
            Update Password
        </button>
    </form>
</div>
