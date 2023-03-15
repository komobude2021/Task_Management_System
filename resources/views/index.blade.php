@extends('app')

@section('title')
    Home | Task Management System
@endsection

@section('header-extra')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 home-task">
                <img src="images/task_icon_.webp" class="home-task-img" alt="Task Management System" />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('loginSubmit') }}" method="post" name="form1" id="form1" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        @include('displayValidationError')
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group no-account">
                        <label class="form-check-label">
                            <a href="{{ route('register') }}">Don't Have An Account?</a>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary max-weight">
                            <i class="fa fa-lock"></i> Login
                        </button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection