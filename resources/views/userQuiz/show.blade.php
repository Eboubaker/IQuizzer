@extends('layout')
@section('title') Quiz Result @endsection
@push('header-sources')

@endpush
@section('content')
    <div class="w-full">
        <div class="w-full text-center mt-12 text-4xl">
            Results for <a href="{{ $userQuiz->quiz->path }}" class="border-b text-gray-700 border-gray-300 border-dashed hover:border-gray-700">{{ $userQuiz->quiz->title }}</a>
        </div>
        <div class="w-full text-center text-md">User
            <a href="{{ $userQuiz->user->path }}" class="border-b text-gray-700 border-gray-300 border-dashed hover:border-gray-700">{{ $userQuiz->user->name }}</a>
        </div>
        <div class="w-full text-center mt-4 relative h-32">
            <p style="transform: translate(.2rem, -1.1rem);font-size:4em" class="inline-block relative {{ $userQuiz->point < Helper::mpointval()/2 ? 'text-red-500' :'text-green-500' }}">{{ $userQuiz->point }}</p>
            <p style="font-size: 5em" class="inline-block text-gray-600">/</p>
            <p style="font-size: 3em" class="inline-block text-gray-600">{{ Helper::mpointval() }}</p>
        </div>
        <hr/>
        <div class="w-full">
            @foreach($questions as $qIndex => $question)
                <div class="mt-4 grid justify-items-center">

                    <div class="text-center mt-2 font-sans font-semibold text-lg max-w-lg">
                        <span class="font-sans text-gray-700 text-3xl">{{ $qIndex+1 }}. </span>{{ $question->question }}
                    </div>
                    <div class="flex justify-center">
                        @if($answers[$qIndex] === $question->choices[$question->correctChoices[0]])
                            <div class="shadow-md text-sm border-b border-dashed border-green-500 text-green-500">+{{ Helper::topoint($question->point, $userQuiz->quiz->totalPoints).' '.Str::plural("Point", $question->point) }} </div>
                        @else
                            <div class="shadow-md text-sm border-b border-dashed border-red-500 text-red-500">-{{ Helper::topoint($question->point, $userQuiz->quiz->totalPoints).' '.Str::plural("Point", $question->point) }}</div>
                        @endif
                    </div>
                    <div class="flex lg:gap-10 flex-wrap justify-center w-full lg:w-75 mt-4">
                        @foreach($question->choices as $cIndex => $choice)
                            <div class="md:w-auto w-full flex justify-center">
                                @if($answers[$qIndex] === $choice && $cIndex === 0)
                                    <div style="min-width: 10rem" class="lg:m-0 mt-2 mb-1 mx-1 border p-5 text-center rounded border-green-500"><p class="absolute bg-gray-100 text-sm font-sans text-green-500 font-bold px-1" style="margin-top:-2rem;width:fit-content;">Correct answer ✔</p>{{ $choice }}</div>
                                @elseif($answers[$qIndex] === $choice)
                                    <div style="min-width: 10rem" class="lg:m-0 mt-2 mb-1 mx-1 border p-5 text-center rounded border-red-500"><p class="absolute bg-gray-100 text-sm font-sans text-red-500 font-bold px-1" style="margin-top:-2rem;width:fit-content;">Wrong answer ❌️</p>{{ $choice }}</div>
                                @elseif($cIndex === 0)
                                    <div style="min-width: 10rem" class="lg:m-0 mt-2 mb-1 mx-1 border p-5 text-center rounded border-green-500"><p class="absolute bg-gray-100 text-sm font-sans text-green-500 font-bold px-1" style="margin-top:-2rem;width:fit-content;">Correct choice</p>{{ $choice }}</div>
                                @else
                                    <div style="min-width: 10rem" class="lg:m-0 mt-2 mb-1 mx-1 border p-5 text-center rounded border-blue-500">{{ $choice }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <hr class="w-75 mx-auto my-4 border-gray-300" />
                </div>
            @endforeach
        </div>
    </div>
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