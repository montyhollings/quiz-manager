@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ $form_url }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @if($view)
                                View Quiz
                            @elseif($Quiz)
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
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} "{{$view ? 'readonly' : ''}} type="text" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $Quiz->name ?? null }}" required />
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
                                        <textarea class="form-control{{ $errors->has('description') ?? ' is-invalid' ?? '' }} " {{$view ? 'readonly' : ''}} rows="3" id="description" name="description" placeholder="Description" required>{{ old('description') ?? $Quiz->description ?? null }}</textarea>
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
                            <div class="row">
                                <div class="col-8">
                                    <div class="dropdown show">
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Questions
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @if($view || $Quiz)
                                                @if(Auth::user()->can_edit)
                                                    <a href="{{route('quizzes.questions.process', [$Quiz->id])}}" class="dropdown-item"> Edit Questions</a>
                                                @elseif(Auth::user()->can_view)
                                                    <a href="{{route('quizzes.questions.process', [$Quiz->id])}}" class="dropdown-item"> View Questions</a>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @if(!$view)
                                        @if(Auth::user()->can_edit)
                                            <button  type="submit" class="btn btn-success float-right"> Submit</button>
                                        @endif
                                    @endif
                                </div>
                            </div>



                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
