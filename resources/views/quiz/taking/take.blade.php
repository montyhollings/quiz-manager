@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Take Quiz : {{ $Quiz->name }}
                    </div>
                    <div class="card-body text-center">

                        <div id="question_area">
                            <strong id="question_text_area"></strong>

                            <div id="question_answers_area">


                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success float-right" id="submitAnswerButton">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('custom_javascript')

    <script>
        $(document).ready(function () {
            function get_next_question() {
                console.log('hi');
                $('#question_text_area').html("");
                $('#question_answers_area').html("");
                $.ajax({
                    url: '{{ route('quizzes.take.get_next_question', [$Quiz->id, $QuizAttempt->id]) }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                })
                    .done(function(data) {
                        var question = JSON.parse(data.question);
                        display_question(question);
                    })
                    .fail(function(data) {
                        console.log("error");
                        console.log(data);
                    });
            }
            function display_question(question) {
                $('#question_text_area').data('question-id', question.id).html(question.question);
                var answers = question.answers;
                $.each(answers, function (index, element) {
                    var radio = generate_radio_input(element);
                    radio.appendTo('#question_answers_area');
                });
            }
            function generate_radio_input(element) {
                var form_check = $('<div>').addClass('form-check');
                var label = $('<label>').addClass('form-check-label').appendTo(form_check);
                var input = $('<input>').prop('type', 'radio').val(element.id).prop('name', 'radio_input').addClass('form-check-input').appendTo(label);
                var span = $('<span>').text(element.answer).appendTo(label);
                return form_check;
            }
            function save_answer() {
                var question_id = $('#question_text_area').data('question-id');
                var answer_id = $('input[type="radio"][name="radio_input"]:checked').val();
                $.ajax({
                    url: '{{ route('quizzes.take.save_answer', [$Quiz->id, $QuizAttempt->id]) }}',
                    type: 'POST',
                    data: {question_id, answer_id,"_token": "{{ csrf_token() }}"}
                })
                    .done(function(data) {
                        if(data.quiz_finished) {
                            location = "{{ route('quizzes.take.summary', [$Quiz->id, $QuizAttempt->id]) }}";
                        } else {
                            get_next_question();
                        }
                    })
                    .fail(function(data) {
                        console.log("error");
                        console.log(data);
                    });
            }
            $('#submitAnswerButton').click(function () {
                save_answer();
            });
            get_next_question();
        });
    </script>

@endsection
