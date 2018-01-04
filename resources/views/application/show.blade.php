@extends('quarx-frontend::layout.master')

@section('content')

<div class="container-fluid" id="application">
	<nav class="top-nav blue-grey darken-3">
        <div class="container">
          <div class="nav-wrapper"><a style="font-size: 15pt" class="page-title">Applying For: {{ $job->title }}</a></div>
        </div>
    </nav>
	<nav class="top-nav  blue-grey darken-4">
        <div class="container">
          <div class="nav-wrapper "><a style="font-size: 15pt" class="page-title">At: {{ $job->company->name }}</a></div>
        </div>
    </nav>
</div>

<div id="loader" class="container">
	<br>
	<br>
	<br>
	<br>
	<div class="progress" v-if="loading">
	    <div class="indeterminate"></div>
	</div>
</div>

<div style="display: none;" id="main">

		<div class="container z-depth-5 white"  style="padding: 2em 0px; " id="status">
			<div class="container">
				<blockquote style="font-size: 3em;">
					<p>You applied for this job. </p>

					@if ($application->qualified)
						<p v-if="!contacted && status != 'lost'">After a manual review, someone from {{ $job->company->name }} will get back to you.</p>

						<p v-if="status == 'lost'">The job has been awarded to another applicant.</p>

						<div v-if="status == 'invited'">
							<p class="green-text">Congratulations.</p>
							<p>You have been invited for a face to face interview.</p>
						</div>

						<p v-if="status == 'awarded'">Congratulations. You got the Job.</p>
					@else
						<p>Based on your entry, you did not qualify for this job.</p>
					@endif
					{{-- <div>This job is no longer available.</div> --}}
			    </blockquote>


				<div v-if="status == 'invited'">
					<p>Date: 24th June, 2017</p>
					<p>Time: 12:30pm</p>
					<p>Address: 15, someething somewhere somehow</p>

					<iframe width="100%" height="400" frameborder="0" style="border:0"
						src="https://www.google.com/maps/embed/v1/place?
						q=place_id:EiAyMiBXaGl0bWFuIFJkLCBMb25kb24gRTMgNFJCLCBVSw
						&key={{ env('GOOGLE_MAP_KEY') }}"
						allowfullscreen>
					</iframe>
				</div>
		    </div>
		</div>

		<br>
		<br>

		<div class="clearfix container z-depth-5 white" id="chat" v-if="contacted">


		    <div class="chat">
		      <div class="chat-header clearfix">
		        <img src="{{ $application->job->user->avatar }}" alt="avatar" height="100px"/>

		        <div class="chat-about">
		          <div class="chat-with">Chat with @{{ messages[0].user.name }}</div>
		          <div class="chat-num-messages">Messages: @{{ messages.length }}</div>
		        </div>
		        <button class="right waves-effect btn waves-light" v-if="!existingCall" @click="runSetup">
		        	<i class="fa fa-video"></i> Prepared for Video Interview
		        </button>

		        <a class="right waves-effect btn btn-large orange pulse" v-if="existingCall" @click="runSetup" href="#" >
		        	<i class="fa fa-video"></i> Resume Video Interview
		        </a>


		      </div> <!-- end chat-header -->

		      <div class="chat-history">
		        <ul class="all-messages">
		          <li v-for="message in messages" v-bind:class="{ 'clearfix': message.user.id == userId }">
		            <div class="message-data" v-bind:class="{ 'align-right': message.user.id == userId }">
		              <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
		              <span class="message-data-name" >@{{ message.user.name }}</span> <i class="fa fa-circle me"></i>
		            </div>
		            <div class="message"
		            	v-bind:class="{
		            		'other-message float-right': message.user.id == userId,
		            	 	'my-message': message.user.id != userId,
		            	}"
		            >
						@{{ message.message }}
		            </div>
		          </li>

		          <li>
		            <div class="message-data">
		              <span class="message-data-name"><i class="fa fa-circle online"></i> @{{ messages[0].user.name }}</span>
		              {{-- <span class="message-data-time">@{{ message.created_at }}</span> --}}
		            </div>
		            <i class="fa fa-circle online"></i>
		            <i class="fa fa-circle online" style="color: #AED2A6"></i>
		            <i class="fa fa-circle online" style="color:#DAE9DA"></i>
		          </li>

		        </ul>

		      </div> <!-- end chat-history -->

		      <div class="chat-message clearfix">
		        <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3" class="white black-text" @keyup.enter="sendMessage(newMessage)" v-model="newMessage"></textarea>

		        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
		        <i class="fa fa-file-image-o"></i>

		        <button class="btn blue white-text" @click="sendMessage(newMessage)">Send</button>

		      </div> <!-- end chat-message -->

		    </div> <!-- end chat -->

			{{-- <div class="container z-depth-5 white">
				@include('jobs.partial', compact('job'))
			</div> --}}

			<div id="errorMessage" class="modal bottom-sheet">
		    	<div class="modal-content">
			      <p>@{{ errorMessage }}</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
			    </div>
			</div>

			<div id="waitForEmployer" class="modal modal-fixed green lighten-4">
		    	<div class="modal-content">
			      <p>Everything Works. Your camera has also been tested.</p>
			      <p>Please Wait, Your employer will be joining this interview anytime soon.</p>
			      <br>
			      <p class="red-text"><b>Note:</b> Do not close, refresh or navigate from this page.</p>
			    </div>
			    {{-- <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
			    </div> --}}
			</div>


		    <div id="call" class="black modal modal-fullscreen">

		        <div class="modal-content ">

			        <video id="their-video" autoplay></video>
			        <video id="my-video" muted="true" autoplay></video>

		        </div>

			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Minimize</a>
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat text-red" @click="endCall">End Call</a>
			    </div>
			</div>

		</div> <!-- end container -->


		@include('application.attachments', compact('application'))
		@include('application.answers', compact('application'))
		@include('application.social', compact('application'))
