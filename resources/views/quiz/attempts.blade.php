@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Attempts for : {{$Quiz->name}}
                    </div>
                    <div class="card-body">
                        @if($Quiz->attempts->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Taken At</th>
                                            <th>Taken by</th>
                                            <th>Score</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Quiz->attempts as $attempt)
                                            <tr>
                                                <td>{{$attempt->created_at_date_display}}</td>
                                                <td>{{$attempt->user->name}}</td>
                                                <td>{{$attempt->correct_questions_count}} / {{$Quiz->questions->count()}}</td>
                                                <td>
                                                    <a  class="btn btn-info" href="{{route('quizzes.take.summary', [$Quiz->id, $attempt->id])}}">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No Attempts Found
                            </div>
                        @endif

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('quizzes.index') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
