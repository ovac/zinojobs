@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.jobs.create') !!}">Add New</a>
        <a class="btn btn-warning pull-right raw-margin-right-8" href="{!! Quarx::rollbackUrl($job) !!}">Rollback</a>
        <h1 class="page-header">Jobs</h1>
    </div>

    @include('jobs::jobs.breadcrumbs', ['location' => ['edit']])

    <div class="row">
        {!! Form::model($job, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.jobs.update', $job->id], 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($job, FormMaker::getTableColumns('jobs')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/jobs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection


