@extends('quarx-frontend::layout.master')

@section('content')
<div id="setup">

		<div class="container-fluid">
			<nav class="top-nav blue-grey darken-3">
		        <div class="container">
		          <div class="nav-wrapper">
		          	<a style="font-size: 15pt" class="page-title truncate">
		          		Post an open job position at: {{ $company->name }}
			        </a>
			      </div>
		        </div>
		    </nav>
		</div>

		<div class="container">
			<form method="POST" action="/employer/jobs/{{isset($job) ? $job->id : null}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
				@if (isset($job) ? $job->id : null)
                	<input name="_method" type="hidden" value="PATCH">
				@endif

				<ul class="stepper linear">
				   <li class="step active">
				      <div class="step-title waves-effect">Enter your job details</div>
				      <div class="step-content">
				         <div class="row">
				            <div class="input-field col s12">
				            	<i class="material-icons prefix">work</i>
				               <input id="name" name="title" type="text" class="validate" required value="{{ old('title') }}">
				               <label for="title">Job Title/Position</label>
				            </div>
				         </div>
				         <div class="row">
				            <div class="input-field col s12">
				            	<i class="material-icons prefix">place</i>
				               <input id="location" name="location" type="text" class="validate" required value="{{ isset($company) ? $company->address: '' }}">
				               <label for="location">Location</label>
				            </div>
				         </div>
				         <div class="row">

				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">timer</i>
				               <input id="closing" name="closing" type="text" class="validate datepicker" required>
				               <label for="closing">Closing Date</label>
				            </div>

				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">money</i>
				               <input id="salary" name="salary" type="text" class="validate" value="{{ isset($company) ? $company->salary: '' }}">
				               <label for="salary">Salary</label>
				            </div>
				         </div>

				         <div class="row">
				            <div class="input-field col s12">
				               <b>Enter the Job Description</b>
				               <br>
				               <br>
				               <textarea id="description" name="description" type="text" class="validate" required style="height: 200px; width: 100%;"></textarea>
				            </div>
				         </div>


				         <div class="row">
				            <div class="input-field col s12">
				               <b>Describe the required qualification</b>
				               <br>
				               <br>
				               <textarea id="qualification" name="qualification" class="" class="col s12" style="height: 200px; width: 100%;"></textarea>
				            </div>
				         </div>

				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				         </div>
				      </div>
				   </li>

				   <li class="step">
				      <div class="step-title waves-effect">Short-listing Questions (Requirements Only)</div>
				      <div class="step-content">

						<p>You will only see applications from candidates who answer this questions correctly.</p>
						<p>Please keep the questions simple. (Yes/No Questions only).</p>

						<br>
						<br>

				         <div class="row" v-for="(question, $index) in requirements">
				            <div class="input-field col s7">
				            	<i class="material-icons prefix">help</i>
				               	<input v-bind:id="'question_1['+$index+']'" v-bind:name="'question_1['+$index+']'" class="validate" v-model="question.question" required type="text">
				               	<label v-bind:for="'question_1['+$index+']'">Question</label>
				            </div>
				            <div class="input-field col s4">
							    <select class="validate" v-bind:id="'question_1['+$index+']'" v-bind:name="'answer_1['+$index+']'" required>

							      <option value="true" selected>Yes/True</option>
							      <option value="false">No/False</option>
							    </select>
							    <label v-bind:for="'answer_1['+$index+']'">Answer</label>
							</div>
							<div class="col s1">
								<br>
				         		<i class="red-text waves-effect small material-icons" @click="removeRequirement($index)">delete_sweep</i>
							</div>
				         </div>


				         <div class="row center" >
				         	<button class="btn-floating btn-large waves-effect waves-light red pulse" type="button" @click="newRequirement">
				         		<i class="left material-icons">add</i>
				         	</button>
				         </div>

				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				         </div>
				      </div>
				   </li>
				   <li class="step">
				      <div class="step-title waves-effect">Questionnaire/ (Aptitude test Questions)</div>
				      <div class="step-content">

						<p>Here you can setup your aptitude tests to find the best candidates.</p>

						<br>
						<br>

				         <div class="row" v-for="(question, $index) in questionnaire">
				            <div class="input-field col s7">
				            	<i class="material-icons prefix">help</i>
				               	<input v-bind:id="'question_2['+$index+']'" v-bind:name="'question_2['+$index+']'" class="validate" v-model="question.question" required type="text">
				               	<label v-bind:for="'question_2['+$index+']'">Question</label>
				            </div>
				            <div class="input-field col s4">
							    <select class="validate" v-if="question.type == 'boolean'" v-bind:id="'question_2['+$index+']'" v-bind:name="'answer_2['+$index+']'" required>

							      <option value="true" selected>Yes/True</option>
							      <option value="false">No/False</option>
							    </select>
							    <select class="validate" v-if="question.type == 'norminal'" v-bind:id="'question_2['+$index+']'" v-bind:name="'answer_2['+$index+']'" required>

							      <option value="1" selected>1</option>
							      <option value="2">2</option>
							      <option value="3">3</option>
							      <option value="4">4</option>
							      <option value="5">5</option>
							    </select>
             					<input class="validate" v-if="question.type == 'string'" v-bind:id="'question_2['+$index+']'" v-bind:name="'answer_2['+$index+']'" type="text" required>

							    <label v-bind:for="'answer_2['+$index+']'">Answer</label>

							    <input v-if="question.type == 'norminal'" type="hidden" v-bind:name="'type['+$index+']'" value="range">
							    <input v-if="question.type == 'string'" type="hidden" v-bind:name="'type['+$index+']'" value="string">
							</div>
							<div class="col s1">
								<br>
				         		<i class="red-text waves-effect small material-icons" @click="removeQuestionnaire($index)">delete_sweep</i>
							</div>
				         </div>


				         <div class="row center" >
			         		<a class='dropdown-button btn waves-effect waves-light red pulse'
			         			data-activates='questionnaire_dropdown'
			         		>
			         			<i class="left material-icons">add</i>Add a new Question
			         		</a>

						  	<!-- Dropdown Structure -->
							<ul id='questionnaire_dropdown' class='dropdown-content'>
								<li>
									<a href="#!" @click="newQuestionnaire('boolean')">
										<i class="material-icons">call_split</i>
										True/False or Yes/No
									</a>
								</li>
								<li>
									<a href="#!" @click="newQuestionnaire('norminal')">
										<i class="material-icons">linear_scale</i>
										Norminal Scale
									</a>
								</li>
								<li>
									<a href="#!" @click="newQuestionnaire('string')">
										<i class="material-icons">edit</i>
										Input Text
									</a>
								</li>
							</ul>
				         </div>

				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
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
			el: '#setup',
			data : {
				tab: 1,
				requirements: [{
					question: 'Do you have 5 years working experience?',
					answer: null
				}],
				questionnaire: []
			},
			mounted: function(){
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
				    selectYears: 100, // Creates a dropdown of 15 years to control year,
				    closeOnSelect: false, // Close upon selecting a date,
				    format: 'yyyy-mm-dd'
				});
				$('select').material_select();
				$('.stepper').activateStepper();
			},
			methods: {
				newRequirement: function(){
					this.requirements.push({question: null, answer: null});
					setTimeout(function(){$('select').material_select()}, 1);
				},
				removeRequirement: function($index){
					this.requirements.splice($index, 1);
				},

				newQuestionnaire: function(type){
					this.questionnaire.push({question: null, answer: null, type: type});
					setTimeout(function(){$('select').material_select()}, 1);
				},
				removeQuestionnaire: function($index){
					this.questionnaire.splice($index, 1);
				}
			}
		});

	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/materialize-stepper@2.1.4/materialize-stepper.min.css">
@endsection
