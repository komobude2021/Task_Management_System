@extends('user.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="container min-content-height">
        <div class="row pd-40">
            <div class="container">
                <div class="col-md-12">
                    <h3>User Information</h3>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <i class="fa fa-user-circle-o fa-user"></i>
            </div>

            <div class="col-md-8">

                <form action="" method="POST" name="form1" id="form1" autocomplete="off">
                    @csrf

                    <div class="form-row">
                        @include('displayValidationError')
                        @include('displayFlashSessionMessage')
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Firstname</label>
                            <input type="text" class="form-control" disabled value="{{ ucwords($user->firstname) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Lastname</label>
                            <input type="text" class="form-control" disabled value="{{ ucwords($user->lastname) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" class="form-control" disabled value="{{ $user->email }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Github Username</label>
                            <input type="text" class="form-control" name="github_username" value="{{ $user->github_username }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary max-weight"><i class="fa fa-edit"></i> Update Personal Record</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection