<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
     // Show the profile page
    public function show()
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    // Show the edit form
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    // Update the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    // Delete user account
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password does not match our records.']);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }

    public function uploadImage(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    // Store new image
    $imageName = time() . '.' . $request->profile_image->extension();
    $request->profile_image->move(public_path('storage/profile_images'), $imageName);

    // Optionally delete old one
    if ($user->profile_image && file_exists(public_path('storage/profile_images/' . $user->profile_image))) {
        unlink(public_path('storage/profile_images/' . $user->profile_image));
    }

    // Update user
    $user->profile_image = $imageName;
    $user->save();

    return back()->with('success', 'Profile image updated successfully.');
}
}
