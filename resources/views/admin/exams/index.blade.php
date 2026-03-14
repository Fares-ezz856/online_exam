@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Manage Exams</h1>
        <p style="color: var(--text-muted);">Create, update and manage your online examinations.</p>
    </div>
    <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">Create New Exam</a>
</div>

<div class="glass-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; color: var(--text-main);">
        <thead>
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1.5rem; text-align: left;">Exam ID</th>
                <th style="padding: 1.5rem; text-align: left;">Title</th>
                <th style="padding: 1.5rem; text-align: left;">Questions</th>
                <th style="padding: 1.5rem; text-align: left;">Duration</th>
                <th style="padding: 1.5rem; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($exams as $exam)
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 1.5rem;">#{{ $exam->id }}</td>
                    <td style="padding: 1.5rem; font-weight: 600;">{{ $exam->title }}</td>
                    <td style="padding: 1.5rem;"><span style="background: var(--accent); padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.8rem;">{{ $exam->questions_count }} Qs</span></td>
                    <td style="padding: 1.5rem;">{{ $exam->duration }} mins</td>
                    <td style="padding: 1.5rem; text-align: right;">
                        <a href="{{ route('admin.exams.show', $exam->id) }}" style="color: var(--primary); text-decoration: none; margin-left: 1rem;">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: var(--text-muted);">No exams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
