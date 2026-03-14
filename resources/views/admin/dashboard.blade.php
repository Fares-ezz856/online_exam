@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--secondary);">Admin Dashboard</h1>
        <p style="color: var(--text-muted);">System Monitoring and Resource Management</p>
    </div>
    <a href="#" class="btn btn-primary">Create New Exam</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
    <div class="glass-card" style="text-align: center;">
        <span style="font-size: 3rem; font-weight: 800; color: var(--primary); display: block;">{{ $examsCount }}</span>
        <span style="color: var(--text-muted); font-weight: 600;">Total Exams</span>
    </div>
    <div class="glass-card" style="text-align: center;">
        <span style="font-size: 3rem; font-weight: 800; color: var(--secondary); display: block;">{{ $questionsCount }}</span>
        <span style="color: var(--text-muted); font-weight: 600;">Total Questions</span>
    </div>
    <div class="glass-card" style="text-align: center;">
        <span style="font-size: 3rem; font-weight: 800; color: var(--accent); display: block;">{{ $attemptsCount }}</span>
        <span style="color: var(--text-muted); font-weight: 600;">Student Attempts</span>
    </div>
</div>

<div style="margin-top: 3rem;">
    <h2 style="margin-bottom: 1.5rem; font-weight: 700;">Recent Exams</h2>
    <div class="glass-card" style="padding: 0;">
        <table style="width: 100%; border-collapse: collapse; color: var(--text-main);">
            <thead>
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 1.5rem; text-align: left;">Exam Name</th>
                    <th style="padding: 1.5rem; text-align: left;">Questions</th>
                    <th style="padding: 1.5rem; text-align: left;">Created At</th>
                    <th style="padding: 1.5rem; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentExams as $exam)
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="padding: 1.5rem;">{{ $exam->title }}</td>
                        <td style="padding: 1.5rem;">{{ $exam->questions_count }} Qs</td>
                        <td style="padding: 1.5rem;">{{ $exam->created_at->diffForHumans() }}</td>
                        <td style="padding: 1.5rem; text-align: right;">
                            <a href="{{ route('admin.exams.show', $exam->id) }}" style="color: var(--primary); text-decoration: none;">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 2rem; text-align: center; color: var(--text-muted);">No exams found. Create your first exam to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