</div>

@endsection

@section('javascript')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.14/peer.min.js"></script>

	<script type="text/javascript">

		window.hash = '{{ Hash::make($application) .  Hash::make(time())}}';

		var data = {
			peerId: null,
			errorMessage: null,
			existingCall: null,
			userId: {{ auth()->user()->id }},
			userName: '{{ auth()->user()->name }}',
			applicationId: {{ $application->id }},
			newMessage: null,
			messages: [],
			contacted: null,

			status: 'available'
		};

		var application = new Vue({
			el: '#application'
		});

		var status = new Vue({
			el: '#status',
			data : data
		});

		var chat = new Vue({
			el: '#chat',
			data : data,
			mounted: function(){
				navigator.getUserMedia =
				navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

				window.socket = io.connect(
					'{{ env('NODE_SECURE', false) ? 'https://': 'http://' }}{{ env('NODE_SERVER', 'localhost') }}:{{ env('NODE_PORT', 3000) }}'
				);

				var vm = this;

				socket.on('application-messages-channel:message', function (data) {

					if(data.message && data.message.application_id == vm.applicationId){
						vm.messages.push(data.message);

				  		$(".chat-history").animate({
						    scrollTop: $(".all-messages").height()
						}, 400);
					}
				});

				vm.fetchMessages();

				window.peer = new Peer('{{
					base64_encode(str_slug($application->id . $application->job_id. $application->job->company_id . $application->user_id))
				}}', {
					host: '{{ env('NODE_SERVER', 'localhost') }}',
					port: {{ env('NODE_PORT', 3000) }},
					path: '/peer',
					secure: {{ env('NODE_SECURE', false) ? 1: 0 }}
				});

				// PeerJS object
				peer.on('open', function(){ vm.peerId = peer.id; });

				$('#errorMessage, #call, #waitForEmployer').modal();
			},
			methods: {
				runSetup: function(){
					var vm = this;
					navigator.getUserMedia({audio: true, video: true}, function(stream){
					    // Set your video displays
					    $('#my-video').prop('src', URL.createObjectURL(stream));
					    window.localStream = stream;
					    vm.prepareCall();
					}, function(){
						vm.showError('Failed to access the webcam and microphone. Make sure to run this demo on an http server and click allow when asked for permission by the browser.')
					});
				},

				showError: function(error){
					this.errorMessage = error;
					$('#errorMessage').modal().modal('open');
				},

			  	prepareCall: function(){

			  		var vm = this;

					peer.on('call', function(call){
						vm.existingCall = call;
						call.answer(window.localStream);
						vm.streamCall(call);

						$('#call').modal().modal('open');
						$('#waitForEmployer').modal('close');

					});

					peer.on('error', function(err){
						vm.showError(err.message);
						vm.endCall();
					});

					if (vm.existingCall) {
						$('#call').modal().modal('open');
					} else {

						$('#waitForEmployer').modal({ dismissible: false }).modal('open');
					}
			  	},

			  	streamCall: function(call){
					// Wait for stream on the call, then set peer video display
					call.on('stream', function(stream){
						$('#their-video').prop('src', URL.createObjectURL(stream));
					});
			  	},

			  	endCall: function(){
			  		var vm = this;

			  		if (vm.existingCall) {
					    vm.existingCall.close();
					    vm.existingCall = null;
					}

					$('#call').modal('close');
					$('#waitForEmployer').modal('close');
			  	},

			  	sendMessage: function(message){
			  		vm = this;

			  		$.post((window.location + '').replace(/\#?\!?\/?$/, "") + '/messages/', { message: message },
				  		function(response){
					  		vm.newMessage = '';
				  		}
				  	);
			  	},

			  	fetchMessages: function(){
			  		var vm = this;

			  		$.get((window.location + '').replace(/\#?\!?\/?$/, "") + '/messages', function(messages){

			  			$('#main').fadeIn(function(){
			  				$('#loader').hide();
			  			});

			  			vm.messages = messages;

			  			if(vm.messages.length){
			  				vm.contacted = true;
			  			}

			  			setTimeout(function(){
			  				$(".chat-history").animate({ scrollTop: $(".all-messages").height() }, 400);
			            }, 1000);
			  		});
			  	}
			}
		});
	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" href="/css/chat.css">
@endsection
