<div class="row">
    <ol class="breadcrumb">
        <li><a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/companies') !!}">Companies</a></li>

        @foreach($location as $local)

            <li>{!! ucfirst($local) !!}</li>

        @endforeach
        <li class="active"></li>
    </ol>
</div>