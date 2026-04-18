@extends('layouts.admin')
@section('title', 'Settings')
@section('heading', 'Site Settings')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="space-y-6 max-w-3xl">

        @foreach($settings as $group => $groupSettings)
            <div class="admin-card p-6">
                <h2 class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400 mb-5">
                    {{ ucfirst($group) }}
                </h2>
                <div class="space-y-5">
                    @foreach($groupSettings as $setting)
                        @php
                            $key   = is_array($setting) ? $setting['key']   : $setting->key;
                            $label = is_array($setting) ? $setting['label'] : $setting->label;
                            $type  = is_array($setting) ? $setting['type']  : $setting->type;
                            $value = is_array($setting) ? $setting['value'] : $setting->value;
                        @endphp
                        <div>
                            <label class="admin-label">{{ $label }}</label>

                            @if($type === 'textarea')
                                <textarea name="settings[{{ $key }}]" rows="3"
                                          class="admin-textarea">{{ old('settings.' . $key, $value) }}</textarea>

                            @elseif($type === 'image')
                                @if($value)
                                    <div class="flex items-center gap-4 mb-2">
                                        <img src="{{ asset('storage/' . $value) }}" alt=""
                                             class="w-16 h-16 object-contain rounded border border-cb-gray-200 bg-cb-gray-50">
                                        <p class="font-body text-xs text-cb-gray-400">Upload a new file to replace</p>
                                    </div>
                                @endif
                                <input name="settings[{{ $key }}]" type="file" accept="image/*"
                                       class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">

                            @else
                                <input name="settings[{{ $key }}]" type="text"
                                       value="{{ old('settings.' . $key, $value) }}"
                                       class="admin-input">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex items-center gap-3 pb-6">
            <button type="submit" class="admin-btn-primary rounded-lg">Save All Settings</button>
        </div>
    </div>
</form>

{{-- ── Account ──────────────────────────────────────────── --}}
<div class="max-w-3xl mt-2 pb-8">
    @if(session('account_success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-800 font-body text-sm flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('account_success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.account') }}">
        @csrf @method('PUT')

        <div class="admin-card p-6">
            <h2 class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400 mb-5">Account</h2>

            <div class="space-y-5">

                {{-- Email --}}
                <div>
                    <label class="admin-label">Email Address</label>
                    <input name="email" type="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="admin-input @error('email') border-red-400 @enderror"
                           required autocomplete="email">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Current password confirmation --}}
                <div>
                    <label class="admin-label">Current Password <span class="normal-case font-normal text-cb-gray-400">(required to save changes)</span></label>
                    <input name="current_password" type="password"
                           class="admin-input @error('current_password') border-red-400 @enderror"
                           autocomplete="current-password">
                    @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="border-t border-cb-gray-100 pt-5">
                    <p class="font-body text-xs text-cb-gray-400 mb-4">Leave new password blank to keep current password.</p>

                    {{-- New password --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="admin-label">New Password</label>
                            <input name="password" type="password"
                                   class="admin-input @error('password') border-red-400 @enderror"
                                   autocomplete="new-password">
                            @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="admin-label">Confirm New Password</label>
                            <input name="password_confirmation" type="password"
                                   class="admin-input"
                                   autocomplete="new-password">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="admin-btn-primary rounded-lg">Update Account</button>
        </div>
    </form>
</div>

@endsection
