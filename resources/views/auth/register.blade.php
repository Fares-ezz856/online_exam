@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="glass-card" style="width: 100%; max-width: 500px;">
        <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 800;">Join EXAM.PI</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="input-field" required value="{{ old('name') }}">
                @error('name')
                    <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="input-field" required value="{{ old('email') }}">
                @error('email')
                    <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-field" required>
                @error('password')
                    <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Register</button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Login here</a>
        </p>
    </div>
</div>
@endsection
