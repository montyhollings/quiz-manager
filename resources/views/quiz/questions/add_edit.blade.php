@extends('layouts.app')
@section('content')
    <form action="{{ $form_url }}" method="POST">
        @csrf
        <div class="container">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if($Question)
                            Edit Question
                        @else
                            Create Question
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Question <span class="text-danger">*</span></label>
                                    <input class="form-control{{ $errors->has('question') ?? ' is-invalid' ?? '' }}" type="text" id="question" name="question" placeholder="Question" value="{{ old('question') ?? $Question->question ?? null }}" required />
                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="number_of_answers">Number of Answers <span class="text-danger">*</span></label>
                                    <select name="number_of_answers" id="number_of_answers" class="custom-select " required>
                                        <option value="2" @if($Question && $Question->answers->count() == 2) selected @endif> 2</option>
                                        <option value="3" @if($Question && $Question->answers->count() == 3) selected @endif>3</option>
                                        <option value="4" @if($Question && $Question->answers->count() == 4) selected @endif>4</option>

                                    </select>
                                    @if ($errors->has('number_of_answers'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number_of_answers') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="correct_select">Correct Answer <span class="text-danger">*</span></label>
                                    <select name="correct_select" id="correct_select" class="custom-select" required>
                                        <option value="" selected></option>
                                        <option value="1" @if($Question && $Question->answers->first()->correct == true) selected @endif>1</option>
                                        <option value="2" @if($Question && $Question->answers->get(1)->correct == true) selected @endif>2</option>
                                        <option value="3" id="correct_answer_3" @if($Question && $Question->answers->count() >=3 && $Question->answers->get(2)->correct == true) selected @endif>3</option>
                                        <option value="4" id="correct_answer_4" @if($Question && $Question->answers->count() >=4 && $Question->answers->get(3)->correct == true) selected @endif>4</option>
                                    </select>

                                    @if ($errors->has('correct_select'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('correct_select') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3 question-col-1">
                                        <div class="form-group">
                                            <label for="answer_1">Answer 1 <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="answer_1" name="answer_1" @if(old('answer_1')) value="{{old('answer_1')}}" @elseif($Question && $Question->answers->first()->answer) value="{{$Question->answers->first()->answer}}" @endif required >
                                            @if ($errors->has('answer_1'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('answer_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3 question-col-2">
                                        <div class="form-group">
                                            <label for="answer_2">Answer 2 <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="answer_2" name="answer_2" @if(old('answer_2')) value="{{old('answer_2')}}" @elseif($Question && $Question->answers->get(1)->answer) value="{{$Question->answers->get(1)->answer}}" @endif required>
                                            @if ($errors->has('answer_2'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('answer_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3 question-col-3 @if(!$Question) d-none @elseif($Question->answers->count() < 3)  d-none @endif"  >
                                        <div class="form-group">
                                            <label for="answer_3">Answer 3 <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="answer_3" name="answer_3" @if(old('answer_3')) value="{{old('answer_3')}}" @elseif($Question && $Question->answers->count() >=3 &&$Question->answers->get(2)->answer) value="{{$Question->answers->get(2)->answer}}" @endif>
                                            @if ($errors->has('answer_3'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('answer_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3 question-col-4 @if(!$Question) d-none @elseif($Question->answers->count() < 4)  d-none @endif" >
                                        <div class="form-group">
                                            <label for="answer_4">Answer 4 <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="answer_4" name="answer_4" @if(old('answer_3')) value="{{old('answer_3')}}" @elseif($Question && $Question->answers->count() >=4 &&$Question->answers->get(3)->answer) value="{{$Question->answers->get(3)->answer}}" @endif >
                                            @if ($errors->has('answer_4'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('answer_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        <button class="btn btn-success float-right" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('custom_javascript')
    <script>
        $(document).ready(function() {
            $('#number_of_answers').on('change', function() {
                let val = $(this).val();
                console.log(val);

                switch(val) {
                    case "2":
                        $('#correct_answer_3').addClass('d-none');
                        $('#correct_answer_4').addClass('d-none');
                        $('.question-col-3').addClass('d-none');
                        $('.question-col-4').addClass('d-none');
                        $('#answer_3').prop('required',false);
                        $('#answer_3').val(null);
                        $('#answer_4').prop('required',false);
                        $('#answer_4').val(null);
                        break;
                    case "3":
                        $('.question-col-3').removeClass('d-none');
                        $('#correct_answer_3').removeClass('d-none');
                        $('#answer_3').prop('required',true);

                        $('.question-col-4').addClass('d-none');
                        $('#correct_answer_4').addClass('d-none');
                        $('#answer_4').prop('required',false);
                        break;
                    case "4":
                        $('.question-col-3').removeClass('d-none');
                        $('.question-col-4').removeClass('d-none');
                        $('#answer_3').prop('required',true);
                        $('#answer_4').prop('required',true);
                        $('#correct_answer_3').removeClass('d-none');
                        $('#correct_answer_4').removeClass('d-none');

                        break;
                }

            });
            $('#number_of_answers').change();
        });
    </script>
@endsection
