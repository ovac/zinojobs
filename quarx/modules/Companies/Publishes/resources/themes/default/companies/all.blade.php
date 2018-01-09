@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Company</h1>

    <div class="row">
        <div class="col-md-12">
            @foreach($companies as $company)
                <a href="{!! URL::to('companies/'.$company->id) !!}"><p>{!! $company->name !!} - <span>{!! $company->updated_at !!}</span></p></a>
            @endforeach

            {!! $companies !!}
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('companies')
@endsection