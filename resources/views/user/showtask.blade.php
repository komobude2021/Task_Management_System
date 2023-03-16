@extends('user.app')

@section('title')
    View Task
@endsection

@section('content')
    <div class="container min-content-height">
        <div class="row pd-40">
            <div class="container">
                <div class="col-md-12">
                    <h3>Add New Task</h3>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><b>{{ $singleTask->title }}</b></h3>
            </div>

            <div class="col-md-12">
                <hr/>
            </div>

            <div class="col-md-12">
                <h3>{{ $singleTask->description }}</h3>
            </div>

            <div class="col-md-12">
                <hr/>
            </div>

            <div class="col-md-12">
                {{ \Carbon\Carbon::parse($singleTask->created_at->diffForHumans())->diffForHumans() }}
            </div>

        </div>
    </div>
@endsection