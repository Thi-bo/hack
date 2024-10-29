<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hack CTF - Leaderboard</title>

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap4-neon-glow.min.css') }}">
    <link rel="stylesheet" href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .stats-card {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .category-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            margin: 2px;
            display: inline-block;
        }

        .achievement-badge {
            background: linear-gradient(45deg, #FF6B6B, #4ECDC4);
            padding: 5px 15px;
            border-radius: 20px;
            margin: 5px;
            font-size: 0.9em;
        }

        .top-3 {
            position: relative;
            padding-top: 20px;
        }

        .rank-1 { transform: scale(1.1); }
        .rank-2 { transform: scale(1.05); }
        .rank-3 { transform: scale(1.02); }

        .progress {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
        }

        .table-hover tbody tr:hover {
            background: rgba(73, 255, 160, 0.1);
        }

        .glitch__img {
            background: url('path/to/your/background.jpg') no-repeat 50% 0;
            background-size: cover;
        }
    </style>
</head>

<body class="imgloaded">
    <!-- Glitch Effect -->
    <div class="glitch">
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
    </div>

    <!-- Navigation -->
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                <a href="{{ route('welcome') }}" class="pl-md-0 p-3 text-decoration-none text-light">
                    <h3 class="bold"><span class="color_danger">HACK</span><span class="color_white">CTF</span></h3>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a href="{{ route('welcome') }}" class="p-3 text-decoration-none text-white bold">Home</a>
                        <a href="{{ route('about') }}" class="p-3 text-decoration-none text-light bold">About</a>
                        <a href="{{route('questions')}}" class="p-3 text-decoration-none text-light bold">Challenges</a>
                        <a href="{{route('writeups')}}" class="p-3 text-decoration-none text-light bold">Writeups</a>
                        <a class="p-3 text-decoration-none text-light bold" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <!-- Header -->
            <div class="row">
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center">
                        <span class="color_danger">HACKER</span>BOARD<span class="vim-caret">&nbsp;</span>
                    </h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        Where legends are born and rankings are earned!
                    </p>
                </div>
            </div>

            <!-- Global Stats Cards -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <h4 class="text-info">Total Players</h4>
                        <h2 class="mb-0">{{ count($sortedUsers) }}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <h4 class="text-success">Total Challenges</h4>
                        <h2 class="mb-0">{{ $totalChallenges ?? 0 }}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <h4 class="text-warning">Total Points</h4>
                        <h2 class="mb-0">{{ $totalPoints ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <!-- Score Distribution Chart -->
            <div class="row justify-content-center my-5">
                <div class="col-xl-10">
                    <div class="card bg-dark">
                        <div class="card-header">
                            <h4 class="text-white mb-0">Score Distribution</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="scoresChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leaderboard Table -->
            <div class="row mt-5 justify-content-center">
                <div class="col-xl-10">
                    <div class="card bg-dark">
                        <div class="card-header">
                            <h4 class="text-white mb-0">Global Rankings</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped">
                                <thead class="thead-dark hackerFont">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Challenges Solved</th>
                                        {{-- <th>Categories Mastered</th> --}}
                                        <th>Last Submission</th>
                                        <th>Score</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sortedUsers as $index => $userData)
                                    <tr class="@if($index < 3) rank-{{$index + 1}} @endif">
                                        <th scope="row">
                                            @if($index < 3)
                                                <span class="badge badge-{{ ['warning', 'light', 'danger'][$index] }}">
                                                    {{ $index + 1 }}
                                                </span>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </th>
                                        <td>
                                            {{ $userData->user->name }}
                                            @if($userData->score >= 1000)
                                                <span class="badge badge-success">Elite</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $userData->totlesub }}
                                            <div class="progress">
                                                <div class="progress-bar bg-success"
                                                     style="width: {{ ($userData->totlesub / ($totalChallenges ?? 1)) * 100 }}%">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            @foreach($userData->mastered_categories ?? [] as $category)
                                                <span class="category-badge"
                                                      style="background: {{ $categoryColors[$category] ?? '#666' }}">
                                                    {{ $category }}
                                                </span>
                                            @endforeach
                                        </td> --}}
                                        <td>{{ $userData->last_sub_time }}</td>
                                        <td>
                                            <strong class="text-success">{{ $userData->score }}</strong>
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info"
                                                     style="width: {{ ($userData->score / ($maxScore ?? 1)) * 100 }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            const ctx = document.getElementById('scoresChart').getContext('2d');

            const labels = <?= json_encode($chartData['labels']) ?>;
            const data = <?= json_encode($chartData['data']) ?>;

            // Créer un gradient pour les barres
            const gradients = data.map(() => {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(73, 255, 160, 0.8)');
                gradient.addColorStop(1, 'rgba(73, 255, 160, 0.2)');
                return gradient;
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Player Scores',
                        data: data,
                        backgroundColor: gradients,
                        borderColor: 'rgba(73, 255, 160, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        barPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        });
    </script>
</body>
</html>
