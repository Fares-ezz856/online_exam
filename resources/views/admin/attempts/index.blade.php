@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--accent);">Student Attempts</h1>
    <p style="color: var(--text-muted);">Monitor student performance and exam completion status.</p>
</div>

<div class="glass-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; color: var(--text-main);">
        <thead>
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1.5rem; text-align: left;">Student</th>
                <th style="padding: 1.5rem; text-align: left;">Exam</th>
                <th style="padding: 1.5rem; text-align: left;">Score</th>
                <th style="padding: 1.5rem; text-align: left;">Date</th>
                <th style="padding: 1.5rem; text-align: right;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attempts as $attempt)
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 1.5rem; font-weight: 600;">{{ $attempt->user->name }}</td>
                    <td style="padding: 1.5rem;">{{ $attempt->exam->title }}</td>
                    <td style="padding: 1.5rem;">
                        <span style="font-size: 1.1rem; font-weight: 700; color: {{ $attempt->score >= 50 ? 'var(--success)' : 'var(--warning)' }}">
                            {{ round($attempt->score) }}%
                        </span>
                    </td>
                    <td style="padding: 1.5rem; color: var(--text-muted);">{{ $attempt->created_at->format('M d, Y H:i') }}</td>
                    <td style="padding: 1.5rem; text-align: right;">
                        <span style="background: {{ $attempt->score >= 50 ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $attempt->score >= 50 ? 'var(--success)' : 'var(--warning)' }}; padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                            {{ $attempt->score >= 50 ? 'Passed' : 'Failed' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: var(--text-muted);">No attempts recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
