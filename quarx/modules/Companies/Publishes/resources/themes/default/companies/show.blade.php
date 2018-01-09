@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $company->id !!} - <span>{!! $company->updated_at !!}</span></h1>

</div>

@endsection

@section('quarx')
    @edit('companies', $company->id)
@endsection
