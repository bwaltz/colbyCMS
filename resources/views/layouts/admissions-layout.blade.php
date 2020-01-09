<!-- File: ./resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Neo Ighodaro">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/flaticon.css">
        <link rel="stylesheet" href="/css/ionicons.min.css">
        
        @yield('styles')
      </head>
      <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #002878;">
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

      <section style="border-top: 2px solid #ccc;">
    <div class="container">
      	<div class="row justify-content-center mb-5 pb-3" style="padding-top: 51px;">
          <div class="col-md-7 heading-section  text-center">

    <nav class="social-icons" style="display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: 0 auto;
    padding-bottom: 1.5em;
    width: 12em;
    text-align: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: distribute;
    justify-content: space-around;">
		<a href="https://www.facebook.com/colbycollege/" style="    color: #888;
    -webkit-transition: color .2s,-webkit-transform .2s;
    transition: color .2s,-webkit-transform .2s;
    transition: transform .2s,color .2s;
    transition: transform .2s,color .2s,-webkit-transform .2s;
    -webkit-transform: scale(.97);
    transform: scale(.97);">
		<svg style="width: 1.5em;height: 1.5em;" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1376 128q119 0 203.5 84.5t84.5 203.5v960q0 119-84.5 203.5t-203.5 84.5h-188v-595h199l30-232h-229v-148q0-56 23.5-84t91.5-28l122-1v-207q-63-9-178-9-136 0-217.5 80t-81.5 226v171h-200v232h200v595h-532q-119 0-203.5-84.5t-84.5-203.5v-960q0-119 84.5-203.5t203.5-84.5h960z" fill="currentColor"></path></svg>
	</a>

		<a href="https://twitter.com/ColbyCollege" style="    color: #888;
    -webkit-transition: color .2s,-webkit-transform .2s;
    transition: color .2s,-webkit-transform .2s;
    transition: transform .2s,color .2s;
    transition: transform .2s,color .2s,-webkit-transform .2s;
    -webkit-transform: scale(.97);
    transform: scale(.97);">
		<svg style="width: 1.5em;height: 1.5em;" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1684 408q-67 98-162 167 1 14 1 42 0 130-38 259.5t-115.5 248.5-184.5 210.5-258 146-323 54.5q-271 0-496-145 35 4 78 4 225 0 401-138-105-2-188-64.5t-114-159.5q33 5 61 5 43 0 85-11-112-23-185.5-111.5t-73.5-205.5v-4q68 38 146 41-66-44-105-115t-39-154q0-88 44-163 121 149 294.5 238.5t371.5 99.5q-8-38-8-74 0-134 94.5-228.5t228.5-94.5q140 0 236 102 109-21 205-78-37 115-142 178 93-10 186-50z" fill="currentColor"></path></svg>
	</a>

		<a href="https://www.instagram.com/colbycollege/" style="    color: #888;
    -webkit-transition: color .2s,-webkit-transform .2s;
    transition: color .2s,-webkit-transform .2s;
    transition: transform .2s,color .2s;
    transition: transform .2s,color .2s,-webkit-transform .2s;
    -webkit-transform: scale(.97);
    transform: scale(.97);">
		<svg style="width: 1.5em;height: 1.5em;" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1490 1426v-648h-135q20 63 20 131 0 126-64 232.5t-174 168.5-240 62q-197 0-337-135.5t-140-327.5q0-68 20-131h-141v648q0 26 17.5 43.5t43.5 17.5h1069q25 0 43-17.5t18-43.5zm-284-533q0-124-90.5-211.5t-218.5-87.5q-127 0-217.5 87.5t-90.5 211.5 90.5 211.5 217.5 87.5q128 0 218.5-87.5t90.5-211.5zm284-360v-165q0-28-20-48.5t-49-20.5h-174q-29 0-49 20.5t-20 48.5v165q0 29 20 49t49 20h174q29 0 49-20t20-49zm174-208v1142q0 81-58 139t-139 58h-1142q-81 0-139-58t-58-139v-1142q0-81 58-139t139-58h1142q81 0 139 58t58 139z" fill="currentColor"></path></svg>
	</a>

		<a href="https://vimeo.com/colbycollege" style="    color: #888;
    -webkit-transition: color .2s,-webkit-transform .2s;
    transition: color .2s,-webkit-transform .2s;
    transition: transform .2s,color .2s;
    transition: transform .2s,color .2s,-webkit-transform .2s;
    -webkit-transform: scale(.97);
    transform: scale(.97);">
		<svg style="width: 1.5em;height: 1.5em;" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1709 518q-10 236-332 651-333 431-562 431-142 0-240-263-44-160-132-482-72-262-157-262-18 0-127 76l-77-98q24-21 108-96.5t130-115.5q156-138 241-146 95-9 153 55.5t81 203.5q44 287 66 373 55 249 120 249 51 0 154-161 101-161 109-246 13-139-109-139-57 0-121 26 120-393 459-382 251 8 236 326z" fill="currentColor"></path></svg>
	</a>

	
