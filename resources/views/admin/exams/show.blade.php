@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.exams.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">&larr; Back to Exams</a>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800;">{{ $exam->title }}</h1>
        <div style="display: flex; gap: 1rem;">
            <a href="#" class="btn" style="border: 1px solid var(--border);">Edit Exam</a>
            <button class="btn btn-primary" onclick="toggleQuestionForm()">Add Question</button>
        </div>
    </div>
    <p style="color: var(--text-muted); margin-top: 0.5rem;">{{ $exam->description }} | Duration: {{ $exam->duration }} mins</p>
</div>

<!-- Add Question Form -->
<div id="questionForm" class="glass-card" style="display: none; margin-bottom: 2rem; border-left: 4px solid var(--primary);">
    <h2 style="margin-bottom: 1.5rem;">Add New Question</h2>
    <form action="{{ route('admin.exams.questions.store', $exam->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <label>Question Title</label>
            <input type="text" name="title" class="input-field" required placeholder="e.g. What is a Service Provider in Laravel?">
        </div>

        <div id="optionsContainer" style="margin-bottom: 1.5rem;">
            <label style="color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 1rem;">Options (Mark the correct one)</label>
            <div style="display: grid; gap: 0.8rem;">
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="radio" name="correct_option" value="0" required checked>
                    <input type="text" name="options[]" class="input-field" required placeholder="Option 1">
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="radio" name="correct_option" value="1" required>
                    <input type="text" name="options[]" class="input-field" required placeholder="Option 2">
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="radio" name="correct_option" value="2" required>
                    <input type="text" name="options[]" class="input-field" required placeholder="Option 3">
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="radio" name="correct_option" value="3" required>
                    <input type="text" name="options[]" class="input-field" required placeholder="Option 4">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Save Question</button>
            <button type="button" class="btn" style="border: 1px solid var(--border);" onclick="toggleQuestionForm()">Cancel</button>
        </div>
    </form>
</div>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    @forelse($exam->questions as $index => $question)
        <div class="glass-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                <h3 style="font-weight: 700;">
                    <span style="color: var(--primary); margin-right: 0.5rem;">Q{{ $index + 1 }}.</span>
                    {{ $question->question }}
                </h3>
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('admin.deletequestion',$question->id) }}" style="background: none; border: none; color: var(--text-muted); cursor: pointer;">Edit</a>
                    <a href="{{ route('admin.deletequestion',$question->id) }}" style="background: none; border: none; color: var(--danger); cursor: pointer;">Delete</a>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($question->options as $option)
                    <div style="padding: 0.8rem; border-radius: 8px; border: 1px solid {{ $option->is_correct ? 'var(--success)' : 'var(--glass-border)' }}; background: {{ $option->is_correct ? 'rgba(16, 185, 129, 0.1)' : 'rgba(255, 255, 255, 0.05)' }};">
                        @if($option->is_correct)
                            <span style="color: var(--success); font-size: 0.8rem; font-weight: 700; display: block; margin-bottom: 0.2rem;">CORRECT</span>
                        @endif
                        {{ $option->text_option }}
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="glass-card" style="text-align: center; padding: 4rem;">
            <p style="color: var(--text-muted);">No questions added to this exam yet.</p>
            <button class="btn btn-primary" style="margin-top: 1rem;">Add Your First Question</button>
        </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
    function toggleQuestionForm() {
        const form = document.getElementById('questionForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        if(form.style.display === 'block') {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
@endsection
