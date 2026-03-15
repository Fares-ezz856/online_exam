@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.exams.show', $question->exam_id) }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">&larr; Back to Exam</a>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800;">Edit Question</h1>
    </div>
</div>

<div class="glass-card" style="margin-bottom: 2rem; border-left: 4px solid var(--primary);">
    <form action="{{ route('admin.updatequestion.submit', $question->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <label>Question Title</label>
            <input type="text" name="title" class="input-field" required value="{{ old('title', $question->question) }}" placeholder="e.g. What is a Service Provider in Laravel?">
        </div>

        <div id="optionsContainer" style="margin-bottom: 1.5rem;">
            <label style="color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 1rem;">Options (Mark the correct one)</label>
            <div style="display: grid; gap: 0.8rem;">
                @foreach($question->options as $index => $option)
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="radio" name="correct_option" value="{{ $index }}" required {{ $option->is_correct ? 'checked' : '' }}>
                    <input type="text" name="options[]" class="input-field" required value="{{ old('options.'.$index, $option->text_option) }}" placeholder="Option {{ $index + 1 }}">
                </div>
                @endforeach
                
                @if($question->options->count() < 4)
                    @for($i = $question->options->count(); $i < 4; $i++)
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="radio" name="correct_option" value="{{ $i }}" required>
                        <input type="text" name="options[]" class="input-field" required placeholder="Option {{ $i + 1 }}">
                    </div>
                    @endfor
                @endif
            </div>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Update Question</button>
            <a href="{{ route('admin.exams.show', $question->exam_id) }}" class="btn" style="border: 1px solid var(--border); text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">Cancel</a>
        </div>
    </form>
</div>
@endsection
