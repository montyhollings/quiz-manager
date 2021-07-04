@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Questions for : {{$Quiz->name}}
                </div>
                <div class="card-body">
                    @if($Quiz->questions->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Number of Answers</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($Quiz->questions as $question)
                                        <tr>
                                            <td>{{$question->order}}</td>
                                            <td>{{$question->question}}</td>
                                            <td>{{$question->answers->count() ?? 0}}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Options
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a href="{{route('quizzes.questions.view', [$Quiz->id, $question->id])}}" class="dropdown-item">View</a>

                                                    @if(Auth::user()->can_edit)
                                                            <a href="{{route('quizzes.questions.edit', [$Quiz->id, $question->id])}}" class="dropdown-item">Edit</a>
                                                            <a href="{{route('quizzes.questions.delete', [$Quiz->id, $question->id])}}" class="dropdown-item">Delete</a>
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
                        <div class="alert alert-info">No Questions Found</div>
                    @endif
                </div>



            <div class="card-footer">
                <a href="{{ route('quizzes.edit', [$Quiz->id]) }}" class="btn btn-warning">Back</a>
                @if(Auth::user()->can_edit)
                    <a href="{{ route('quizzes.questions.new_question', $Quiz->id) }}" class="btn btn-success float-right">New Question</a>
                @endif
            </div>
        </div>
    </div>
@endsection
