@extends('quarx-frontend::layout.master')

@section('content')
<div>

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

		<div class="container z-depth-5 white"  style="padding: 2em 0px; font-size: 3em;">
			<div class="container">
				<blockquote>
					<p>You applied for this job. </p>

					{{-- <p>After a manual review, someone from {{ $job->company->name }} will get back to you.</p> --}}
					{{-- <p>Based on your entry, you did not qualify for this job.</p> --}}
					{{-- <div>The job has been awarded to another applicant.</div> --}}
					{{-- <div>This job is no longer available.</div> --}}
			    </blockquote>
		    </div>
		</div>

		<br>
		<br>

		<div class="clearfix container z-depth-5 white teal" id="chat">


		    <div class="chat">
		      <div class="chat-header clearfix">
		        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />

		        <div class="chat-about">
		          <div class="chat-with">Chat with Vincent Porter</div>
		          <div class="chat-num-messages">already 1 902 messages</div>
		        </div>
		        <a class="right waves-effect btn waves-light" v-if="!existingCall" @click="runSetup" href="#">
		        	<i class="fa fa-video"></i> Prepared for Video Interview
		        </a>

		        <a class="right waves-effect btn btn-large orange pulse" v-if="existingCall" @click="runSetup" href="#" >
		        	<i class="fa fa-video"></i> Resume Video Interview
		        </a>


		      </div> <!-- end chat-header -->

		      <div class="chat-history">
		        <ul class="all-messages">
		          <li v-for="message in messages" v-bind:class="{ 'clearfix': message.user.id == userId }">
		            <div class="message-data" v-bind:class="{ 'align-right': message.user.id == userId }">
		              <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
		              <span class="message-data-name" >@{{ message.user.id == userId ? 'Victor Ariama': 'Vincent' }}</span> <i class="fa fa-circle me"></i>
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
		              <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
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

		        <button>Send</button>

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

		<br>
		<br>
		<div class="container z-depth-5 white center" style="padding: 3em 0px;">
			<div>
			    <span style="font-size:2em;">
			    	<u class="text-center">Attachments</u>
			    </span>
			</div>

			<div class="container">
				@foreach (['are you a man?', 'do you love dogs?', 'yave you done your nysc'] as $question)
					<br>
					<a href="" class="btn blue waves-effect"><i class="material-icons">grade</i> Resume - Download </a>
					<br>
				@endforeach
			</div>
		</div>

		<br>
		<br>
		<div class="container z-depth-5 white center" style="padding: 3em 0px;">
			<div>
			    <span style="font-size:2em;">
			    	<u class="text-center">Screening Questions</u>
			    </span>
			</div>


			<div class="container">
				<div class="collection">
					@foreach ($job->questions as $question)
		         		@if($question->requirement)
							<div class="collection-item">
								<span>Queston No. {{ $question->id }}</span>
								<br>
								<span>{{ $question->question }}</span>
								<br>
								<span>Answer: {{ $question->question }}</span>
							</div>
		         		@endif
		         	@endforeach
				</div>
			</div>
		</div>

		<br>
		<br>
		<div class="container z-depth-5 white center" style="padding: 3em 0px;">
			<div>
			    <span style="font-size:2em;">
			    	<u class="text-center">Questionnaire</u>
			    </span>
			</div>

			<div class="container">
				<div class="collection">
					@foreach ($job->questions as $question)
		         		@unless($question->requirement)
							<div class="collection-item">
								<span>Queston No. {{ $question->id }}</span>
								<br>
								<span>{{ $question->question }}</span>
								<br>
								<span>Answer: {{ $question->question }}</span>
							</div>
		         		@endif
		         	@endforeach
				</div>
			</div>
		</div>


		<br>
		<br>
</div>

@endsection

@section('javascript')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.14/peer.min.js"></script>

	<script type="text/javascript">

		var chat = new Vue({
			el: '#chat',
			data : {
				peerId: null,
				errorMessage: null,
				existingCall: null,
				userId: {{ auth()->user()->id }},
				userName: '{{ auth()->user()->name }}',
				applicationId: {{ $application->id }},
				newMessage: null,
				messages: [],
			},
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

				window.peer = new Peer({{ auth()->user()->id }}, {
					host: '{{ env('NODE_SERVER', 'localhost') }}',
					port: {{ env('NODE_PORT', 3000) }},
					path: '/peer',
					secure: {{ env('NODE_SECURE', false) ? 1: 0 }}
				});

				// PeerJS object
				peer.on('open', function(){ vm.peerId = peer.id; });

		    	$('#errorMessage, #call').modal();
		    	$('#waitForEmployer').modal({ dismissible: false });
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
					$('#errorMessage').modal('open');
				},

			  	prepareCall: function(){

			  		var vm = this;

					peer.on('call', function(call){
						vm.existingCall = call;
						call.answer(window.localStream);
						vm.streamCall(call);

						$('#call').modal('open');
						$('#waitForEmployer').modal('close');

					});

					peer.on('error', function(err){
						vm.showError(err.message);
						vm.endCall();
					});

					if (vm.existingCall) {
						$('#call').modal('open');
					} else {
						$('#waitForEmployer').modal('open');
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
			  			vm.messages = messages;
			  			setTimeout(function(){
			  				$(".chat-history").animate({ scrollTop: $(".all-messages").height() }, 400);
			            }, 1000);
			  		});
			  	}
			}
		});

		var application = new Vue({
			el: '#application',

			data : {
				tab: 1
			},

			methods: {
				setTab: function(tabId){
					this.tab = tabId;
			  	},
			}
		});
	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" href="/css/chat.css">
@endsection
