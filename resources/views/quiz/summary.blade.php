@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Results for: {{$Quiz->name}}
                    </div>
                    <div class="card-body text-center">


                        <p class="lead">
                            You took {{ $QuizAttempt->time_taken }} to complete the quiz!
                        </p>

                        <p>
                            You got <strong>{{ $QuizAttempt->correct_questions_count }}</strong> out of <strong>{{ $Quiz->Questions->count() }}</strong> questions correct.
                        </p>

                        <hr />

                        <h2>Summary</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Your Answer</th>
                                    <th>Correct</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($QuizAttempt->quiz_attempt_answers as $key => $answer)
                                <tr>
                                    <td>
                                        <strong>{{ $key+1 }}.</strong>
                                    </td>
                                    <td>
                                        {{ $answer->question->question }}
                                    </td>
                                    <td>
                                       {{ $answer->answer->answer }}
                                    </td>
                                    <td>
                                        @if($answer->answer->correct)
                                            <div class="alert alert-success "> Correct</div>
                                        @else
                                            <div class="alert alert-danger"> Incorrect</div>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
