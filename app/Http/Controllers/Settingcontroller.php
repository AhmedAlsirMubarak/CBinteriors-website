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
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Handle image uploads separately
            if ($request->hasFile($key)) {
                $old = Setting::get($key);
                if ($old) Storage::disk('public')->delete($old);
                $value = $request->file($key)->store('settings', 'public');
            }

            Setting::set($key, $value);
        }

        // Handle image fields that weren't in the form (file inputs)
        foreach ($request->allFiles() as $key => $file) {
            $old = Setting::get($key);
            if ($old) Storage::disk('public')->delete($old);
            Setting::set($key, $file->store('settings', 'public'));
        }

        Cache::forget('site_settings');

        return back()->with('success', 'Settings saved successfully.');
    }
}