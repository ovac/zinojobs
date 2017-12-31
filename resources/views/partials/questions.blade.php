<div class="collection-item">
    Question #id {{ $question->id }}. <span>{{ $question->question }}</span>

  	@if ($question->type == 'range')
      <br>
      <p class="range-field">
      	<span>Put your answer on a scale of 1 (Strongly Disagree or Less Likely) - 5 (Strongly Agree or Very Likely)</span>
        	<input type="range" name="question_{{ $question->id }}" min="1" max="5" />
      </p>
      <br>
  	@else
      <p>
        <input class="with-gap" name="question_{{ $question->id }}" type="radio" value="false" id="no_{{ $question->id }}" required/>
        <label for="no_{{ $question->id }}">No</label>
      </p>
      <p>
        <input class="with-gap" name="question_{{ $question->id }}" type="radio" value="true" id="yes_{{ $question->id }}" required/>
        <label for="yes_{{ $question->id }}">Yes</label>
      </p>
  	@endif
</div>
