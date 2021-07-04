@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Start Quiz : {{ $Quiz->name }}
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">
                            This Quiz has <strong>{{ $Quiz->Questions->count() }}</strong> Questions.
                        </p>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="btn btn-warning">Back</a>
                        <a href="{{ route('quizzes.take.submit_init', $Quiz->id) }}" class="@if($Quiz->Questions->count() == 0) disabled @endif btn btn-success float-right">Start Quiz</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
