<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Neo Ighodaro">
        <title>ColbyCMS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/flaticon.css">
        <link rel="stylesheet" href="/css/ionicons.min.css">
        <style> 
        body {
          padding-top: 74px;
        }
        @media (min-width: 992px) {
          body {
              padding-top: 76px;
          }
        }
        </style>
        @yield('scripts')
        @yield('styles')
      </head>
      <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #002878;">
          <div class="container">
            <a class="navbar-brand" href="/"><img style="width: 100px" src="/images/colby.png" /></a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                 @if (Route::has('login'))
                    @auth
                    @include(config('laravel-menu.views.bootstrap-items'), ['items' => $mainNav->roots()])
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        Log out
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                     </li>
                     @else
                     @include(config('laravel-menu.views.bootstrap-items'), ['items' => $mainNav->roots()])
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                     @endauth
                 @endif
              </ul>
            </div>
          </div>
        </nav>
      </header>

        <main id="app">
            @yield('content')
      </main>

        <footer class="py-5 bg-dark">
          <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; ColbyCMS 2020</p>
          </div>
        </footer>
      </body>
    </html>