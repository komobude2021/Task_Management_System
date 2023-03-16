<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <title>{{ ucwords(Auth::user()->firstname . " " . Auth::user()->lastname) }} | @yield('title')</title>
        @yield('header-extra')
    </head>

    <body>
        <div class="container-fluid">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">

                    <a class="navbar-brand" href="#">Task Management System</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto" style="margin-right:20px">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.home') }}">User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.task.index') }}">Task</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.github') }}">Github</a>
                            </li>
                            <form action="{{ route('user.logout') }}" method="POST" name="forma" id="forma">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger my-2 my-sm-0">Logout</button>
                            </form>
                        </ul>

                        <form action="{{ route('user.search') }}" method="GET" name="formb" id="formb" class="form-inline my-2 my-lg-0" autocomplete="off">
                            <input class="form-control mr-sm-2" name="search" placeholder="Task Search..." required>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')

        <div class="container">
            <div class="row">
                <div class="col-md-12 footer_">
                    <hr/>
                    Sample Project &copy;2023
                </div>
            </div>
        </div>

        @yield('footer-extra')
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    </body>
</html>