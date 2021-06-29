@extends('layout')
@section('title') Explore @endsection
@section('content')
    <div class="content mt-10">
        <div class="w-full text-center">
            <div class="text-4xl">Popular Quizzes</div>
            <div class="font-semibold font-sans text-blue-800">Do you want to challenge your skills? Check out these Quizzes</div>
        </div>
        <div class="flex flex-wrap justify-center w-11/12 mx-auto pt-10">
            @foreach($quizzes as $quiz)
                <a href="{{ $quiz->path }}" class="group p-5 m-2 bg-white w-auto max-w-sm inline-block shadow-md rounded-md hover:bg-blue-100">
                    <div class="text-black ">{{ $quiz->title }}</div>
                    <div class="flex mt-1">
                        <div class="flex cursor-pointer" title="Questions">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ count($quiz->questions) }}</span>
                        </div>
                        <div class="flex mx-2 border-r border-gray-300"></div>
                        <div class="flex cursor-pointer" title="Engaged users">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>{{ count($quiz->usersQuiz) }}</span>
                        </div>
                        <div class="flex mx-2 border-r border-gray-300"></div>
                        <div class="flex cursor-pointer" title="Created At {{ $quiz->Created->format('d F Y')}}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $quiz->Created->format('d/M/y') }}</span>
                        </div>
                        <div class="flex mx-2 border-r border-gray-300"></div>
{{--                        <div class="flex cursor-pointer" title="Time Limit">--}}
{{--                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>--}}
{{--                            <span>{{ 25/*count($quiz->usersQuiz)*/ }}</span>--}}
{{--                        </div>--}}
                    </div>
                    <div class="group-hover:text-gray-800 text-gray-500 text-sm block">
                        {{ $quiz->description }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
