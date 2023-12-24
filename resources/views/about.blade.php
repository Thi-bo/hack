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

<body class="imgloaded">
    <div class="glitch">
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
        <div style="position: fixed;" class="glitch__img"></div>
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
                        <a href="{{ route('welcome') }}" class="pl-md-0 p-3 text-decoration-none text-light">
                            <h3 class="bold"><span class="color_danger">HACK</span><span
                                    class="color_white">CTF</span></h3>
                        </a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a href="{{ route('welcome') }}" class="p-3 text-decoration-none text-white bold">Home</a>
                        <a href="{{ route('about') }}" class="p-3 text-decoration-none text-light bold">About</a>
                        <a href="{{ route('leaderboard') }}"
                            class="p-3 text-decoration-none text-light bold">Hackerboard</a>
                        <a href="{{ route('questions') }}"
                            class="p-3 text-decoration-none text-light bold">Challenges</a>

                        <a href="{{ route('login') }} "class="p-3 text-decoration-none text-light bold">Login</a>
                        <a href="{{ route('register') }} "class="p-3 text-decoration-none text-light bold">Register</a>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span
                            class="color_danger">ABOUT</span>US<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey text-center hackerFont lead">
                        A community of like minded individuals who support cybersecurity and FOSS.
                    </p>
                    <div class="row justify-content-center hackerFont">

                        <div class="col-md-8">
                            <h5 class="bold color_white pt-3">
                                🎄 *Join the festive spirit of hacking with H4CKT1V1STS!* 🎄
                            </h5>
                            Challenge seekers,
                            cybersecurity enthusiasts and curious minds, prepare
                            for a unique experience this holiday season. From December 23 to 28,
                            the H4CKT1V1STS group invites you to an exceptional technological celebration:
                            the CTF Christmas Hacking.

                            <h5 class="bold color_white pt-3">
                                🌐 **What is Christmas Hacking CTF?
                            </h5>
                            Christmas Hacking CTF isn't just a competition, it's an adventure
                            where curiosity and creativity are the keys to success. Every day,
                            immerse yourself in captivating training sessions to sharpen your IT
                            security skills. Evenings will be reserved for hacking competitions,
                            putting your knowledge and technical agility to the test.

                            <h5 class="bold color_white pt-3">
                                What is Capture the Flag?
                            </h5>
                            A capture the flag (CTF) contest is a special kind of cybersecurity competition designed to
                            challenge its participants to solve computer security problems and/or capture and defend
                            computer systems. The game consists of a series of challenges where participants
                            must reverse engineer, break, hack, decrypt, or do whatever it takes to solve the challenge.
                            The challenges are all set up with the intent of being hacked, making it an excellent, legal
                            way to get hands-on experience.
                            <h5 class="bold color_white pt-3">
                                🚀 *Why participate?*
                            </h5>

                            1. *Develop your skills:* Take advantage of expert-led training sessions to acquire new
                            skills and deepen your knowledge of cybersecurity. <br>

                            2. *Challenge yourself:* Hacking competitions each evening will offer stimulating
                            challenges, testing your ability to solve problems and think creatively. <br>

                            3. *Connect with the community:* Meet like-minded enthusiasts, exchange tips, and build
                            valuable connections with other cybersecurity experts. <br>

                            4. *Win exclusive prizes:* The most talented participants will have the chance to win
                            exceptional prizes and recognition within the community. <br>

                            <h5 class="bold color_white pt-3">
                                🎁 *How to take part?*
                            </h5>

                            Join us from December 23 to 28 on the platform dedicated to CTF Christmas Hacking. Register,
                            learn, challenge yourself and celebrate the magic of hacking this festive season. <br>

                            🚩 Flags format: We love diversity, but to ensure a fair competition, make sure your flags
                            follow the standard format: flag{xxxxxxxxxxxxxxxxx}. <br>

                            🔒 *Wait no longer, take up the challenge and be part of the CTF Christmas Hacking adventure
                            with H4CKT1V1STS! 🔒*
                            (ZmxhZ3tDaHIxc3RtNHNfaDRjazFuZ19DN0Z9) <br>
                            #ChristmasHackingCTF #H4CKT1V1STS #CybersecurityChallenge #HackTheHolidays
                            <div class="row text-center pt-5">
                                <div class="col-xl-12">
                                    <a href="{{ route('welcome') }}"><button
                                            class="btn btn-outline-danger btn-shadow px-3my-2 ml-0 ml-sm-1 text-left typewriter">
                                            <h4>LET IT RIP!</h4>
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
