
		@if ($application->social && auth()->user()->social()->count())
			{{-- expr --}}
			<br><br>
			<div class="container z-depth-3 white center"  style="padding: 2em 0px; " id="status">
				<div class="container">
					@if ($application->user->social->linkedin)
						<a href="{{ $application->user->social->linkedin }}" class="waves-effect waves-light btn-floating social linkedin"><i class="fa fa-linkedin"></i></a>
					@endif
					@if ($application->user->social->facebook)
						<a href="{{ $application->user->social->facebook }}" class="waves-effect waves-light btn-floating social facebook"><i class="fa fa-facebook"></i></a>
					@endif
					@if ($application->user->social->instagram)
						<a href="{{ $application->user->social->instagram }}" class="waves-effect waves-light btn-floating social instagram"><i class="fa fa-instagram"></i></a>
					@endif
					@if ($application->user->social->twitter)
						<a href="{{ $application->user->social->twitter }}" class="waves-effect waves-light btn-floating social twitter"><i class="fa fa-twitter"></i></a>
					@endif
					@if ($application->user->social->github)
						<a href="{{ $application->user->social->github }}" class="waves-effect waves-light btn-floating social github"><i class="fa fa-github"></i></a>
					@endif
			    </div>
			    <br>
			    <div>
			    @if ($application->user->social->website )

			    	Website: <a href="{{ $application->user->social->website }}">{{ $application->user->social->website }}</a><br>
			    @endif
			    	Email: {{ $application->user->email }},
			    	Phone: {{ $application->user->phone }},
			    </div>
			</div>
		@endif
