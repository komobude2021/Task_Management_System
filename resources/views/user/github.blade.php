@extends('user.app')

@section('title')
    Github Api
@endsection

@section('content')
    <div class="container min-content-height">
        <div class="row pd-40">
            <div class="container">
                <div class="col-md-12">
                    <h3>GitHub Public Repository</h3>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="row">

            @if ($repositories === false)

                <div class="col-md-12 alert alert-danger">
                    <h5><i class="fa fa-info-circle"></i> Failed Github API Call | Kindly Make Sure Your Github Username is Valid</h4>
                </div>

            @elseif (count($repositories) === 0)

                <div class="col-md-12 alert alert-danger">
                    <h5><i class="fa fa-info-circle"></i> Empty Record</h4>
                </div>

            @else

                @foreach ($repositories as $repository)
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3">
                                <i class="fa fa-folder-open-o fa-github"></i>
                            </div>

                            <div class="col-md-9">
                                <div>
                                    <a href="{{ $repository['html_url'] }}" target="_new">
                                        {{ $repository['name'] }}
                                    </a>
                                </div>
                                <div>
                                    {{ \Carbon\Carbon::parse($repository['created_at'])->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif

        </div>
    </div>
@endsection