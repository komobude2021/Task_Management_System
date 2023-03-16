@extends('user.app')

@section('title')
    Tasks
@endsection

@section('content')
    <div class="container min-content-height">
        <div class="row pd-40">
            <div class="container">
                <div class="col-md-12">
                    <h3>All Tasks</h3>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-md-9 text-right">
                <a href="{{ route('user.task.create') }}" class="btn btn-outline-info">Add New Task</a>
            </div>
        </div>

        <div class="row" style="padding-top:10px">
            @include('displayFlashSessionMessage')
            @include('displayValidationError')
        </div>
            
        <div class="row">
            <div class="col-md-12 task-top">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" width="6%">#</th>
                            <th scope="col" width="22%">Title</th>
                            <th scope="col" width="32%">Description</th>
                            <th scope="col" width="15%">Completed</th>
                            <th scope="col" colspan="4"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($paginatedTasks->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="col-md-12 alert alert-danger">
                                        <h5><i class="fa fa-info-circle"></i> No Task Record Found</h4>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @php $i = 1; @endphp
                            @foreach ($paginatedTasks as $task)
                                <tr>
                                    <td>{{ $i }}.</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ substr($task->description, 0, 50) }}</td>
                                    <td>
                                        @if($task->completed == 0)
                                            <span class="pending">Pending</span>
                                        @else
                                            <span class="completed">Completed</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($task->completed == 0)
                                            <form action="{{ route('user.task.completed') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="task" value="{{ $task->id }}">
                                                <button type="submit" class="btn btn-sm btn-info">completed</button>
                                            </form>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('user.task.show', [$task->id]) }}">
                                            <i class="fa fa-search task-fa-listing"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.task.edit', [$task->id]) }}">
                                            <i class="fa fa-edit task-fa-listing"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.task.destroy', [$task->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-o task-fa-listing_"></i>
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        
                        @endif

                    </tbody>
                  </table>
            </div>
        </div>

        </div>
    </div>
@endsection