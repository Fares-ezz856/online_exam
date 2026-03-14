@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Student Dashboard</h1>
    <p style="color: var(--text-muted);">Welcome back, {{ auth()->user()->name }}. Ready for your next challenge?</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
    @forelse($exams as $exam)
        <div class="glass-card">
            <h3 style="margin-bottom: 0.5rem; color: var(--primary);">{{ $exam->title }}</h3>
            <p style="color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1rem;">{{ $exam->questions_count }} Questions | {{ $exam->duration }} mins</p>
            <p style="color: var(--text-main); font-size: 0.9rem; margin-bottom: 1.5rem; height: 3rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                {{ $exam->description ?? 'No description available for this exam.' }}
            </p>
            <a href="{{ route('student.exams.taking', $exam->id) }}" class="btn btn-primary" style="width: 100%;">Start Exam</a>
        </div>
    @empty
        <div class="glass-card" style="grid-column: 1 / -1; text-align: center;">
            <p style="color: var(--text-muted);">No exams available at the moment. Please check back later!</p>
        </div>
    @endforelse

    <!-- System Stats -->
    <div class="glass-card" style="grid-column: 1 / -1; margin-top: 1rem;">
        <h3 style="margin-bottom: 1rem; color: var(--accent);">Your Progress</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>Exams Taken</span>
                <span style="font-weight: 700; font-size: 1.5rem;">0</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>Average Score</span>
                <span style="font-weight: 700; font-size: 1.5rem; color: var(--success);">-%</span>
            </div>
        </div>
    </div>
</div>
@endsection
