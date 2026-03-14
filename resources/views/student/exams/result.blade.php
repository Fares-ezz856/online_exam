@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="glass-card" style="width: 100%; max-width: 600px; text-align: center; padding: 4rem 2rem;">
        <div style="margin-bottom: 2rem;">
            @if($percentage >= 50)
                <div style="font-size: 5rem; color: var(--success); margin-bottom: 1rem;">🎉</div>
                <h1 style="font-size: 2.5rem; font-weight: 800;">Exam Completed!</h1>
                <p style="color: var(--text-muted);">Congratulations, you've passed the exam.</p>
            @else
                <div style="font-size: 5rem; color: var(--warning); margin-bottom: 1rem;">📚</div>
                <h1 style="font-size: 2.5rem; font-weight: 800;">Keep Practicing!</h1>
                <p style="color: var(--text-muted);">You've finished the exam. Review your results below.</p>
            @endif
        </div>

        <div class="glass-card" style="background: rgba(15, 23, 42, 0.4); margin-bottom: 2.5rem; display: flex; justify-content: space-around; padding: 2rem;">
            <div>
                <span style="display: block; font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">SCORE</span>
                <span style="font-size: 2.5rem; font-weight: 800;">{{ $score }}/{{ $total }}</span>
            </div>
            <div style="width: 1px; background: var(--glass-border);"></div>
            <div>
                <span style="display: block; font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">PERCENTAGE</span>
                <span style="font-size: 2.5rem; font-weight: 800; color: {{ $percentage >= 50 ? 'var(--success)' : 'var(--warning)' }}">{{ round($percentage) }}%</span>
            </div>
        </div>

        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary" style="flex: 1;">Back to Dashboard</a>
            <a href="#" class="btn" style="flex: 1; border: 1px solid var(--border);">Review Answers</a>
        </div>
    </div>
</div>
@endsection
