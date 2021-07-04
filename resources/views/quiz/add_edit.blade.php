@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ $form_url }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @if($Quiz)
                                Edit Quiz
                            @else
                                Create Quiz
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control{{ $errors->has('name') ?? ' is-invalid' ?? '' }}" type="text" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $Quiz->name ?? null }}" required />
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control{{ $errors->has('description') ?? ' is-invalid' ?? '' }}" rows="3" id="description" name="description" placeholder="Description" required>{{ old('description') ?? $Quiz->description ?? null }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button  type="submit" class="btn btn-success float-right"> Submit</button>
                            @if($Quiz)
                                <a href="{{route('quizzes.questions.process', [$Quiz->id])}}" class="btn btn-danger "> Edit Questions</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
