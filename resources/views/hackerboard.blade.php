<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hack CTF</title>



    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap4-neon-glow.min.css') }}">

    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
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
                        <a href="{{route('leaderboard')}}" class="p-3 text-decoration-none text-light bold">Hackerboard</a>
                        <a href="{{route('questions')}}" class="p-3 text-decoration-none text-light bold">Challenges</a>

                        <a class="p-3 text-decoration-none text-light bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                        </a>

                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">HACKER</span>BOARD<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        Where the world get's ranked!
                    </p>
                    <div class="row justify-content-center my-5">
                        <div class="col-xl-10">
                            <canvas id="scoresChart" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Challenges Solved</th>
                                <th>Last Submission</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sortedUsers as $index => $userData)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $userData->user->name  }}</td>
                                <td>{{ $userData->totlesub }}</td>
                                <td>{{ $userData->last_sub_time }}</td>
                                <td>{{ $userData->score }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('scoresChart').getContext('2d');

            var data = {
                labels: <?= json_encode($chartData['labels']) ?>,
                datasets: [{
                    label: 'Scores',
                    data: <?= json_encode($chartData['data']) ?>,
                    backgroundColor: getGradientColors(<?= count($chartData['labels']) ?>),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            var scoresChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options,
                plugins: [{
                    afterLayout: function(chart) {
                        // Réduire la largeur des barres (ajuster la valeur 0.1 selon vos besoins)
                        chart.data.datasets.forEach(function(dataset) {
                            dataset.barPercentage = 0.1;
                        });
                    }
                }]
            });
        });

        // Fonction pour générer des couleurs dégradées
        function getGradientColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        // Fonction pour générer une couleur aléatoire
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>




</body>

</html>