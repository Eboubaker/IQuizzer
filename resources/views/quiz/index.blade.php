@extends('layout')
@section('title') My Quizzes @endsection
@section('content')
    <div class="content mt-10">
        <div class="w-full text-center">
            <div class="text-4xl">Your Quizzes</div>
            <div class="font-semibold font-sans text-blue-800">You have made {{ count($quizzes) }} Quizzes and completed {{ count($userQuizzes) }} Quizzes so far</div>
        </div>
        <div class="flex flex-wrap justify-center w-11/12 mx-auto pt-10">
            @foreach($quizzes as $quiz)
                <a href="{{ $quiz->path }}" class="p-5 m-2 relative bg-white w-auto max-w-sm inline-block shadow-md rounded-md hover:bg-blue-100">
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
                        <div class="flex cursor-pointer" title="Average point {{ $quiz->avg.'/'.Helper::mpointval() }}">
                            <svg  class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 1024 1024" version="1.1"><path d="M377.94126 501.419014H267.218506v-36.907585H377.94126v36.907585z m184.700629-36.907585h-110.721731v36.907585h110.721731v-36.907585z m-369.402281 0H82.516854v36.907585h110.722754v-36.907585z m554.103933 0H636.620787v36.907585h110.722754v-36.907585z m184.701652 0H821.321416v36.907585h110.723777v-36.907585zM84.898087 247.044536l32.870642 47.864124s83.042321-69.778226 174.157505-51.901067c87.657432 24.219611 153.974837 147.630339 162.336272 184.537923 0-0.576121 61.705364 0 61.993936 0-2.883677-39.791262-76.699869-202.416106-204.722638-236.440014-115.273397-34.582633-226.635717 55.939033-226.635717 55.939034zM949.921329 718.978005l-32.871665-47.864124s-83.041298 69.777203-174.156482 51.901067c-87.657432-24.221658-153.974837-147.631362-162.337295-184.537923 0 0.576121-61.705364 0-61.992913 0 2.882654 39.792285 76.698846 202.415083 204.722638 236.440013 115.273397 34.58161 226.635717-55.939033 226.635717-55.939033z" fill=""/></svg>
                            <span style="transform: translateY(-3px)">{{ $quiz->avg ?? '--' }}</span>
                        </div>

                    </div>
                </a>
            @endforeach
            @foreach($userQuizzes as $userQuiz)
                <a href="{{ $userQuiz->path }}" class="p-5 m-2 relative bg-gradient-to-b bg-red-100 w-auto max-w-sm inline-block shadow-md rounded-md hover:bg-blue-100">
                    <div class="text-black ">{{ $userQuiz->quiz->title }}</div>
                    <div class="flex mt-1">
                        @if($userQuiz->point === $userQuiz->quiz->total_points)
                            <div class="flex cursor-pointer" title="Full point!">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            </div>
                            <div class="flex mx-2 border-r border-gray-300"></div>
                        @endif
                        <div class="flex cursor-pointer" title="Final point">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span>{{ $userQuiz->point }}</span>
                        </div>
                        <div class="flex mx-2 border-r border-gray-300"></div>
                        <div class="flex cursor-pointer" title="Questions">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ count($userQuiz->answers) }}</span>
                        </div>
                        <div class="flex mx-2 border-r border-gray-300"></div>
                        <div class="flex cursor-pointer" title="Average point">
                            <svg  class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 1024 1024" version="1.1"><path d="M377.94126 501.419014H267.218506v-36.907585H377.94126v36.907585z m184.700629-36.907585h-110.721731v36.907585h110.721731v-36.907585z m-369.402281 0H82.516854v36.907585h110.722754v-36.907585z m554.103933 0H636.620787v36.907585h110.722754v-36.907585z m184.701652 0H821.321416v36.907585h110.723777v-36.907585zM84.898087 247.044536l32.870642 47.864124s83.042321-69.778226 174.157505-51.901067c87.657432 24.219611 153.974837 147.630339 162.336272 184.537923 0-0.576121 61.705364 0 61.993936 0-2.883677-39.791262-76.699869-202.416106-204.722638-236.440014-115.273397-34.582633-226.635717 55.939033-226.635717 55.939034zM949.921329 718.978005l-32.871665-47.864124s-83.041298 69.777203-174.156482 51.901067c-87.657432-24.221658-153.974837-147.631362-162.337295-184.537923 0 0.576121-61.705364 0-61.992913 0 2.882654 39.792285 76.698846 202.415083 204.722638 236.440013 115.273397 34.58161 226.635717-55.939033 226.635717-55.939033z" fill=""/></svg>
                            <span style="transform: translateY(-3px)">--</span>
                        </div>
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
