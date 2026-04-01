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

@endsection
