<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Hacktivists</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        @include('admin.layouts.navbar')
    </nav>
    <div id="layoutSidenav">
      @include('admin.layouts.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Challenges</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Challenges</li>
                    </ol>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mx-auto">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="{{ route('store.question') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre : </label>
                                    <input type="text" class="form-control" id="titre" name="titre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="points" class="form-label">Points : </label>
                                    <input type="text" class="form-control" id="points" name="points" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description :</label>
                                    <input type="text" class="form-control" id="description" name="description" required>
                                </div>

                                <div class="mb-3">
                                    <label for="level" class="form-label">Level:</label>
                                    <input type="text" class="form-control" id="level" name="level" required>
                                </div>

                                <div class="mb-3">
                                    <label for="hint" class="form-label">Hint : </label>
                                    <input type="text" class="form-control" id="hint" name="hint" required>
                                </div>

                                <div class="mb-3">
                                    <label for="hint_point" class="form-label">Hint Point :</label>
                                    <input type="text" class="form-control" id="hint_point" name="hint_point"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">Fichier:</label>
                                    <input type="file" class="form-control" id="file" name="file"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category:</label>
                                    <input type="text" class="form-control" id="category" name="category" required>
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="solved_by" class="form-label">solved_by:</label>
                                    <input type="text" class="form-control" id="solved_by" name="solved_by" required>
                                </div> --}}

                                <div class="mb-3">
                                    <label for="flag" class="form-label">Flag:</label>
                                    <input type="text" class="form-control" id="flag" name="flag" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Hacktivists 2023</div>
                        {{-- <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/datatables-simple-demo.js') }}"></script>
</body>

</html>
