@if (count($errors) > 0)
  <div class="alert alert-danger text-center">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
{{--
<div class="page-header">
  <h1><small>Free trial tonight.. Enjoy</small></h1>
</div> --}}
