@extends('quarx-frontend::layout.master')

@section('content')
<div id="applications">

	<div class="container-fluid">
		<nav class="top-nav blue-grey darken-3">
	        <div class="container">
	          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">Applications</a></div>
	        </div>
	    </nav>
	</div>

	<div class="container">
		<ul class="collapsible popout" data-collapsible="accordion">
		    <li>
		      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Pending Review</div>
		      <div class="collapsible-body">
		      	<ul class="collection" >
					@foreach ($applications as $application)
						@unless ($application->messages->count() || !$application->status)
						   <li
					   		  class="collection-item avatar waves-effect waves-green" style="width:100%;"
					   		  @click="visit('{{ url("/jobs/{$application->job->id}/applications/{$application->id}") }}')"
						   	>
							    <img src="{{ $application->job->company->logo }}" class="circle">
								<span class="title"><b>{{ $application->job->title }}</b></span>
								<p>{{ $application->job->company->name }}</p>



								<span class="new badge" data-badge-caption="Pending Review">Status:</span>
							</li>
						@endif
					@endforeach
				</ul>
		      </div>
		    </li>



		    <li>
		      <div class="collapsible-header active"><i class="material-icons">filter_drama</i>Active</div>
		      <div class="collapsible-body">
		      	<ul class="collection" >
					@foreach ($applications as $application)
						@if ($application->messages->count())
						   <li
					   		  class="collection-item avatar waves-effect waves-green" style="width:100%;"
					   		  @click="visit('{{ url("/jobs/{$application->job->id}/applications/{$application->id}") }}')"
						   	>
							    <img src="{{ $application->job->company->logo }}" class="circle">
							      <span class="title"><b>{{ $application->job->title }}</b></span>
							      <p>{{ $application->job->company->name }}</p>

										{{-- expr --}}
								     	<span class="new badge red">{{ $application->messages->count() }}</span>

							      <a href="#!" class="secondary-content"><i class="blue-text material-icons">grade</i><i class="blue-text material-icons">thumb_up</i></a>
							</li>
						@endif
					@endforeach
				</ul>
		      </div>
		    </li>

		    <li>
		      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Lost</div>
		      <div class="collapsible-body">
		      	<ul class="collection" >
					@foreach ($applications as $application)
						@if ($application->status == 'lost')
						   <li
					   		  class="collection-item avatar waves-effect waves-green" style="width:100%;"
					   		  @click="visit('{{ url("/jobs/{$application->job->id}/applications/{$application->id}") }}')"
						   	>
							    <img src="{{ $application->job->company->logo }}" class="circle">
							      <span class="title"><b>{{ $application->job->title }}</b></span>
							      <p>{{ $application->job->company->name }}</p>

										{{-- expr --}}
								     	<span class="new badge red">{{ $application->messages->count() }}</span>

							      <a href="#!" class="secondary-content"><i class="blue-text material-icons">grade</i><i class="blue-text material-icons">thumb_up</i></a>
							</li>
						@endif
					@endforeach
				</ul>
		      </div>
		    </li>
		</ul>


	</div>
</div>
@endsection

@section('javascript')

	<script type="text/javascript">
		var application = new Vue({
			el: '#applications',
			methods: {
				visit: function(url){
					window.location.href = url;
			  	},
			}
		});
	</script>
@endsection
