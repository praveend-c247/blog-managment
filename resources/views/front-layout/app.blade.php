<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('/')}}/css/stylesheet.css" /> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
               </ul>
            </nav>
         </div>
        </header>
      <!-- header ends -->
      <!-- container starts -->
      <div class="container container-flex">
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

   </body>
</html>
