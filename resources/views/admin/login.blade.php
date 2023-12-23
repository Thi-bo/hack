
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.login') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email"
                                                    placeholder="hack@gmail.com" type="email" name="email"
                                                    :value="old('email')" required autofocus autocomplete="username">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="form-group mt-3">
                                                <input type="password" class="form-control" id="password" placeholder="Password"
                                                    id="password" name="password" required autocomplete="current-password">

                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="form-check mb-3 mt-2">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" name="remember" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                                                
                                                <button class="btn btn-primary"  type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Hacktivists 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    </body>
</html>
