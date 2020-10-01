<nav class="flex items-center bg-gray-800 p-3 flex-wrap shadow-md">

    <a href="/" class="inline-flex items-center">
        <img src="/logo.png" width="40px" height="auto" alt=""/>
        <span class="p-2 mr-4 text-xl text-white font-bold uppercase tracking-wide"
        >Quizzer
        </span>
    </a>
    <button
            class="focus:outline-none text-white inline-flex p-3 hover:bg-gray-900 rounded lg:hidden ml-auto hover:text-white outline-none"
            id="nav-toggle"
    >
        <i class="material-icons">menu</i>
    </button>
    <div
            id="navigation"
            class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto"
    >
        <div
                class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto"
        >
            <a
                    href="/"
                    class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Home</span>
            </a>
            <a
                    href="{{ route('explore') }}"
                    class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Explore</span>
            </a>
            <a
                    href="{{ route('quiz.create') }}"
                    class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
            >
                <span>Create Quiz</span>
            </a>
            @auth
                @include('_profile_dropdown')
            @else
                <a
                        href="{{ route('login') }}"
                        class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
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