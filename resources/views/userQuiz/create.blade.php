@extends('layout')
@section('title') {{ $quiz->title }} Quiz @endsection
@push('header-sources')
    <style>
        table th{
            text-align: left;
        }
        table td{
            padding-left: 10rem;
            text-align: left;
        }
    </style>
@endpush
@section('content')
    @if($errors->count())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form name="create" class="justify-center py-5 px-12 mt-5" action="{{ route('userQuiz.store', $quiz->id) }}" method="post">
        @csrf
        <div class="info w-full">
            <div class="w-full text-center text-xl">{{ $quiz->title }}</div>
            <table class="table-auto mx-auto mt-6">
                <tr>
                    <th class="w-32">Total Points</th><td>{{ $quiz->total_points }}</td>
                </tr>
                <tr>
                    <th class="mr-4">Questions</th><td>{{ count($quiz->questions) }}</td>
                </tr>
                <tr>
                    <th class="mr-4">Created</th><td>{{ $quiz->createdAt }}</td>
                </tr>
            </table>
            <div class="flex-center mt-6">
                <button id="quiz-start" type="button" class="mx-auto btn btn-primary">Start Quiz</button>
            </div>
        </div>
        <div class="questions hidden mt-6">
            @foreach($quiz->questions as $index => $question)
                <div class="question mt-5 grid justify-items-center {{ $index !== 0 ? 'hidden' : ''}}">
                    <div class="question-number text-center text-3xl text-gray-800">
                        Question {{ $index+1 }}
                    </div>
                    <div class="question-text text-center mt-2 font-sans font-semibold text-lg max-w-lg">
                        {{ $question->question }}
                    </div>
                    <div class="question-choices flex gap-10 flex-wrap justify-center w-75 mt-4">
                        <input class="answer" name="answers[]" hidden>
                        @foreach($question->choices as $choice)
                            <div class="question-choice border border-2 border-blue-400 p-5 text-center rounded hover:bg-indigo-500 hover:border-transparent  hover:text-white cursor-pointer" style="max-width: 25%;">
                                {{ $choice }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="hidden end justify-items-center">
                <div class="question-number text-center text-3xl text-gray-800">
                    You have finished the Quiz!
                </div>
                <div class="question-text text-center mt-2 font-sans font-semibold text-lg max-w-lg">
                    We will register your answers, Please wait...
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        let form = $(document.forms['create']);
        $('#quiz-start').click(function(){
           $('.info').hide();
           animateShow($('.questions'));
        });
        function animateShow(jqelem){
            jqelem.show().css({opacity:0}).animate({opacity:1}, 200);
        }
        function showQuestion(qelem){
            qelem.css({opacity:0, display:'grid'}).animate({opacity:1}, 200);
        }
        $('.question-choice').click(function(){
            let choice = $(this);
            let question = choice.parents('.question');
            choice.parents('.question-choices').find('.answer').attr('value', choice.text().trim());
            showQuestion(question.hide().next());
            if(question.next().is('.end')){
                form.submit();
            }
        });
    </script>
@endpush