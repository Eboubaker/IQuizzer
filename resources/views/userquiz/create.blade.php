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
    <form name="create" class="justify-center py-5 px-12 mt-5" action="{{ route('userquiz.store', $quiz->id) }}" method="post">
        @csrf
        <div class="info w-full">
            <div class="w-full text-center text-xl">{{ $quiz->title }} Quiz</div>
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
                <button id="quiz-start" type="button" class="mx-auto btn-primary">Start Quiz</button>
            </div>
        </div>
        <div class="questions hidden mt-6">
            <div class="question-number">
                Question 5
            </div>
            <div class="question">
                <div class="question-text">
                    What is the size of the sun if it was a fat sun?
                </div>
                <div class="question-choices">
                    <div class="question-choice">
                        512 kilos
                    </div>
                    <div class="question-choice">
                        512 kilos
                    </div>
                    <div class="question-choice">
                        512 kilos
                    </div>
                    <div class="question-choice">
                        512 kilos
                    </div>
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
    </script>
@endpush