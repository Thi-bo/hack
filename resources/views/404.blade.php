<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hack CTF</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap4-neon-glow.min.css') }}">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">


</head>

<body class="imgloaded" style="background-color:#0b120d!important;">
    <div class="glitch">
        <div class="glitch__img glitch__img_404"></div>
        <div class="glitch__img glitch__img_404"></div>
        <div class="glitch__img glitch__img_404"></div>
        <div class="glitch__img glitch__img_404"></div>
        <div class="glitch__img glitch__img_404"></div>
    </div>
    <div class="navbar-dark text-white">
            <div class="container">
                <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a href="{{ route('welcome') }}" class="pl-md-0 p-3 text-decoration-none text-light">
                                <h3 class="bold"><span class="color_danger">HACK</span><span class="color_white">CTF</span></h3>
                            </a>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <a href="{{ route('welcome') }}" class="p-3 text-decoration-none text-white bold">Home</a>
                            <a   href="{{ route('about') }}"  class="p-3 text-decoration-none text-light bold">About</a>
                            <a href="{{route('leaderboard')}}"  class="p-3 text-decoration-none text-light bold">Hackerboard</a>
                                                        <a href="{{route('questions')}}"  class="p-3 text-decoration-none text-light bold">Challenges</a>

                           <a href="{{route('login')}} "class="p-3 text-decoration-none text-light bold">Login</a>
                            <a href="{{route('register')}} "class="p-3 text-decoration-none text-light bold">Register</a>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
    <div class="jumbotron bg-transparent mb-0 pt-5 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 text-center">
                    <h1 style="background-color:#000000A4;" class="py-5 display-1 bold color_white content__title">404 N07 F0UND<span class="vim-caret">&nbsp;</span></h1>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>