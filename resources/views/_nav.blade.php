<nav class="flex items-center bg-gray-800 p-3 flex-wrap shadow-md">

    <a href="/" class="inline-flex items-center">
        <img src="/logo.png" width="40px" height="auto" alt=""/>
        <span class="p-2 mr-4 text-xl text-white font-bold uppercase tracking-wide"
        >Quizzer
        </span>
    </a>
    <button
            class="focus:outline-none text-white inline-flex p-3 hover:bg-gray-900 rounded md:hidden ml-auto hover:text-white outline-none"
            id="nav-toggle"
    >
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>    </button>
    <div
            id="navigation"
            class="hidden top-navbar w-full md:inline-flex md:flex-grow md:w-auto"
    >
        <div
                class="md:inline-flex md:flex-row md:ml-auto md:w-auto w-full md:items-center items-start  flex flex-col md:h-auto"
        >
            <a
                    href="/"
                    class="md:inline-flex md:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Home</span>
            </a>
            <a
                    href="{{ route('explore') }}"
                    class="md:inline-flex md:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Explore</span>
            </a>
            <a
                    href="{{ route('quiz.create') }}"
                    class="md:inline-flex md:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Create Quiz</span>
            </a>
            @auth
                @include('_profile_dropdown')
            @else
                <a
                        href="{{ route('login') }}"
                        class="md:inline-flex md:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
                >
                    <span>Login</span>
                </a>
            @endauth

        </div>
    </div>
</nav>

@push('scripts')
    <script>
        $(function(){
            let toggled = false;
            $('#nav-toggle').click(function(){
                $('#navigation').animate({height: 'toggle'});
                toggled = true;
            });
            $(window).resize(function () {
                if(window.innerWidth > 1024 && toggled){
                    $('#navigation').css('display', '');
                }
            });
        });
    </script>
@endpush