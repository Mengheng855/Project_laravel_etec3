<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ url('css/frontend/theme.css') }}" rel="stylesheet">
        <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="logo">
                   
 @if(isset($logo) && $logo->logo)
    <img src="{{ asset($logo->logo) }}" height="80px"  width="100px" alt="Logo">
@else
    <h1>KH FASHION</h1>
@endif
                </div>
                <ul class="menu">
                    <li>
                        <a href="/">HOME</a>
                    </li>
                    <li>
                        <a href="shop">SHOP</a>
                    </li>
                    <li>
                        <a href="news">NEWS</a>
                    </li>
                </ul>
                <div class="search d-flex gap-3">
                    <form action="/search" method="get">
                        <input type="text" name="s" class="box" placeholder="SEARCH HERE">
                        <button>
                            <div style="background-image: url(uploads/search.png);
                                        width: 28px;
                                        height: 28px;
                                        background-position: center;
                                        background-size: contain;
                                        background-repeat: no-repeat;
                            "></div>
                        </button>
                    </form>
                    <div class="signup">
                        @auth
                            <button class="btn btn-primary">
                                <a class="text-light text-decoration-none" href="{{ route('logout') }}">Logout</a>
                            </button>
                        @else
                            <button class="btn btn-primary">
                                <a class="text-light text-decoration-none" href="{{ route('login') }}">Sign In</a>
                            </button>
                            <button class="btn btn-danger">
                                <a class="text-light text-decoration-none" href="{{ route('register') }}">Sign Up</a>
                            </button>
                        @endauth
                    </div>
                </div>

            </div>
        </header>
        @yield('content')
        <footer>
            <span>
                AllRight Recieved @ 2023
            </span>
        </footer>

    </body>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js') }}"></script>
</html>
