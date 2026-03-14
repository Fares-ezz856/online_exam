@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.exams.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">&larr; Back to Exams</a>
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-top: 0.5rem;">Create New Exam</h1>
</div>

<div class="glass-card" style="max-width: 800px;">
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf
        <div class="input-group">
            <label for="title">Exam Title</label>
            <input type="text" name="title" id="title" class="input-field" required placeholder="e.g. Advanced Laravel Certification">
            @error('title')
                <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="input-field" rows="4" placeholder="Briefly describe what this exam covers..."></textarea>
            @error('description')
                <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group">
            <label for="duration">Duration (Minutes)</label>
            <input type="number" name="duration" id="duration" class="input-field" required min="1" value="60">
            @error('duration')
                <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Create Exam</button>
            <a href="{{ route('admin.exams.index') }}" class="btn" style="flex: 1; border: 1px solid var(--border);">Cancel</a>
        </div>
    </form>
</div>
@endsection
