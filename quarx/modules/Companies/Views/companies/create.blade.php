@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Companies</h1>
    </div>

    @include('companies::companies.breadcrumbs', ['location' => ['create']])

     <div class="row">
        {!! Form::open(['route' => config('quarx.backend-route-prefix', 'quarx').'.companies.store', 'companies' => true, 'class' => 'add']); !!}

            {!! FormMaker::fromTable('companies', Quarx::moduleConfig('companies', 'companies')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/companies') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
