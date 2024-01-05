<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="auth-check" content="{{ (Auth::check()) ? 'true' : 'false' }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('/')}}/css/stylesheet.css" /> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="{{ URL::to('/')}}/js/custom.js"></script>
   </head>
   <body>
      <!-- header starts -->
        <header>
         <div class='container container-flex'>
            <div class='site-title'>
               <h1>Living The Social Life</h1>
               <p class='subtitle'>A blog exploring minimalism in life.</p>
            </div>
            <nav>
               <ul>
                  <li> <a href='/' class='current-page'>Home</a> </li>
                  <li> <a href='{{ url("/blogs")}}'>Blogs</a> </li>
                  @guest
                      @if (Route::has('login'))
                          <li>
                              <a href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                      @endif

                      @if (Route::has('register'))
                          <li>
                              <a href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @endguest
               </ul>
            </nav>
         </div>
        </header>
      <!-- header ends -->
      <!-- container starts -->
      <div class="container-flex">
         <main role="main">
            @yield('content')
         </main>
      </div>
      <!-- container ends -->
      <!-- footer starts -->
      <footer>
         <p><strong>Living the Simple Life</strong></p>
         <!-- <p>Copyright 2021, <a href='akramnarejo.github.io' target='_blank'>Akram Narejo</a></p> -->
      </footer>
      <!-- footer ends -->
      <script type="text/javascript">
         $(document).ready(function () {
            $('#formValidate').validate();
         })
         
         @if(!empty(Session::get('limit_error')))
            Swal.fire({
              text: "{{ session('limit_error') }}",
              icon: "error"
            }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  window.location = 'subscriptions';
                }
            });;
         @endif
         @if(!empty(Session::get('order_success')))
            Swal.fire({
              text: "{{ session('order_success') }}",
              icon: "success"
            }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  window.location = '/';
                }
            });;
         @endif
      </script>
   </body>
</html>
