{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hack CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap4-neon-glow.min.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
    </div>
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a href="index.html" class="pl-md-0 p-3 text-decoration-none text-light">
                            <h3 class="bold"><span class="color_danger">Hack</span><span
                                    class="color_white">CTF</span></h3>
                        </a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a href="{{ route('welcome') }}" class="p-3 text-decoration-none text-white bold">Home</a>
                            <a   href="{{ route('about') }}"  class="p-3 text-decoration-none text-light bold">About</a>
                        <a href="{{ route('leaderboard') }}"
                            class="p-3 text-decoration-none text-light bold">Hackerboard</a>
                        <a href="{{ route('login') }} "class="p-3 text-decoration-none text-light bold">Login</a>
                        <a href="{{ route('register') }} "class="p-3 text-decoration-none text-light bold">Register</a>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-10">
                        <h1 class="display-1 bold color_white content__title">HACK CTF<span
                                class="vim-caret">&nbsp;</span></h1>
                        <p class="text-grey text-spacey hackerFont lead mb-5">
                            Join the community and be part of the future of the information security industry.
                        </p>
                        <div class="row  hackerFont">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <input type="text" class="form-control" id="reciept_id" placeholder="RecieptId(ex. EINC-5e5a93e4318db)">
                                    <small id="reciept_id_help" class="form-text text-muted">Don't have reciept id? Register <a target="_blank" href="http://pictinc.org/subevents_register/online/index1.php">here</a></small>
                                </div> --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" placeholder="Hacktivits"
                                        type="text" name="name" :value="old('name')" required autofocus
                                        autocomplete="name">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="email"
                                        placeholder="hack@gmail.com" type="email" name="email"
                                        :value="old('email')" required autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        type="password" name="password" required autocomplete="new-password">
                                    {{-- <small id="passHelp" class="form-text text-muted">Make sure nobody's behind
                                        you</small> --}}
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Password confirmation" name="password_confirmation" required
                                        autocomplete="new-password">
                                    <small id="passHelp" class="form-text text-muted">Make sure nobody's behind
                                        you</small>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="custom-control custom-checkbox my-4">
                                    <input type="checkbox" class="custom-control-input" id="solemnly-swear"
                                        name="remember">
                                    <label class="custom-control-label" for="solemnly-swear">I solemnly swear that I
                                        am
                                        up to no good.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <button class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-1 text-left typewriter"
                            onclick="window.location.href='login.html';">
                            <h4>Register</h4>
                        </button>
                        <small id="registerHelp" class="mt-2 form-text text-muted">Already Registered? <a
                                href="{{ route('login') }}">Login here</a></small>
                    </div>
                </div>
            </form>

        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>
