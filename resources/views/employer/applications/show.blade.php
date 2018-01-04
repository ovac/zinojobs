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
          <div class="nav-wrapper "><a style="font-size: 15pt" class="page-title">Applicant Name: {{ $application->user->name }}</a></div>
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

<div id="main" style="display: none;">

		  <div class="tap-target" data-activates="menu">
		    <div class="tap-target-content">
		      <h5>Actions</h5>
		      <p>Take actions on this application.</p>
		    </div>
		  </div>

		<div class="clearfix container z-depth-3 white" id="chat" v-if="messages.length">

		    <div class="chat">
		      <div class="chat-header clearfix">
		        <img src="{{ $application->user->avatar }}" alt="avatar" height="100px"/>

		        <div class="chat-about">
		          <div class="chat-with">Chat with {{ $application->user->name }}</div>
		          <div class="chat-num-messages">Messages: @{{ messages.length }}</div>
		        </div>
		        <button class="right waves-effect btn waves-light" v-if="!existingCall"
		        @click="call(applicantPeerId)">
		        	<i class="fa fa-video"></i> Start Video Interview
		        </button>

		        <a class="right waves-effect btn btn-large orange pulse" v-if="existingCall" @click="prepareCall" href="#" >
		        	<i class="fa fa-video"></i> Resume Video Interview
		        </a>

		      </div> <!-- end chat-header -->

		      <div class="chat-history">
		        <ul class="all-messages">
		          <li v-for="message in messages" v-bind:class="{ 'clearfix': message.user.id == userId }">
		            <div class="message-data" v-bind:class="{ 'align-right': message.user.id == userId }">
		              <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
		              <span class="message-data-name" >@{{ message.user.id == userId ? userName: applicantName }}</span> <i class="fa fa-circle me"></i>
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
		              <span class="message-data-name"><i class="fa fa-circle online"></i> @{{ applicantName }}</span>
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


			<div id="errorMessage" class="modal bottom-sheet">
		    	<div class="modal-content">
			      <p>@{{ errorMessage }}</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
			    </div>
			</div>

			{{-- <div id="waitForEmployer" class="modal modal-fixed green lighten-4">
		    	<div class="modal-content">
			      <p>Everything Works. Your camera has also been tested.</p>
			      <p>Please Wait, Your employer will be joining this interview anytime soon.</p>
			      <br>
			      <p class="red-text"><b>Note:</b> Do not close, refresh or navigate from this page.</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
			    </div>
			</div> --}}


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

		<br><br>
		<div class="container z-depth-3 white"  style="padding: 2em 0px; " id="status">
			<div class="container">
				<blockquote style="font-size: 3em;">
					<p>
						Accessment result: {{ $application->totalMatch() . '/' . $application->job->questions->count() }}
					</p>
					{{-- <p>
						Applicant System Ranking: {{ $application->totalMatch() . '/' . $application->job->questions->count() }}
					</p> --}}
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

		@include('application.attachments', compact('application'))
		@include('application.answers', compact('application'))
		@include('application.social', compact('application'))
</div>

		<div id="actions">
			<div class="fixed-action-btn toolbar" id="menu">
			    <a class="btn-floating btn-large red">
			      <i class="large material-icons">menu</i>
			    </a>
			    <ul class="z-depth-3">

			      <li class="yellow waves-effect waves-light">
			      	<a href="#!" class="black-text"><i class="red-text material-icons">grade</i> Add to shortlist</a>
			      </li>

			      <li class="blue waves-effect waves-light" @click="scheduleOnlineInterview">
			      	<a href="#!"><i class="material-icons">thumb_up</i> Schedule Online Interview</a>
			      </li>

			      <li class="purple waves-effect waves-light">
			      	<a href="#!"><i class="material-icons">airline_seat_recline_normal</i>Invite for Face to Face Interview</a>
			      </li>

			      <li class="green waves-effect waves-light">
			      	<a href="#!"><i class="material-icons">thumb_up</i> Award the job to this Applicant</a>
			      </li>
			    </ul>
			</div>

			<div id="scheduleOnlineInterview" class="modal lighten-2">
				<form id="schedule" method="POST"
				action="{{ url("/employer/jobs/{$application->job->id}/applications/{$application->id}/chat-schedule/") }}">
			    	<div class="modal-content">
						{!! csrf_field() !!}
			    		<div class="container" style="margin-top: 120px">
				    		<div class="center">
				    			<h5>Please select a date and time for the online interview.</h5>
				    		</div>
				    		<br>
				    		<br>

				    		<div class="input-field col s6 m6">
					       		<input type="text" class="datepicker" id="interview_date" placeholder="Enter Date" name="date" required>
							    <label id="interview_date">Select a date for the interview</label>
							</div>

				    		<div class="input-field col s6 m6">
				       			<input type="text" class="timepicker" id="interview_time" placeholder="Enter time" name="time" required>
							    <label id="interview_date">Select a time</label>
							</div>
			    		</div>
				    </div>
				    <div class="progress" v-if="loading">
					    <div class="indeterminate"></div>
					</div>
				    <div class="modal-footer" v-else>
				      <a href="#!" class="modal-action modal-close waves-effect waves-green red-text btn-flat">Cancel</a>
				      <a href="#!" class="modal-action waves-effect waves-green btn-flat" type="submit" @click="sendSchedule(date, time)">OK</a>
				    </div>
				</form>
			</div>
		</div>

