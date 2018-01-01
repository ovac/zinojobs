@extends('quarx-frontend::layout.master')

@if (isset($page))
    @section('seoDescription') {{ $page->seo_description }} @endsection
    @section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

<div class="container">

    <br>
    <br>
    <br>
    <div class="center">
        <h1>{!! $page->title or 'Find a Job' !!}</h1>
    </div>

    @if (isset($page))
        {!! $page->entry !!}
    @else
        @include('jobs.search')
    @endif

</div>
@endsection

@section('javascript')
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDRjU9acDWs6tirlVTPhbFw8bDtYpIw6bI&sensor=false&libraries=places&dummy=.js"></script>
    <script>
        $(document).ready(function() {

            var input = document.getElementById('icon_pin_drop');
            var options = {
                componentRestrictions: {
                    country: 'GH'
                }
            };

            new google.maps.places.Autocomplete(input, options);
        });
    </script>
@endsection
{{--
@section('quarx')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection --}}