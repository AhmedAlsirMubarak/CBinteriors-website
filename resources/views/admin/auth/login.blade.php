<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — CB Interiors</title>
    @vite(['resources/css/admin.css'])
</head>
<body class="h-full flex items-center justify-center bg-cb-gray-50">

<div class="w-full max-w-sm px-6">

    {{-- Logo --}}
    <div class="text-center mb-10">
        <div class="flex flex-col items-center leading-none mb-2">
        <img src="{{ asset('images/black-logo.png') }}" class="h-30" alt="CB Interiors Logo">
        </div>
    </div>

    {{-- Card --}}
    <div class="admin-card p-8">
        <h1 class="font-body text-base font-medium text-cb-black mb-6">Sign in to continue</h1>

            @if($errors->any())
            <div class="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 font-body text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="admin-label">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       class="admin-input @error('email') border-red-400 @enderror"
                       placeholder="email@domain.com" required autofocus>
            </div>
            <div>
                <label for="password" class="admin-label">Password</label>
                <input id="password" name="password" type="password"
                       class="admin-input @error('password') border-red-400 @enderror"
                       placeholder="••••••••" required>
            </div>
            <button type="submit" class="admin-btn-primary w-full justify-center rounded-lg py-2.5 mt-2">
                Sign In
            </button>
        </form>
    </div>

    <p class="text-center font-body text-xs text-cb-gray-400 mt-6">
        <a href="{{ route('home') }}" class="hover:text-cb-black transition-colors">← Back to website</a>
    </p>
</div>

</body>
</html>
