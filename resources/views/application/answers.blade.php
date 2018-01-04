<br>
<br>
<div class="container">
	<ul class="collapsible popout" data-collapsible="accordion">
	    <li>
	      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Screening & Shortlisting Questions</div>
	      <div class="collapsible-body">
	      	<div class="white center">
				<div>
				    <span style="font-size:2em;">
				    	<u class="text-center">Screening Questions</u>
				    </span>
				</div>

				<div class="container">
					<div class="collection">
						@forelse ($application->job->questions ?: [] as $question)
			         		@if($question->requirement)
								<div class="collection-item">
									<span>Queston #UID. {{ $question->id }}</span>
									<br>
									<span>{{ $question->question }}</span>
									<br>
									<span>
										@php
											$answer = $application->answers->firstWhere('question_id', $question->id)
											?: json_decode(json_encode(['answer' => 'No answer']));
										@endphp
										Answer:  {{
											$answer->answer == 'true' ? 'Yes' :
											$answer->answer == 'false' ? 'No' :
											$answer->answer
										}}
									</span>
								</div>
			         		@endif
			         	@empty
							<div class="collection-item">No questions</div>
			         	@endforelse
					</div>
				</div>
			</div>
	      </div>
	    </li>

	    <li>
	      <div class="collapsible-header"><i class="material-icons">place</i>Questionnaire</div>
	      <div class="collapsible-body">
	      	<div class="white center">
				<div>
				    <span style="font-size:2em;">
				    	<u class="text-center">Questionnaire</u>
				    </span>
				</div>

				<div class="container">
					<div class="collection">
						@forelse ($application->job->questions ?: [] as $question)
			         		@unless($question->requirement)
								<div class="collection-item">
									<span>Queston #UID. {{ $question->id }}</span>
									<br>
									<span>{{ $question->question }}</span>
									<br>
									<span>
										@php
											$answer = $application->answers->firstWhere('question_id', $question->id)
											?: json_decode(json_encode(['answer' => 'No answer']));
										@endphp
										Answer:  {{
											$answer->answer == 'true' ? 'Yes' :
											$answer->answer == 'false' ? 'No' :
											$answer->answer
										}}
									</span>
								</div>
			         		@endif
			         	@empty
							<div class="collection-item">No questions</div>
			         	@endforelse
					</div>
				</div>
			</div>
	      </div>
	    </li>
	</ul>
</div>
