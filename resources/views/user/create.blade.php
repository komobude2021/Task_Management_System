@extends('user.app')

@section('title')
    Add New Task
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
            @include('displayFlashSessionMessage')
            @include('displayValidationError')
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('user.task.store') }}" method="POST" name="form1" id="form1" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Task Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title.." required>
                    </div>

                    <div class="form-group">
                        <label>Task Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Task Status</label>
                        <select class="form-control" name="completed" id="completed" required>
                            <option value="">Select Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>

                    <div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary max-weight"><i class="fa fa-plus"></i> Add New Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection