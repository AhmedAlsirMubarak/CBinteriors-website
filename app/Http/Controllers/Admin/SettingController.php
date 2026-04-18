<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::allGrouped();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Text/textarea values come as settings[key] => value
        foreach ($request->input('settings', []) as $key => $value) {
            Setting::set($key, $value);
        }

        // Image uploads come as settings[key] => UploadedFile
        foreach ($request->file('settings', []) as $key => $file) {
            $old = Setting::get($key);
            if ($old) Storage::disk('public')->delete($old);
            Setting::set($key, $file->store('settings', 'public'));
        }

        Cache::forget('site_settings');

        return back()->with('success', 'Settings saved successfully.');
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'email'            => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'password'         => ['nullable', 'confirmed', Password::min(8)],
        ];

        $data = $request->validate($rules);

        // Require current password if changing email or setting new password
        $changingEmail    = $data['email'] !== $user->email;
        $changingPassword = filled($data['password'] ?? null);

        if ($changingEmail || $changingPassword) {
            if (empty($data['current_password']) || ! Hash::check($data['current_password'], $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Current password is incorrect.'])
                    ->withInput();
            }
        }

        if ($changingEmail) {
            $user->email = $data['email'];
        }

        if ($changingPassword) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return back()->with('account_success', 'Account updated successfully.');
    }
}