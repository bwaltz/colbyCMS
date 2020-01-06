<!-- File: ./resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Neo Ighodaro">
        <title>ColbyCMS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
            <p class="m-0 text-center text-white">Copyright &copy; ColbyCMS 2019</p>
          </div>
        </footer>
      </body>
    </html>