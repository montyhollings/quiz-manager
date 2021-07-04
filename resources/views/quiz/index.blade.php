@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-8 offset-2">
            <div class="card" >
                <div class="card-header">
                    <h4>Quizzes</h4>
                </div>
                <div class="card-body" >
                    @if(count($quizzes) > 0)
                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Quiz Name</th>
                                    <th>Created By</th>
                                    <th></th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>{{$quiz->name}}</td>
                                        <td>{{$quiz->createdby->name}}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a href="{{route('quizzes.take.init', [$quiz->id])}}" class="dropdown-item">Take Quiz</a>
                                                    <a href="{{route('quizzes.take.view_attempts', [$quiz->id])}}" class="dropdown-item">View Attempts</a>
                                                    @if(Auth::user()->can_view)
                                                        <a href="{{route('quizzes.view', [$quiz->id])}}" class="dropdown-item">View Quiz</a>
                                                    @endif
                                                    @if(Auth::user()->can_edit)
                                                        <a href="{{route('quizzes.edit', [$quiz->id])}}" class="dropdown-item">Edit</a>
                                                        <a href="{{route('quizzes.delete', [$quiz->id])}}" class="dropdown-item">Delete</a>
                                                    @endif
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    @else
                        <div class="alert alert-info"> No Quizzes found @if(Auth::user()->can_edit), try <a href="{{route('quizzes.create')}}" class="btn btn-success ml-2">Creating A New Quiz </a> @endif </div>
                    @endif

                </div>

                @if(count($quizzes) > 0 && Auth::user()->can_edit)
                    <div class="card-footer">

                        <a href="{{route('quizzes.create')}}" class="btn btn-success float-right"> New Quiz </a>

                    </div>
                @endif

            </div>
        </div>
    </div>



@endsection
@section('custom_javascript')
    <script>
        $(document).ready(function() {
            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "inherit" );
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "auto" );
            })
        });


    </script>
@endsection
