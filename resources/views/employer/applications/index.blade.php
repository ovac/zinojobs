@extends('quarx-frontend::layout.master')

@section('content')
<div id="listing">


	<div class="container-fluid">
		<nav class="top-nav blue-grey darken-3">
	        <div class="container">
	          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">{{ $applications->count() }} Job Application(s) listing</a></div>
	        </div>
	    </nav>

		<nav class="top-nav blue-grey darken-4">
	        <div class="container">
	          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">Job Title: {{ $job->title }}</a></div>
	        </div>
	    </nav>
	</div>

	<div class="container">
		<div class="row ">

	  		<div class="col s12 m6">
				<div class="progress" v-if="loading">
				    <div class="indeterminate"></div>
				</div>

				<div class="col s12" v-if="!loading" >

					<div class="col s12">



					<div class="card horizontal z-depth-3">
				      <div class="card-stacked">
				        <div class="card-content">

							<a  @click="runDelete" class="secondary-content"><i class="red-text material-icons">delete_sweep</i></a>
							<a @click="edit" class="secondary-content"><i class=" material-icons">edit</i></a>


				        <p>Job Title:</p>
				    	<h4 class="header">@{{ job.title }}</h4>
				        </div>
				      </div>
				    </div>

					  <div class="card  z-depth-3">
						<ul class="collapsible" data-collapsible="accordion">
						    <li>
						      <div class="collapsible-header"><i class="material-icons">work</i>Job Description</div>
						      <div class="collapsible-body"><span>@{{ job.description }}</span></div>
						    </li>
						    {{-- <li>
						      <div class="collapsible-header"><i class="material-icons">school</i>Qualifications</div>
						      <div class="collapsible-body"><span>@{{ job.qualifications }}</span></div>
						    </li> --}}
						    <li>
						      <div class="collapsible-header"><i class="material-icons">spellcheck</i>Screening Questions</div>
						      <div class="collapsible-body">
						      	<div class="collection">
						      		<div class="collection-item" v-for="question in job.questions" v-if="question.requirement">
							      		<p>@{{ question.question }}</p>
							      		<p class="green-text">@{{ question.answer }}</p>
						      		</div>
						      	</div>
						      </div>
						    </li>
						    <li>
						      <div class="collapsible-header"><i class="material-icons">help</i>Questionnaire</div>
						      <div class="collapsible-body">
						      	<div class="collection">
						      		<div class="collection-item" v-for="question in job.questions" v-if="!question.requirement">
							      		<p>@{{ question.question }}</p>
							      		<p class="green-text">@{{ question.answer }}</p>
						      		</div>
						      	</div>
						      </div>
						    </li>
						  </ul>
				  		</div>
					</div>
	  			</div>
			</div>
			<div class="col s12 m6">
				<ul class="collection z-depth-3" >

				    @foreach($applications as $application)
					    <li class="collection-item avatar waves-effect col s12" v-bind:class="{ 'blue lighten-4': selected === {{ $application->id }} }" @click="openApplication({{ $application->id }})">
					    	<br>
					      <span class="new badge" data-badge-caption="new Message(s)" v-if="{{ $application->messages->count() }}">{{ $application->messages->count() }}</span>

					      <span class="new badge blue" data-badge-caption="Application" v-if="{{ $application->messages->count() ? 0 : 1 }}">new</span>

					      <img src="{{ $job->company->logo }}" alt="" class="circle">
					      <span class="title">
					      	<b v-bind:class="{ 'blue-text lighten-3': {{ $application->messages->count() ? 0 : 1 }} }"v-if="">{{ $application->user->name }}</b>
					      </span>
					      {{-- <p>{{ $job->company->name }}</p> --}}

					    </li>

				        {{-- <a href="{!! url('jobs/'.$job->id) !!}"></a><br> --}}
				    @endforeach
	  			</ul>

	  			@unless ($applications->count())
					<div class="z-depth-3">
						<div class="container" style="padding: 80px 0;">
							<h2 ><blockquote>There are no applications yet. Please check back in a while.</blockquote></h2>
						</div>
					</div>
	  			@endunless
			</div>
		</div>

	</div>
</div>

@endsection

@section('javascript')
	<script type="text/javascript">
		var listing = new Vue({
			el: '#listing',
			mounted: function () {
			  this.select({{ $job->id }});
			  $('.dropdown-button').dropdown({
			      hover: true, // Activate on hover
			      alignment: 'left', // Displays dropdown with edge aligned to the left of button
			      stopPropagation: true // Stops event propagation
			    }
			  );
			},
			data : {
				job: null,
				loading: true,
				tab: 1,
			},
			methods: {
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			  	runDelete: function(){

			  	},
			  	edit: function(){

			  	},
			  	select: function(jobId){
			  		this.selected = jobId;
			  		this.fetchJob(jobId);
			  	},
				fetchJob: function(jobId){
					var vm = this;
					vm.loading = true;

					$.get('/employer/jobs/'+ jobId)
					    .then(function(job){
							vm.job = job;
							vm.loading = false;
					    })
					    .catch(function(e){
					    	console.log(e);
					    })
					    .then(function(){
    						$('.collapsible').collapsible();

					    })
			    },
			    openApplication: function(applicationId){
			    	var vm = this;
			    	window.location.href = '/employer/jobs/'+ vm.job.id +'/applications/' + applicationId;
			    }
			}
		});
	</script>
@endsection
