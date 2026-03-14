<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Online Exam') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">

    @yield('styles')
</head>
<body>
    <nav>
        <div class="logo">EXAM.PI</div>
        <div class="nav-links">
            @auth
                @if(auth()->guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.exams.index') }}">Manage Exams</a>
                @else
                    <a href="{{ route('student.dashboard') }}">Dashboard</a>
                    <a href="{{ route('student.dashboard') }}">My Exams</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.8rem;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('admin.login') }}" style="color: var(--secondary)">Admin Login</a>
            @endauth
        </div>
    </nav>

    <main class="animate-fade-in" style="padding: 2rem 5%;">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
