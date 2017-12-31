<div class="row blue lighten-5">
  <br>
  <form class="col s12" action="{{ url('/jobs') }}">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">search</i>
        <input id="icon_search" type="text" class="validate" name="keyword">
        <label for="icon_search">Job Title, Name or Keyword</label>
      </div>
      <div class="input-field col s4">
        <i class="material-icons prefix">pin_drop</i>
        <input id="icon_pin_drop" type="text" class="validate" name="location">
        <label for="icon_pin_drop">Location</label>
      </div>
      <div class="input-field col s2">
          <button class="btn blue waves-effect waves-light right" type="submit" name="action">Search
              <i class="material-icons right">search</i>
          </button>
      </div>
    </div>
  </form>
</div>
