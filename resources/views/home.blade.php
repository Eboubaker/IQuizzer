@extends('layout')

@section('title') Home @endsection
@push('header-sources')
    <style>
        .bg{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: right 40%;
            height:32rem;
        }
        @media screen and (max-width: 400px){
            .bg{
                background-position-x: 40%;
            }
        }
        .page{
            min-height: initial !important;
        }
    </style>
@endpush
@section('content')
    <head>
        <div class="bg w-full bg-cover bg-center">
            <div class="flex items-center justify-center h-full w-full bg-gray-900 bg-opacity-50">
                <div class="text-center">
                    <h1 class="text-white text-2xl font-semibold uppercase md:text-3xl">Build Your new <span class="underline text-blue-400">QCM Quiz</span></h1>
                    <a href="{{ route('quiz.create') }}" class="mt-5 px-4 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Make Quiz</a>
                    <h1 class="mt-16 text-gray-200 text-xl font-semibold md:text-xl">Making Online Exams For Your Students Was Never Easier</h1>
                    <h1 class="text-gray-200 mx-auto text-xl md:w-1/2 md:text-xl">Tired Of Managing Your Students Paper Exams Results? We got you covered with our easy to use management system</h1>
                </div>
            </div>
        </div>
    </head>
@endsection

@push('scripts')
    <script>
        window.readyFunc = function(){
            let url = '{{ asset('img/man-sitting-in-floor-using-laptop.jpg') }}';
            $('<img/>').attr('src', url).on('load', function() {
                $(this).remove();
                $('.bg').css('background-image', `url(${url})`);
                $('#loading-animation').hide();
            });
        }
    </script>
@endpush
