@extends('quarx-frontend::layout.master')

@section('content')
<div id="setup">

		<div class="container-fluid">
			<nav class="top-nav blue-grey darken-3">
		        <div class="container">
		          <div class="nav-wrapper">
		          	<a style="font-size: 15pt" class="page-title">
		          		Setup Employer Account
			        </a>
			      </div>
		        </div>
		    </nav>
		</div>

		<div class="container">
			<form method="POST" action="/employer/setup/{{isset($company) ? $company->id : null}}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
				@if (isset($company) ? $company->id : null)
                	<input name="_method" type="hidden" value="PATCH">
				@endif

				<ul class="stepper horizontal">
				   <li class="step active">
				      <div class="step-title waves-effect">Company Information</div>
				      <div class="step-content">
				         <div class="row">
				            <div class="input-field col s12">
				               <input id="name" name="name" type="text" class="validate" required value="{{ isset($company) ? $company->name: '' }}">
				               <label for="name">Company Name</label>
				            </div>
				         </div>
				         <div class="row">
				            <div class="input-field col s12">
				               <input id="address" name="address" type="text" class="validate" required value="{{ isset($company) ? $company->address: '' }}">
				               <label for="address">Company address</label>
				            </div>
				         </div>
				         <div class="row">
				            <div class="input-field col s12 m6">
				               <input id="industry" name="industry" type="text" class="validate" required value="{{ isset($company) ? $company->industry: '' }}">
				               <label for="industry">Industry</label>
				            </div>

				            <div class="input-field col s12 m6">
				               <input id="employees" name="employees" type="text" class="validate" required value="{{ isset($company) ? $company->employees: '' }}">
				               <label for="employees">Employees</label>
				            </div>
				         </div>
				         <div class="step-actions">
				            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
				         </div>
				      </div>
				   </li>

				   <li class="step">
				      <div class="step-title waves-effect">More Details (This information are not required)</div>
				      <div class="step-content">

				         <div class="row">
				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">phone</i>
				               <input id="phone" name="phone" type="tel" class="validate" value="{{ isset($company) ? $company->phone: '' }}">
				               <label for="phone">Company Phone</label>
				            </div>

				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">timer</i>
				               <input id="founded" name="founded" type="text" class="validate datepicker" value="{{ isset($company) ? $company->date: '' }}">
				               <label for="founded">Founded Date</label>
				            </div>
				         </div>

				         <div class="row">
				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">public</i>
				               <input id="website" name="website" type="url" class="validate" value="{{ isset($company) ? $company->website: '' }}">
				               <label for="website">Company Website</label>
				            </div>

				            <div class="file-field col s12 m6">
						      <div class="btn btn">
						        <span>Select Logo</span>
						        <input id="logo" name="logo" type="file" class="validate">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				         </div>


				         <div class="row">
					          <div class="input-field col s12">
					            <textarea id="mission" class="materialize-textarea" name="mission" data-length="120"></textarea>
					            <label for="mission">Mission</label>
					          </div>
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
			},
			mounted: function(){
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
				    selectYears: 100, // Creates a dropdown of 15 years to control year,
				    closeOnSelect: false, // Close upon selecting a date,
				    format: 'yyyy-mm-dd'
				});
			},
			methods: {
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			}
		});

		$('.stepper').activateStepper({
			parallel: false
		});
	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/materialize-stepper@2.1.4/materialize-stepper.min.css">
@endsection
