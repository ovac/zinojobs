<div class="col s12">
	<div class="card horizontal">
	  <div class="card-stacked">
	    <div class="card-content">
		<h3 class="header truncate">{{ $job->title }}</h3>
	       	<b class="truncate">
				{{ $job->company->name }}
			</b>
	    </div>
	    <div class="card-action">
			<a class="btn blue col s12" target="_blank" href="/jobs/{{ $job->id }}/application/create">Apply Now</a>

	    </div>
	  </div>

	  <div class="card-image">
	    <img src="{{ $job->company->logo }}">
	  </div>
	</div>

	<div class="card">
		<div class="card-tabs">
			<ul class="tabs tab-demo z-depth-1">
				<li class="tab"><a v-bind:class="{active: tab == 1}" @click="setTab(1)">Job</a></li>
				<li class="tab"><a v-bind:class="{active: tab == 2}" @click="setTab(2)">Company</a></li>
				<li class="tab"><a v-bind:class="{active: tab == 3}" @click="setTab(3)">Qualification</a></li>
				<li class="tab"><a v-bind:class="{active: tab == 4}" @click="setTab(4)">Requirements</a></li>

			</ul>
		</div>
		<div class="card-content grey lighten-4">
			<div class="flow-text" v-show="tab == 1">
				{{ $job->description }}
			</div>
			<div class="flow-text" v-show="tab == 2">
				{{ $job->company->details }}
			</div>
		</div>
	</div>
</div>
