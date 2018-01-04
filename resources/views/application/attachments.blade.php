<br>
<br>
<div class="container z-depth-5 white center" style="padding: 3em 0px;">
	<div>
	    <span style="font-size:2em;">
	    	<u class="text-center">Attachments</u>
	    </span>
	</div>

	<div class="container">
		@foreach ($application->attachments as $attachment)
			<br>
				<a href="{{ env('APP_URL') }}/{{ $attachment->url }}" target="_blank" class="btn blue waves-effect">
					<i class="material-icons">file_download</i> {{ $attachment->name }} - Download
				</a>
			<br>
		@endforeach
	</div>
</div>
