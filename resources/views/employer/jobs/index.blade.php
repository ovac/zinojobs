@extends('quarx-frontend::layout.master')

@section('content')
<div id="listing">


	<div class="container-fluid">
		<nav class="top-nav blue-grey darken-3">
	        <div class="container">
	          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">Posted Jobs Listing</a></div>
	        </div>
	    </nav>
	</div>

	<div class="fixed-action-btn">
	    <a class="btn-floating btn-large red" id="menu">
	      <i class="large material-icons">mode_edit</i>
	    </a>
	    <ul>
	      <li><a class="btn-floating blue" href="{{ url('/employer/jobs/create') }}"><i class="material-icons">add</i></a></li>
	      <li><a class="btn-floating yellow" @click="show"><i class="material-icons">visibility</i></a></li>
	      <li><a class="btn-floating green" @click="edit"><i class="material-icons">edit</i></a></li>
	      <li><a class="btn-floating red" @click="runDelete"><i class="material-icons">delete_sweep</i></a></li>
	    </ul>
	</div>

	<div class="tap-target" data-activates="menu">
	    <div class="tap-target-content">
	      <h5 v-if="selected" >@{{ job.title }}</h5>
	    </div>
	 </div>

	<div class="container">
		<div class="row ">
	  			{{ $jobs->links() }}
			<div class="col s7 ">
				<ul class="collection z-depth-1" >

				    @foreach($jobs as $job)
					    <li class="collection-item avatar waves-effect col s12" v-bind:class="{ 'blue lighten-4': selected === {{ $job->id }} }" @click="select({{ $job->id }})">
					    	<br>
					      <span class="new badge blue" data-badge-caption="Applications" v-if="{{ $job->applications->count() }}">{{ $job->applications->count() }}</span>
					      <img src="{{ $job->company->logo }}" alt="" class="circle">
					      <span class="title"><b>{{ $job->title }}</b></span>
					      <p>{{ $job->company->name }}</p>

					    </li>

				        {{-- <a href="{!! url('jobs/'.$job->id) !!}"></a><br> --}}
				    @endforeach
	  			</ul>
			</div>
			<div class="col s5">
				<div class="progress" v-if="loading">
				    <div class="indeterminate"></div>
				</div>

				<div class="col s12" v-if="!loading" >

					<div class="col s12">
					    <div class="card horizontal">
					      <div class="card-stacked">
					        <div class="card-content">

								{{-- <a href="#!" class="secondary-content"><i class="red-text material-icons">delete_sweep</i></a> --}}
								{{-- <a v-bind:href="'/employer/jobs/'+selected+'/applications/'" class="secondary-content"><i class=" material-icons">edit</i></a> --}}
								<a class="secondary-content" v-bind:href="'/employer/jobs/'+selected+'/applications/'">
									<i class="blue-text material-icons">visibility</i>
								</a>

					        <p>Job Title:</p>
					    	<h4 class="header">@{{ job.title }}</h4>
					        </div>
					        <div class="card-action" v-if="job.application_count">
								<a class="btn blue col s12 waves-effect" target="_blank" v-bind:href="'/employer/jobs/'+selected+'/applications/'">Applications</a>
					        </div>
					      </div>
					    </div>

					  <div class="card">
						{{-- <div class="card-tabs">
							<ul class="tabs tab-demo z-depth-1">
								<li class="tab"><a v-bind:class="{active: tab == 1}" class="waves-effect" @click="setTab(1)">Job</a></li>
								<li class="tab"><a v-bind:class="{active: tab == 3}" class="waves-effect"  @click="setTab(2)">Qualification</a></li>
								<li class="tab"><a v-bind:class="{active: tab == 4}" class="waves-effect"  @click="setTab(3)">Requirements</a></li>
								<li class="tab"><a v-bind:class="{active: tab == 4}" class="waves-effect"  @click="setTab(3)">Questions</a></li>

							</ul>
						</div> --}}

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

					    {{-- <div class="card-content grey lighten-4">
							<div class="flow-text" v-show="tab == 1">
								@{{ job.description }}
							</div>
							<div class="flow-text" v-show="tab == 2">

							</div>
					    </div> --}}
				  </div>
					  </div>
	  			</div>



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
			  this.select({{ $jobs->count() ? $jobs[0]->id : 0 }});
			},
			data : {
				selected: null,
				job: null,
				loading: true,
				tab: 1,
			},
			methods: {
				select: function(jobId){
					this.selected = jobId;
					this.fetchJob(jobId);
			  	},
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			  	show: function(){
			  		window.location.href = '/employer/jobs/'+this.job.id;
			  	},
			  	edit: function(){
			  		window.location.href = '/employer/jobs/'+this.job.id+'/edit';
			  	},
			  	runDelete: function(){
			  		var confirmation = confirm('Are you sure you want to delete this job?\nJob Title: '+this.job.title);

			  		if(confirmation){
				  		$.delete('/employer/jobs/'+ this.job.id)
						    .then(function(job){
						    	alert('Job Deleted successfully');
								window.location.reload();
						    })
						    .catch(function(e){
						    	console.log(e);
						    });
			  		}
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
    						$('.tap-target').tapTarget('open');
					    })
			    },
			}
		});
	</script>
@endsection
