<div class="row blue z-depth-2 lighten-5">
  <br>
  <form class="col s12" action="{{ url('/jobs') }}">
    <div class="row">
      <div class="input-field col s6 green-text">
        <i class="material-icons prefix">search</i>
        <input id="icon_search" type="text" class="validate" name="search" value="{{ Request::query('search') }}">
        <label for="icon_search">Job Title, Name, Company or Keyword</label>
      </div>
      <div class="input-field col s4">
        <i class="material-icons prefix red-text">place</i>
        <input id="icon_pin_drop" type="text" class="validate" name="location" value="{{ Request::query('location') }}">
        <label for="icon_pin_drop">Location</label>
      </div>
      <div class="input-field col s2">
          <button class="btn blue waves-effect waves-light right" type="submit">Search
              <i class="material-icons right">search</i>
          </button>
      </div>
    </div>
  </form>
</div>
