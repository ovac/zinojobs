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
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script> --}}
	<script src="//cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.14/peer.min.js"></script>
	{{-- <script src="//turahub-node.run/js/app1.js"></script> --}}
	{{-- <script src="//turahub-node.run/js/shared.js"></script> --}}

	<script type="text/javascript">

		var socket = io.connect('http://localhost:3000');

		socket.on('message', function (data) {
			console.log(data);
			socket.emit('my other event', { my: 'data' });
		});

		var chat = new Vue({
			el: '#chat',
			data : {
				peerId: null,
				errorMessage: null,
				existingCall: null,
				userId: {{ auth()->user()->id }},
				userName: '{{ auth()->user()->name }}',
				newMessage: null,
				messages: [],
			},
			mounted: function(){
				var vm = this;
				// Compatibility shim

				this.fetchMessages();

				navigator.getUserMedia =
				navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

				// PeerJS object
				window.peer = new Peer({{ auth()->user()->id }}, {host: 'localhost', port: 3000, path: '/peer'});
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
					  		vm.messages.push(response);

					  		vm.newMessage = '';

					  		$(".chat-history").animate({
							    scrollTop: $(".all-messages").height()
							}, 400);
				  		}
				  	);
			  	},

			  	fetchMessages: function(){
			  		var vm = this;

			  		$.get((window.location + '').replace(/\#?\!?\/?$/, "") + '/messages', function(messages){
			  			console.log(messages);
			  			vm.messages = messages;
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
	{{-- <link rel="stylesheet" href="//turahub-node.run/css/style.css"> --}}
	<style type="text/css">
		#my-video {
			margin-top: 15px;
			width: 280px;
			height: auto;
			background-color: #eee;
			position: absolute;
			right: 50px;
			bottom: 70px;
		}

		#their-video {
		  width: 100%;
		  height: 100%;
		  margin: 0px;
		  background-color: #000;
		}

		.modal-fullscreen.open{
		    width: 100%;
		    max-height: 100%;
		    height: 100%;
		    top: 0 !important;
		}

		.modal-fullscreen > .modal-content {
		  height: calc(100% - 56px);
		}

		@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
		#application {
		  background: #C5DDEB;
		  /*padding: 40px 0;*/
		  /*color: white;*/
		}

		.chat {
		  /*width: 490px;*/
		  font: 14px/20px "Lato", Arial, sans-serif;
		  /*float: left;*/
		  background: #F2F5F8;
		  border-top-right-radius: 5px;
		  border-bottom-right-radius: 5px;
		  color: #434651;
		}

		.chat .chat-header {
		  padding: 20px;
		  border-bottom: 2px solid white;
		}
		.chat .chat-header img {
		  float: left;
		}
		.chat .chat-header .chat-about {
		  float: left;
		  padding-left: 10px;
		  margin-top: 6px;
		}
		.chat .chat-header .chat-with {
		  font-weight: bold;
		  font-size: 16px;
		}
		.chat .chat-header .chat-num-messages {
		  color: #92959E;
		}
		.chat .chat-header .fa-star {
		  float: right;
		  color: #D8DADF;
		  font-size: 20px;
		  margin-top: 12px;
		}
		.chat .chat-history {
		  padding: 30px 30px 20px;
		  border-bottom: 2px solid white;
		  overflow-y: scroll;
		  height: 575px;
		}
		.chat .chat-history .message-data {
		  margin-bottom: 15px;
		}
		.chat .chat-history .message-data-time {
		  color: #a8aab1;
		  padding-left: 6px;
		}
		.chat .chat-history .message {
		  color: white;
		  padding: 18px 20px;
		  line-height: 26px;
		  font-size: 16px;
		  border-radius: 7px;
		  margin-bottom: 30px;
		  width: 90%;
		  position: relative;
		}
		.chat .chat-history .message:after {
		  bottom: 100%;
		  left: 7%;
		  border: solid transparent;
		  content: " ";
		  height: 0;
		  width: 0;
		  position: absolute;
		  pointer-events: none;
		  border-bottom-color: #86BB71;
		  border-width: 10px;
		  margin-left: -10px;
		}
		.chat .chat-history .my-message {
		  background: #86BB71;
		}
		.chat .chat-history .other-message {
		  background: #94C2ED;
		}
		.chat .chat-history .other-message:after {
		  border-bottom-color: #94C2ED;
		  left: 93%;
		}
		.chat .chat-message {
		  padding: 30px;
		}
		.chat .chat-message textarea {
		  width: 100%;
		  border: none;
		  padding: 10px 20px;
		  font: 14px/22px "Lato", Arial, sans-serif;
		  margin-bottom: 10px;
		  border-radius: 5px;
		  resize: none;
		}
		.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
		  font-size: 16px;
		  color: gray;
		  cursor: pointer;
		}
		.chat .chat-message button {
		  float: right;
		  color: #94C2ED;
		  font-size: 16px;
		  text-transform: uppercase;
		  border: none;
		  cursor: pointer;
		  font-weight: bold;
		  background: #F2F5F8;
		}
		.chat .chat-message button:hover {
		  color: #75b1e8;
		}

		.online, .offline, .me {
		  margin-right: 3px;
		  font-size: 10px;
		}

		.online {
		  color: #86BB71;
		}

		.offline {
		  color: #E38968;
		}

		.me {
		  color: #94C2ED;
		}

		.align-left {
		  text-align: left;
		}

		.align-right {
		  text-align: right;
		}

		.float-right {
		  float: right;
		}

		.clearfix:after {
		  visibility: hidden;
		  display: block;
		  font-size: 0;
		  content: " ";
		  clear: both;
		  height: 0;
		}
	</style>
@endsection
