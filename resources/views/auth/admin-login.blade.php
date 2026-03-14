@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="glass-card" style="width: 100%; max-width: 450px; border-top: 4px solid var(--secondary);">
        <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; font-weight: 800; color: var(--secondary);">Admin Portal</h2>
        
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Admin Email</label>
                <input type="email" name="email" id="email" class="input-field" required autofocus>
                @error('email')
                    <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-field" required>
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 1rem; background: var(--secondary); color: white;">Admin Login</button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted); font-size: 0.8rem;">
            Access restricted to authorized personnel.
        </p>
    </div>
</div>
@endsection
