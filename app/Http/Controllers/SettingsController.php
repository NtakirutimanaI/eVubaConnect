<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    // Show settings page
    public function index()
    {
        $settings = [];
        if (Storage::exists('settings.json')) {
            $settings = json_decode(Storage::get('settings.json'), true);
        }

        return view('admin.settings', compact('settings'));
    }

    // Save settings
    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->storeAs('public/uploads', 'company_logo.' . $logo->getClientOriginalExtension());
            $data['logo'] = str_replace('public/', 'storage/', $logoPath);
        }

        Storage::put('settings.json', json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }
}
