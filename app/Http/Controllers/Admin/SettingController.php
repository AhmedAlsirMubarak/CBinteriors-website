<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
}