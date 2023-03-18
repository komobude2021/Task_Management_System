@extends('app')

@section('title')
    Register | Task Management System
@endsection

@section('header-extra')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container register-header">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="images/task_icon_.webp" class="home-task-img" alt="Task Management System" />
            </div>

            <div class="col-md-8">
                <form action="" method="POST" name="form1" id="form1" autocomplete="off">
                    @csrf

                    <div class="form-row">
                        @include('displayValidationError')
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Firstname <span class="req">*</span></label>
                            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Lastname <span class="req">*</span></label>
                            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email <span class="req">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Password <span class="req">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <div id="password_text" class="password hide_">
                                <span><i class="fa fa-info-circle"></i> Password Must Be 8 character, Must Contain Uppercase, Lowercase, Number and Symbol</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Re-Type Password <span class="req">*</span></label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Github Username</label>
                            <input type="text" class="form-control" name="github_username" value="{{ old('github_username') }}" placeholder="Github Username">
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary max-weight">
                            <i class="fa fa-sign-in"></i> Register
                        </button>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                            <a href="{{ route('login') }}" class="no-account">
                                Already Have An Account? <i class="fa fa-lock"></i>Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#password").click(function(){
                $("#password_text").show();
            });

            $("#password").keyup(function(){
                $("#password_text").show();
            });
        });
    </script>

@endsection