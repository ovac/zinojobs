@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.companies.create') !!}">Add New</a>
        <a class="btn btn-warning pull-right raw-margin-right-8" href="{!! Quarx::rollbackUrl($company) !!}">Rollback</a>
        <h1 class="page-header">Companies</h1>
    </div>

    @include('companies::companies.breadcrumbs', ['location' => ['edit']])

    <div class="row">
        {!! Form::model($company, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.companies.update', $company->id], 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($company, FormMaker::getTableColumns('companies')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/companies') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection


