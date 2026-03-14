@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 800;">{{ $exam->title }}</h1>
            <p style="color: var(--text-muted);">{{ $exam->questions->count() }} Questions | {{ $exam->duration }} Minutes</p>
        </div>
        <div id="timer" class="glass-card" style="padding: 0.8rem 1.5rem; font-size: 1.5rem; font-weight: 700; color: var(--secondary);">
            {{ $exam->duration }}:00
        </div>
    </div>

    <form action="{{ route('student.exams.submit', $exam->id) }}" method="POST" id="examForm">
        @csrf
        @foreach($exam->questions as $index => $question)
            <div class="glass-card" style="margin-bottom: 2rem; animation: fadeIn {{ 0.3 + ($index * 0.1) }}s ease-out forwards;">
                <h3 style="margin-bottom: 1.5rem; font-weight: 700;">
                    <span style="color: var(--primary); margin-right: 0.5rem;">Q{{ $index + 1 }}.</span>
                    {{ $question->question }}
                </h3>
                
                <div style="display: grid; gap: 1rem;">
                    @foreach($question->options as $option)
                        <label class="glass-card" style="padding: 1rem; cursor: pointer; display: flex; align-items: center; gap: 1rem; transition: background 0.3s;" onmouseover="this.style.background='rgba(99, 102, 241, 0.1)'" onmouseout="this.style.background='var(--card-bg)'">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required style="width: 20px; height: 20px; accent-color: var(--primary);">
                            <span style="font-weight: 500;">{{ $option->text_option }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div style="display: flex; justify-content: center; margin-top: 3rem; margin-bottom: 5rem;">
            <button type="submit" class="btn btn-primary" style="padding: 1.5rem 4rem; font-size: 1.2rem; border-radius: 50px; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);">
                Submit Final Exam
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    let timeLeft = {{ $exam->duration * 60 }};
    const timerDisplay = document.getElementById('timer');
    const form = document.getElementById('examForm');

    const timer = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            form.submit();
        }
        timeLeft--;
    }, 1000);
</script>
@endsection
@endsection
