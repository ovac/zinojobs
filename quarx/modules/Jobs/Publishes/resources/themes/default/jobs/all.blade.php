@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Job</h1>

    <div class="row">
        <div class="col-md-12">
            @foreach($jobs as $job)
                <a href="{!! URL::to('jobs/'.$job->id) !!}"><p>{!! $job->name !!} - <span>{!! $job->updated_at !!}</span></p></a>
            @endforeach

            {!! $jobs !!}
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('jobs')
@endsection