@extends('quarx-frontend::layout.master')

@section('content')
<div id="job">

    @include('jobs.search')

		<div class="container">
			<div class="progress" v-if="loading">
			    <div class="indeterminate"></div>
			</div>

			@include('jobs.partial', compact('job'))
		</div>
	</div>

@endsection

@section('javascript')
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script> --}}
	<script type="text/javascript">
		var listing = new Vue({
			el: '#job',
			data : {
				tab: 1,
			},
			methods: {
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			}
		});
	</script>
@endsection
