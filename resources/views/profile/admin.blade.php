@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--secondary);">Admin Profile</h1>
        <p style="color: var(--text-muted);">Manage your administrative account details.</p>
    </div>

    @if(session('success'))
        <div class="glass-card" style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid var(--success); margin-bottom: 2rem; padding: 1rem;">
            <p style="color: var(--success); margin: 0;">{{ session('success') }}</p>
        </div>
    @endif

    <div class="glass-card">
        <form action="{{ route('admin.profile') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label class="label">Admin Name</label>
                <input type="text" name="name" class="input-field" value="{{ old('name', $admin->name) }}" required>
                @error('name') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="label">Email Address</label>
                <input type="email" name="email" class="input-field" value="{{ old('email', $admin->email) }}" required>
                @error('email') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <hr style="border: 0; border-top: 1px solid var(--glass-border); margin: 2rem 0;">
            <p style="font-weight: 600; margin-bottom: 1rem;">Security Settings <span style="font-weight: 400; font-size: 0.8rem; color: var(--text-muted);">(Leave password blank to keep current)</span></p>

            <div style="margin-bottom: 1.5rem;">
                <label class="label">New Admin Password</label>
                <input type="password" name="password" class="input-field">
                @error('password') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="input-field">
            </div>

            <button type="submit" class="btn" style="width: 100%; background: var(--secondary); color: white;">Update Admin Profile</button>
        </form>
    </div>
</div>
@endsection
