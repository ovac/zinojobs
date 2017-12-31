@extends('quarx-frontend::layout.master')

@section('content')
<div id="listing">

    @include('jobs.search')

	<div class="row">
  			{{ $jobs->links() }}
		<div class="col s5 ">
			<ul class="collection z-depth-1" >

			    @foreach($jobs as $job)
				    <li class="collection-item avatar waves-effect col s12" v-bind:class="{ 'blue lighten-4': selected === {{ $job->id }} }" @click="select({{ $job->id }})">
				    	<br>
				      <img src="{{ $job->company->logo }}" alt="" class="circle">
				      <span class="title"><b>{{ $job->title }}</b></span>
				      <p>{{ $job->company->name }}</p>
				      <a href="#!" class="secondary-content"><i class="blue-text material-icons">grade</i><i class="blue-text material-icons">thumb_up</i></a>
				    </li>

			        {{-- <a href="{!! url('jobs/'.$job->id) !!}"></a><br> --}}
			    @endforeach
  			</ul>
		</div>
		<div class="col s7">
			<div class="progress" v-if="loading">
			    <div class="indeterminate"></div>
			</div>

			<div class="col s12" v-if="!loading" >

				<div class="col s12">
				    <div class="card horizontal">
				      <div class="card-stacked">
				        <div class="card-content">
				    	<h3 class="header">@{{ job.title }}</h3>
				           	<b>
								@{{ job.company.name }}
							</b>
				        </div>
				        <div class="card-action">
							<a class="btn blue col s12 waves-effect" v-if="!job.applied" target="_blank" v-bind:href="'/jobs/'+selected+'/applications/create'">Apply Now</a>

							<a class="btn blue col s12 waves-effect" v-if="job.applied" target="_blank" v-bind:href="'/jobs/'+selected+'/applications/create'">See Application Status</a>

				        </div>
				      </div>

				      <div class="card-image">
				        <img v-bind:src="job.company.logo">
				      </div>
				    </div>

				  <div class="card">
					<div class="card-tabs">
						<ul class="tabs tab-demo z-depth-1">
							<li class="tab"><a v-bind:class="{active: tab == 1}" class="waves-effect" @click="setTab(1)">Job</a></li>
							<li class="tab"><a v-bind:class="{active: tab == 2}" class="waves-effect"  @click="setTab(2)">Company</a></li>
							<li class="tab"><a v-bind:class="{active: tab == 3}" class="waves-effect"  @click="setTab(3)">Qualification</a></li>
							<li class="tab"><a v-bind:class="{active: tab == 4}" class="waves-effect"  @click="setTab(4)">Requirements</a></li>

						</ul>
					</div>
				    <div class="card-content grey lighten-4">
						<div class="flow-text" v-show="tab == 1">
							@{{ job.description }}
						</div>
						<div class="flow-text" v-show="tab == 2">
							@{{ job.company.details }}
						</div>
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
			  this.select({{ $jobs[0]->id }});
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
				fetchJob: function(jobId){
					var vm = this;
					vm.loading = true;

					$.get('/jobs/'+ jobId)
					    .then(function(job){
							vm.job = job;
							vm.loading = false;
					    })
					    .catch(function(e){
					    	console.log(e);
					    })
					    .then(function(){
							$('.tabs').tabs();


					    })
			    },
			}
		});
	</script>
@endsection
