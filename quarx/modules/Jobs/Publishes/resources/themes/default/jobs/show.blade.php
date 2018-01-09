@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $job->id !!} - <span>{!! $job->updated_at !!}</span></h1>

</div>

@endsection

@section('quarx')
    @edit('jobs', $job->id)
@endsection
