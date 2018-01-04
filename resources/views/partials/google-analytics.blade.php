<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110494370-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110494370-1');

  @if (Auth::check())
  	gtag('set', {'user_id': {{ auth()->user()->id }}}); // Set the user ID using signed-in user_id.
  @endif
</script>