</nav>
<div class="contact" style="margin-bottom: 1.5rem;
    color: #888;
    font-size: .841em;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;     display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;">
		<div style="flex: 0 0 100%;
    max-width: 100%;">
	        <span class="contact__name">
            Office of Admissions and Financial Aid
	        </span>
	        <span class="contact__address">
            4800 Mayflower Hill, Waterville, Maine 04901	        </span>
		</div>
		<div style="    flex: 0 0 50%;
    max-width: 50%; justify-content: space-around;">
	        <span class="contact__phone">
	            207-859-4735	        </span>
	        <span class="contact__web">
	            <a href="mailto:commencement@colby.edu">
	                admissions@colby.edu	            </a>
	        </span>
		</div>

		<div style="    -webkit-box-flex: 0;
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;">
			<a href="http://www.colby.edu/">
				<svg style="width: 150px;
    height: 75px;
    color: #888;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 189 62.71"><defs><clipPath id="clip-path"><rect fill="currentColor" class="cls-1" width="189" height="62.71"></rect></clipPath></defs><title>Artboard 1</title><g fill="currentColor" class="cls-2"><path fill="currentColor" d="M77.41,24.36v3H80.6v13h3.5v-13h3.26v-3Zm-4,10.16c-.12.86-.38,3.21-2.28,3.21-2.08,0-2.4-2.42-2.4-5.1,0-3.23.41-5.65,2.4-5.65s2.16,2.3,2.25,3.57l3.19-.24a8.16,8.16,0,0,0-1.13-4,4.81,4.81,0,0,0-4.34-2.16c-5.34,0-6.06,5.34-6.06,8.24,0,3.64,1.15,8.22,6,8.22,3.5,0,5.32-2.61,5.58-5.85ZM54.2,24.36v16h9.7V37.49H57.7V33.56h4.82V30.8H57.7V27.11h6.21V24.36Zm-13.6,0v16h2.73V28.77L48.2,40.34h3.14v-16H48.61v9.92l-4.1-9.92Zm-13.52,0v16h2.73V28.77l4.86,11.57h3.14v-16H35.08v9.92L31,24.36ZM19,27c1.82,0,2.11,2,2.11,5.39s-.31,5.37-2.11,5.37-2.11-1.94-2.11-5.37S17.2,27,19,27m0-2.85c-5.2,0-5.8,5.18-5.8,8.24s.67,8.22,5.8,8.22,5.8-5.3,5.8-8.22c0-3.33-.72-8.24-5.8-8.24M8.36,34.52c-.12.86-.38,3.21-2.28,3.21-2.08,0-2.4-2.42-2.4-5.1,0-3.23.41-5.65,2.4-5.65s2.16,2.3,2.25,3.57l3.19-.24a8.16,8.16,0,0,0-1.13-4,4.81,4.81,0,0,0-4.34-2.16C.72,24.12,0,29.46,0,32.36,0,36,1.15,40.58,6,40.58c3.5,0,5.32-2.61,5.58-5.85Z"></path><path fill="currentColor" d="M178.22,24.36l4.43,9.22v6.76h1.94V33.58L189,24.36h-1.77l-3.45,7.36-3.5-7.36ZM170,32.74h2.09a4.09,4.09,0,0,1,2.61.6,2.87,2.87,0,0,1,1.13,2.44c0,2.13-1.36,2.95-3.35,2.95H170ZM170,26h2.4c.89,0,2.88,0,2.88,2.54s-1.87,2.63-3.14,2.63H170ZM168,40.34h4.46c4,0,5.32-1.94,5.32-4.46a3.76,3.76,0,0,0-3-4,3.47,3.47,0,0,0,2.44-3.55,4.37,4.37,0,0,0-1-2.8c-1-1.15-2.47-1.15-3.93-1.15H168Zm-9.7-16v16h8V38.73h-6.06V24.36ZM150,25.63a2.81,2.81,0,0,1,2.76,1.73,11.36,11.36,0,0,1,.91,5,11.44,11.44,0,0,1-.91,5,3.07,3.07,0,0,1-5.51,0,11.43,11.43,0,0,1-.91-5,11.77,11.77,0,0,1,.91-5,2.85,2.85,0,0,1,2.76-1.7m0-1.61c-4.89,0-5.73,5-5.73,8.34,0,3.19.77,8.31,5.73,8.31,4.77,0,5.63-4.82,5.63-8.31S154.8,24,150.05,24m-9.27,11.31c-.58,2.76-1.27,3.71-3.07,3.71-3.26,0-3.62-4.46-3.62-6.68,0-1.58.1-6.71,3.62-6.71,2.32,0,2.76,2.13,3.07,3.69l1.85-.45c-.29-1.46-1-4.86-5-4.86-5.3,0-5.63,6.21-5.63,8.39,0,3.16.72,8.27,5.56,8.27,3.64,0,4.5-2.52,4.93-4.91Zm-22.52-9.7A2.81,2.81,0,0,1,121,27.35a11.34,11.34,0,0,1,.91,5,11.44,11.44,0,0,1-.91,5,3.07,3.07,0,0,1-5.51,0,11.43,11.43,0,0,1-.91-5,11.77,11.77,0,0,1,.91-5,2.85,2.85,0,0,1,2.76-1.7m0-1.61c-4.89,0-5.73,5-5.73,8.34,0,3.19.77,8.31,5.73,8.31,4.77,0,5.63-4.82,5.63-8.31S123.05,24,118.31,24m-15.9.34V26h3.81V40.34h1.94V26H112V24.36Z"></path><line stroke="currentColor" class="cls-4" x1="94.85" y1="1.4" x2="94.85" y2="61.3"></line></g></svg>
			</a>
		</div>

    </div>
</div>
</div>
</div>
</section>
        @yield('scripts')
      </body>
    </html>