@endsection

@section('javascript')
	<script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.14/peer.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/materialize-social@1.0.3/index.min.js"></script>

	<script type="text/javascript">

		var data = {
			peerId: null,
			errorMessage: null,
			existingCall: null,
			userId: {{ auth()->user()->id }},
			userName: '{{ auth()->user()->name }}',
			applicantName: '{{ $application->user->name }}',
			applicationId: {{ $application->id }},
			newMessage: null,
			messages: [],
			contacted: null,
			applicantPeerId: null,

			status: 'available'
		};

		var application = new Vue({
			el: '#application'
		});

		var status = new Vue({
			el: '#status',
			data : data
		});

		var actions = new Vue({
			el: '#actions',
			data : {
				date: null,
				time: null,
				message: null,
				loading: false,
			},
			methods: {
				scheduleOnlineInterview: function(){
					$('#scheduleOnlineInterview').modal({ dismissible: false }).modal('open');

					$('.datepicker').pickadate({
					    selectMonths: true, // Creates a dropdown to control month
					    selectYears: 15, // Creates a dropdown of 15 years to control year,
					    today: 'Today',
					    clear: 'Clear',
					    close: 'Ok',
					    closeOnSelect: false // Close upon selecting a date,
					});

					$('.timepicker').pickatime({
					    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
					    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
					    twelvehour: false, // Use AM/PM or 24-hour format
					    donetext: 'OK', // text for done-button
					    cleartext: 'Clear', // text for clear-button
					    canceltext: 'Cancel', // Text for cancel-button
					    autoclose: false, // automatic close timepicker
					    ampmclickable: true, // make AM PM clickable
					    aftershow: function(){} //Function for after opening timepicker
					});
				},
				sendSchedule: function(){
					$('#schedule').submit();
				}
			}
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

				socket.on('ready-for-video-interview:interview:{{ $application->id }}', function (data) {

					if(data.applicationId == vm.applicationId){
						socket.emit('ready-for-video-interview:response', data);
						alert('Applicant is ready for video Interview');
						vm.applicantPeerId = data.applicantPeerId;
					}
				});

				vm.fetchMessages();

				window.peer = new Peer({
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
				call: function(peerId){
					var vm = this;

					if (peerId && vm.peerId) {
						navigator.getUserMedia({audio: true, video: true}, function(stream){
						    // Set your video displays
						    $('#my-video').prop('src', URL.createObjectURL(stream));
						    window.localStream = stream;
						    vm.prepareCall(peerId);
						}, function(){
							vm.showError('Failed to access the webcam and microphone. Make sure to run this demo on an http server and click allow when asked for permission by the browser.')
						});
					}
					else if(!peerId){
						vm.showError('The applicant is not ready. Ask the applicant to click on *READY FOR VIDEO INTERVIEW*.')
					}
					else {
						vm.showError('Unable to reach server. Please reload this window.');
					}

				},

				showError: function(error){
					this.errorMessage = error;
					$('#errorMessage').modal().modal('open');
				},
			  	prepareCall: function(peerId){

			  		var vm = this;

					peer.on('error', function(err){
						if(err.message.match(/Could not connect to peer/)){
							vm.showError('Unable to connect to the applicant. Please ask the applicant to clic on the *prepare for video interview* first.');

						} else {
							vm.showError(err.message);
						}
						vm.endCall();
					});

					if (!vm.existingCall) {
						vm.existingCall = peer.call(peerId, window.localStream);
						vm.streamCall(vm.existingCall);
					}

					$('#call').modal().modal('open');
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

				  			setTimeout(function(){
				  				$(".chat-history").animate({ scrollTop: $(".all-messages").height() }, 400);
				            }, 1000);
			  			} else {
			  				$('.tap-target').tapTarget('open');
			  			}
			  		});
			  	}
			}
		});
	</script>
@endsection

@section('stylesheets')
	<link rel="stylesheet" href="/css/chat.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/materialize-social@1.0.3/materialize-social.css">
@endsection
