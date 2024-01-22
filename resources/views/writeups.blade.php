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
                        {{-- <a href="{{route('leaderboard')}}"  class="p-3 text-decoration-none text-light bold">Hackerboard</a> --}}
                        <a href="{{ route('questions') }}"
                            class="p-3 text-decoration-none text-light bold">Challenges</a>
                        <a href="{{ route('writeups') }}" class="p-3 text-decoration-none text-light bold">Writeups</a>

                        <a href="{{ route('login') }} "class="p-3 text-decoration-none text-light bold">Login</a>
                        {{-- <a href="{{route('register')}} "class="p-3 text-decoration-none text-light bold">Register</a> --}}
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row hackerFont">
                <div class="col-xl-8">
                    <h1 class="display-1 bold color_white content__title mb-4">WRITEUPS<span
                            class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-4">
                        Parlez nous de votre expérience!
                    </p>
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>

                    @endif
                    <form method="post" action="{{ route('uploadWriteups') }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="easeOfAccess">Facilité d'accés?</label>
                                <select class="custom-select d-block w-100 @error('faciliteAcces') is-invalid @enderror"
                                    value="{{ old('faciliteAcces') }}" id="easeOfAccess" name="faciliteAcces">
                                    <option value="">Sélectionnez la note</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Moyenne">Moyenne</option>
                                    <option value="Pauvre">Pauvre</option>
                                    <option value="N/A">N/A</option>
                                </select>
                                @error('faciliteAcces')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>
                            <div class="col-md-6">
                                <label for="interface">Comment était l’interface utilisateur ?</label>
                                <select
                                    class="custom-select d-block w-100 @error('interfaceUtilisateur') is-invalid @enderror"
                                    id="interface" name="interfaceUtilisateur"
                                    value="{{ old('interfaceUtilisateur') }}">
                                    <option value="">Sélectionnez la note</option>
                                    <option value="Facile à comprendre">Facile à comprendre</option>
                                    <option value="Juste à droite">Juste à droite</option>
                                    <option value="Difficile de s'y retrouver">Difficile de s'y retrouver</option>
                                </select>
                                @error('interfaceUtilisateur')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="rateQuestions">Comment évalueriez-vous les questions ?</label>
                                <select class="custom-select d-block w-100  @error('noteQuestion') is-invalid @enderror"
                                    id="rateQuestions" name="noteQuestion" value="{{ old('noteQuestion') }}">
                                    <option value="">Sélectionner une note</option>
                                    <option value="Facile à résoudre">Facile à résoudre</option>
                                    <option value="Juste ce qu'il faut">Juste ce qu'il faut</option>
                                    <option value="Difficile à résoudre">Difficile à résoudre</option>
                                    <option>Difficile de déchiffrer les questions</option>
                                </select>
                                @error('noteQuestion')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>
                            <div class="col-md-6">
                                <label for="cluesHints">Comment évalueriez-vous les indices/indices ?</label>
                                <select class="custom-select d-block w-100  @error('noteIndice') is-invalid @enderror"
                                    id="cluesHints" name="noteIndice" value="{{ old('noteIndice') }}">
                                    <option value="">Sélectionner une note</option>
                                    <option>Facile à comprendre</option>
                                    <option>Rend les questions trop faciles</option>
                                    <option>Juste ce qu'il faut</option>
                                    <option>N'a pas aidé</option>
                                </select>
                                @error('noteIndice')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">Avez-vous apprécié votre expérience ?</div>
                            <div class="col-md-6">
                                <div class="btn-group w-100" role="group"
                                    aria-label="Did you enjoy your experience?">
                                    <input type="radio" id="experience-yes" name="experienceUtilisateur"
                                        class="toggle @error('experience') is-invalid @enderror">
                                    <label for="experience-yes" class="btn btn-outline-primary toggle-yes"
                                        name="experienceUtilisateur" value="Oui">Oui</label>
                                    <input type="radio" id="experience-no" name="experienceUtilisateur"
                                        class="toggle @error('experience') is-invalid @enderror"
                                        name="experienceUtilisateur" value="Non">
                                    <label for="experience-no" class="btn btn-outline-primary toggle-no">Non</label>
                                </div>
                                @error('experience')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez sélectionner Oui/Non</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">Voudriez-vous rejouer ?</div>
                            <div class="col-md-6">
                                <div class="btn-group w-100" role="group" aria-label="Would you play again?">
                                    <input type="radio" id="playAgain-yes" name="isRejouer"
                                        class="toggle @error('isRejouer') is-invalid @enderror" name="isRejouer"
                                        value="Oui">
                                    <label for="playAgain-yes" class="btn btn-outline-primary toggle-yes">Oui</label>
                                    <input type="radio" id="playAgain-no" name="isRejouer"
                                        class="toggle @error('isRejouer') is-invalid @enderror">
                                    <label for="playAgain-no" class="btn btn-outline-primary toggle-no"
                                        name="isRejouer" value="Oui">Non</label>
                                </div>
                                @error('isRejouer')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez sélectionner Oui/Non</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">Recommanderiez-vous à d’autres ?</div>
                            <div class="col-md-6">
                                <div class="btn-group w-100" role="group"
                                    aria-label="Would you recommend to others?">
                                    <input type="radio" id="recommend-yes" name="recommandation"
                                        class="toggle @error('recommandation') is-invalid @enderror"
                                        name="recommandation" value="oui">
                                    <label for="recommend-yes" class="btn btn-outline-primary toggle-yes">Oui</label>
                                    <input type="radio" id="recommend-no" name="recommandation"
                                        class="toggle @error('recommandation') is-invalid @enderror"
                                        name="recommandation" value="non">
                                    <label for="recommend-no" class="btn btn-outline-primary toggle-no">Non</label>
                                </div>
                                @error('recommandation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez sélectionner Oui/Non</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="organizers">Dans quelle mesure les organisateurs vous ont-ils
                                    soutenu ?</label>
                                <select
                                    class="custom-select d-block w-100 @error('soutienOrganisateur') is-invalid @enderror"
                                    id="organisateurs" name="soutienOrganisateur">
                                    <option value="">Sélectionner une note</option>
                                    <option value="Très favorable">Très favorable</option>
                                    <option value="Juste ce qu'il faut">Juste ce qu'il faut</option>
                                    <option value="Pas du tout">Pas du tout</option>
                                </select>
                                @error('soutienOrganisateur')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="overallExperience">Comment évalueriez-vous votre expérience
                                    globale ?</label>
                                <select class="custom-select d-block w-100 @error('exeprienceGlobale') is-invalid @enderror" id="overallExperience"
                                    name="exeprienceGlobale">
                                    <option value="">Sélectionner une note</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Moyenne">Moyenne</option>
                                    <option value="Pauvre">Pauvre</option>
                                    <option value="N/A">N/A</option>
                                </select>
                                @error('exeprienceGlobale')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Veuillez choisir une note</div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label for="additionComments">Avez-vous rencontré des difficultés ou avez-vous
                                    des commentaires ou des questions supplémentaires ?</label>
                                <textarea type="text" rows="5" class="form-control @error('commentaires') is-invalid @enderror " id="address2" placeholder="Comments"
                                    name="commentaires"></textarea>
                            </div>
                            @error('commentaires')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label for="files">Soumettez votre writeups</label>
                                <input type="file" rows="5" class="form-control" id="files"
                                    placeholder="Soumettez votre writeups" name="writeups">
                                <div class="invalid-feedback">Veuillez choisir un fichier</div>

                            </div>
                            @error('writeups')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- <hr class="mb-4"> -->

                        <button class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-1 text-left typewriter"
                            type="submit">
                            <h4>Soumettre</h4>
                        </button>
                </div>





                </form>
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
