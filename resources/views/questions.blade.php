<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hack CTF</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap4-neon-glow.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">


</head>

<body>
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
                        {{-- <a href="{{route('leaderboard')}}" class="p-3 text-decoration-none text-light bold">Hackerboard</a> --}}

                        <a href="{{route('questions')}}" class="p-3 text-decoration-none text-light bold">Challenges</a>
                        <a href="{{route('writeups')}}"  class="p-3 text-decoration-none text-light bold">Writeups</a>

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

    <div class="jumbotron bg-transparent mb-0 pt-0 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12  text-center">
                    <h1 class="display-1 bold color_white content__title">QUESTS<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Its time to show the world what you can do!
                    </p>
                    @if(session('status') == 'success')
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @elseif(session('status') == 'warning')
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @elseif(session('status') == 'error')
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row hackerFont">
                <div class="col-md-12">
                    <h4>Challenges</h4>
                </div>
                @foreach ($questions as $question)
                <div class="col-md-4 mb-3">
                    <div class="card category_web">
                        <div class="card-header solved" data-target="#problem_id_{{ $question->id }}" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_{{ $question->id }}">
                            {{ $question->titre }}

                            @php
                            $userProfileId = Auth::user()->userProfile->id;
                            $solvedSubmissionsCount = $question->submissions
                            ->where('user_id', $userProfileId)
                            ->where('solved', 1)
                            ->count();
                            @endphp

                            @if($solvedSubmissionsCount > 0)
                            <span class="badge">Solved </span>
                            @endif
                            <span class="badge" style="background-color:#ef1d9b94">{{ $question->points }} points</span>
                            @php
                            $colors = ['#ef121b94', '#007bff94', '#28a74594', '#ffc10794', '#17a2b894', '#dc354594'];
                            $randomColor = $colors[array_rand($colors)];
                            @endphp

                            <span class="badge" style="background-color:{{ $randomColor }}">{{ $question->category }}</span>
                        </div>
                        <div id="problem_id_{{ $question->id }}" class="collapse card-body">
                            <blockquote class="card-blockquote">
                                <div style="display: flex;">
                                    <!-- Ajoutez le reste de vos informations à partir de $question ici -->
                                    <h3 class="solvers">Solvers: <span class="solver_num">{{ $question->solved_by }}</span>
                                </div>
                                <p>{{ $question->description }}</p>
                                <a href="{{ route('download.file', ['questionId' => $question->id]) }}" class="btn btn-outline-secondary btn-shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    <span class="text-overflow">{{ Str::limit($question->file, 5) }}</span>

                                </a>


                                <a href="#" data-toggle="modal" data-target="#hint" data-cout="{{ $question->hint_point }}" title="Cliquez pour afficher l'indice" data-id="{{ $question->id }}" class="btn btn-outline-secondary hint-button btn-shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-lightbulb" viewBox="0 0 16 16">
                                        <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1" />
                                    </svg></span>Hint<span class="badge" style="background-color:#f9aa1594">- {{ $question->hint_point }}</span>
                                </a>

                                <form method="post" action="{{ route('check_flag') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mt-3">
                                        <input name="Qid" type="hidden" class="form-control" value="{{ $question->id }}">

                                        <input name="flag" type="text" class="form-control" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary">Go!</button>
                                        </div>
                                    </div>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Ajoutez ce code à la fin de votre vue pour afficher le modal -->
                <div class="modal fade" id="hint" tabindex="-1" role="dialog" aria-labelledby="hint label" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div id="hintContent"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row hackerFont justify-content-center mt-5">
                <div class="col-md-12">

                    <br><br>Challenge Types:
                    <span class="p-1" style="background-color:#ef121b94">Web</span>
                    <span class="p-1" style="background-color:#17b06b94">Reversing</span>
                    <span class="p-1" style="background-color:#f9751594">Steganography</span>
                    <span class="p-1" style="background-color:#36a2eb94">Pwning</span>
                    <span class="p-1" style="background-color:#9966FF94">Cryptography</span>
                    <span class="p-1" style="background-color:#ffce5694">Other</span>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Dans votre fichier Blade, ajoutez ceci à l'intérieur de la section script -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Dans votre section script -->


        <script>
            $(document).ready(function() {
                $('.hint-button').click(function() {
                    var questionId = $(this).data('id');
                    var hintCout = $(this).data('cout'); // Assurez-vous d'avoir l'attribut data-hint-cout dans votre HTML

                    // Demander confirmation à l'utilisateur avec le coût de l'indice
                    var confirmHint = window.confirm('Êtes-vous sûr de vouloir afficher l\'indice ? Le coût du hint sera de ' + hintCout + ' points.');

                    // Si l'utilisateur confirme
                    if (confirmHint) {
                        // Stocker une référence au modal
                        var hintModal = $('#hint');

                        // Exécuter la requête AJAX
                        $.ajax({
                            url: '/get-hint',
                            method: 'GET',
                            data: {
                                id: questionId
                            },
                            success: function(response) {

                                // Mettre à jour le contenu du modal avec l'indice
                                $('#hintContent').text(response.hint);

                                // Afficher le modal
                                hintModal.modal('show');
                            },
                            error: function(error) {
                                console.log('Erreur lors de la requête AJAX : ', error);
                            }
                        });
                    }
                });
            });
        </script>



</body>

</html>
