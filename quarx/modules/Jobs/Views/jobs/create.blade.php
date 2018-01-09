@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Jobs</h1>
    </div>

    @include('jobs::jobs.breadcrumbs', ['location' => ['create']])

     <div class="row">
        {!! Form::open(['route' => config('quarx.backend-route-prefix', 'quarx').'.jobs.store', 'jobs' => true, 'class' => 'add']); !!}

            {!! FormMaker::fromTable('jobs', Quarx::moduleConfig('jobs', 'jobs')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/jobs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
