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
                                                <div class="btn-group btn-group-sm" role="group" >
                                                    <a href="{{route('quizzes.questions.edit', [$Quiz->id, $question->id])}}" class="btn btn-warning">Edit</a>
                                                    <a href="{{route('quizzes.questions.delete', [$Quiz->id, $question->id])}}" class="btn btn-danger">Delete</a>
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
                <a href="{{ route('quizzes.questions.new_question', $Quiz->id) }}" class="btn btn-success float-right">New Question</a>
            </div>
        </div>
    </div>
@endsection
