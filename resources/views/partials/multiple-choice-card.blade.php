<div class="multiple-choice-card">
    <div class="question">{{ $question->question }}</div>
    <div class="answers">
        @foreach($question->answers as $answer)
            <div class="answer">
                <input type="radio" id="{{ $answer->answer }}">
                <label>{{ $answer->answer }}</label>
            </div>
        @endforeach
    </div>
</div>