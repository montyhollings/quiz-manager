@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4>Quizzes</h4>
                </div>
                <div class="card-body">
                    @if(count($quizzes) > 0)
                        <div class="table-responsive">
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
                                            <div class="btn-group btn-group-sm" role="group" >
                                                <button type="button" class="btn btn-success btn-group-sm">View</button>
                                                <a href="{{route('quizzes.edit', [$quiz->id])}}" class="btn btn-warning">Edit</a>
                                                <a href="{{route('quizzes.delete', [$quiz->id])}}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    @else
                        <div class="alert alert-info"> No Quizzes found, try <a href="{{route('quizzes.create')}}" class="btn btn-success ml-2">Creating A New Quiz </a> </div>
                    @endif

                </div>
                @if(count($quizzes) > 0)
                    <div class="card-footer">
                        <a href="{{route('quizzes.create')}}" class="btn btn-success float-right"> New Quiz </a>
                    </div>
                @endif

            </div>
        </div>
    </div>



@endsection
