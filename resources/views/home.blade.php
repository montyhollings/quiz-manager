@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Recent Results
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time Taken</th>
                                        <th>Score</th>
                                        <th>User</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($recent_attempts as $result)
                                    <tr>
                                        <td>{{$result->time_taken}}</td>
                                        <td>{{$result->correct_questions_count}} / {{$result->quiz->questions->count()}}</td>
                                        <td>{{$result->user->name}}</td>
                                        <td><a href="{{route('quizzes.take.summary', [$result->quiz->id, $result->id])}}" class="btn btn-sm btn-primary">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
