<div class="collection-item">
    Question #id {{ $question->id }}. <span>{{ $question->question }}</span>

  	@if ($question->type == 'range')
      <br>
      <p class="range-field">
      	<span>Put your answer on a scale of 1 (Strongly Disagree or Less Likely) - 5 (Strongly Agree or Very Likely)</span>
        	<input type="range" name="question_{{ $question->id }}" min="1" max="5" required/>
      </p>
      <br>
    @elseif($question->type == 'boolean')
      <p>
        <input class="with-gap" name="question_{{ $question->id }}" type="radio" value="false" id="no_{{ $question->id }}" required/>
        <label for="no_{{ $question->id }}">No</label>
      </p>
      <p>
        <input class="with-gap" name="question_{{ $question->id }}" type="radio" value="true" id="yes_{{ $question->id }}" required/>
        <label for="yes_{{ $question->id }}">Yes</label>
      </p>
    @elseif($question->type == 'string')
      <br>
      <div class="input-field">
          <input type="text" name="question_{{ $question->id }}" id="question_{{ $question->id }}" required/>
          <label for="question_{{ $question->id }}">Type your answer</label>
      </div>
      <br>
  	@endif
</div>
