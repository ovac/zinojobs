@extends('quarx-frontend::layout.master')

@section('content')
	<br>
	<br>
	<div class="container z-depth-2" style="padding: 20px;">
		<div class="center">
		    <a href="/logout" type="submit" class="btn red ">Logout</a>
		</div>
	</div>
	<br>
	<br>
	<div class="container z-depth-2" style="padding: 50px;">
		<div class="center">
			<img src="{{ $user->avatar }}" height="200px">
		</div>

	    <form class="col s12" action="/account/avatar" method="POST" enctype="multipart/form-data">
	    	{!! csrf_field() !!}
	    	<input type="hidden" name="_method" value="PATCH">
	    	<legend>Update Profile Picture</legend>
	        <div class="file-field input-field">
		      <div class="small btn">
		        <span>File</span>
		        <input type="file" name="avatar">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>

	      <button type="submit" class="btn blue">Submit</button>
	    </form>
	</div>

	<br>
	<br>
	<div class="container z-depth-2" style="padding: 50px;">

		<div class="row">
		    <form class="col s12" action="/account/profile" method="POST">
		    	{!! csrf_field() !!}
		    	<input type="hidden" name="_method" value="PATCH">
		    	<legend>Profile Settings</legend>
		    	<div class="row">
			        <div class="input-field col s12">
			          <input id="name" type="text" class="validate" value="{{ $user->name }}" name="name">
			          <label for="name">Full Name</label>
			        </div>
		    	</div>

			    <div class="row">
			        <div class="input-field col s6">
			          <input id="phone" type="tel" class="validate" value="{{ $user->phone }}" name="phone">
			          <label for="phone">Phone</label>
			        </div>
			        <div class="input-field col s6">
			          <input id="email" type="email" class="validate" value="{{ $user->email }}" name="email">
			          <label for="email">Email</label>
			        </div>
			    </div>

		      	<button type="submit" class="btn blue">Submit</button>
		    </form>

		  </div>
	</div>
	<br>
	<br>
	<div class="container z-depth-2" style="padding: 50px;">

		<div class="center">
			<h5><a href="{{ $user->resume }}" class="btn pulse large">Download Default Resume</a></h5>
		</div>

	    <form class="col s12" action="/account/resume" method="POST">
	    	{!! csrf_field() !!}
	    	<input type="hidden" name="_method" value="PATCH">
	    	<legend>Update Default Resume/CV</legend>
	        <div class="file-field input-field">
		      <div class="small btn">
		        <span>File</span>
		        <input type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>

	      <button type="submit" class="btn blue">Submit</button>
	    </form>
	</div>

	<br>
	<br>
	<div class="container z-depth-2" style="padding: 50px;">
		    <form class="col s12" action="/account/password" method="POST">
		    	{!! csrf_field() !!}
		    	<input type="hidden" name="_method" value="PATCH">
		    	<legend>Change Password</legend>
			      <div class="row">
			        <div class="input-field col s12 m4">
			          <input id="password" type="password" class="validate">
			          <label for="password">Current Password</label>
			        </div>
			        <div class="input-field col s12 m4">
			          <input id="password" type="password" class="validate">
			          <label for="password">New Password</label>
			        </div>
			        <div class="input-field col s12 m4">
			          <input id="password" type="password" class="validate">
			          <label for="password">Repeat New Password</label>
			        </div>
			      </div>

		      <button type="submit" class="btn blue">Submit</button>
			</form>
		</div>
	</div>

	{{-- <br>
	<br>
	<div class="container z-depth-2" style="padding: 50px;">

		  <div class="row">
		  	<form class="col s12">
		    	<legend>Social Settings</legend>
		      <div class="row">
		        <div class="input-field col s12 m4">
		          <input id="password" type="password" class="validate">
		          <label for="password">Current Password</label>
		        </div>
		        <div class="input-field col s12 m4">
		          <input id="password" type="password" class="validate">
		          <label for="password">New Password</label>
		        </div>
		        <div class="input-field col s12 m4">
		          <input id="password" type="password" class="validate">
		          <label for="password">Repeat New Password</label>
		        </div>
		      </div>

		      <button type="submit" class="btn blue">Submit</button>

		    </form>
		  </div>
		</div>
	</div> --}}
@endsection
