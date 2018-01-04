@extends('quarx-frontend::layout.master')

@section('content')
<div id="application">

	<div class="container-fluid">
		<nav class="top-nav blue-grey darken-3">
	        <div class="container">
	          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">Applying For: {{ $job->title }}</a></div>
	        </div>
	    </nav>
		<nav class="top-nav  blue-grey darken-4">
	        <div class="container">
	          <div class="nav-wrapper "><a style="font-size: 15pt" class="page-title">At: {{ $job->company->name }}</a></div>
	        </div>
	    </nav>
	</div>

		<div class="container">
			<form method="POST" action="/jobs/{{ $job->id }}/applications"  enctype="multipart/form-data">
                {!! csrf_field() !!}

				<ul class="stepper linear">
				   <li class="step active">

				      <div class="step-title waves-effect">Upload Resume/CV</div>
				      <div class="step-content">
				         <div class="row">
				            <div class="file-field input-field">
						      <div class="btn">
						        <span>Upload custom resume</span>
						        <input id="resume" name="resume" type="file" class="validate">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>

						      <span>Leave empty to use your default resume</span>
						    </div>
				         </div>
				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				         </div>
				      </div>
				   </li>
				   <li class="step">
				      <div class="step-title waves-effect">Attachments</div>
				      <div class="step-content">

				      	<span>You can attach files to the candidate record (e.g.: cover letter, resume, references, transcripts, etc.). Once a file is attached, you can overwrite it by attaching a file with exactly the same name and extension.</span>
				         <div class="row">
				            <div class="file-field input-field">
						      <div class="btn">
						        <span>Select File</span>
						        <input id="attachment" name="attachments[]" type="file" class="validate" multiple>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				         </div>
				         <div class="row">
					          <div class="input-field col s12">
					            <textarea id="about" class="materialize-textarea" name="about" data-length="120"></textarea>
					            <label for="about">Information about the attachment(s)</label>
					          </div>
					      </div>

				         	<div class="row">
					          <div class="col s12">
					            <input type="checkbox" name="social" id="social" class="checkbox" checked>
					            <label for="social">Attach my social accounts and contact information</label>
					          </div>
					      	</div>

							<br>
							<br>
							<br>
				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
				         </div>
				      </div>
				   </li>


				   <li class="step">
				      <div class="step-title waves-effect">Screening Questions</div>
				      <div class="step-content">
				      	<h4 class="title">Questionnaire</h4>
				      	<div class="row">
				      		<span>To help us better know you and further assess your qualifications for this position, please answer the following questions as accurately as possible.</span>
				      	</div>



				         <div class="row collection">
				         	@foreach ($job->questions as $question)
				         		@if ($question->requirement)
									@include('partials.questions', compact('questions'))
				         		@endif
				         	@endforeach
				         </div>

				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
				         </div>
				      </div>
				   </li>

				   <li class="step">
				      <div class="step-title waves-effect">Questionnaire</div>
				      <div class="step-content">
				      	<h4 class="title">Questionnaire</h4>
				      	<div class="row">
				      		<span>Please answer the following questions as accurately as possible.</span>
				      	</div>

				         <div class="row collection">
				         	@foreach ($job->questions as $question)
				         		@unless($question->requirement)
									@include('partials.questions', compact('questions'))
				         		@endif
				         	@endforeach
				         </div>

				         <div class="row">

				         </div>

				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
				         </div>
				      </div>
				   </li>

				   <li class="step">
				      <div class="step-title waves-effect">Finish!</div>
				      <div class="step-content">
				        	<p><b>Declaration</b></p>

							<p>By submitting, I confirm that the information given in this application is true, accurate  and complete and I agree to the use of my information as detailed in the privacy statement.</p>



							<p>Please note that your e-signature will be accepted as the electronic equivalent to a hand-written signature and/or as an electronic signature as may be permitted under/by any applicable law.</p>
				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn" type="submit">SUBMIT</button>
				         </div>
				      </div>
				   </li>
				</ul>
			</form>
		</div>
</div>

@endsection

@section('javascript')<!-- jQueryValidation Plugin -->
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/materialize-stepper@2.1.4/materialize-stepper.min.js"></script>

	<script type="text/javascript">
		var application = new Vue({
			el: '#application',
			data : {
				tab: 1,
			},
			methods: {
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			}
		});

		$('.stepper').activateStepper();
	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/materialize-stepper@2.1.4/materialize-stepper.min.css">
@endsection
