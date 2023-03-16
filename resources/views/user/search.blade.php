@extends('user.app')

@section('title')
    Search Tasks Result
@endsection

@section('content')
    <div class="container min-content-height">
        <div class="row pd-40">
            <div class="container">
                <div class="col-md-12">
                    <h3>Search Tasks Result</h3>
                    <hr/>
                </div>
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

                        @if ($result->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="col-md-12 alert alert-danger">
                                        <h5><i class="fa fa-info-circle"></i> No Task Search Record Found</h4>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @php $i = 1; @endphp
                            @foreach ($result as $task)
                                <tr>
                                    <td>{{ $i }}.</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ substr($task->description, 0, 80) }}</td>
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
                                        <a href="{{ route('user.task.show', [$task->id]) }}" target="_new">
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
                                            <button type="submit" onclick="return confirm('Are You Sure You Want To Delete This Task?')" class="btn btn-sm btn-danger">
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

        <div class="row">
            <div class="col-md-12" style="padding-top:12px">
                @if (!$result->isEmpty())
                    {{ $result->links() }}
                @endif
            </div>
        </div>

        </div>
    </div>
@endsection