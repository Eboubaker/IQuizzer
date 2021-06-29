<div class="relative inline-block text-left">
    <div>
    <span class="rounded-md shadow-sm">
      <button
      onclick="changeState()"  type="button" class="focus:outline-none lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white" id="options-menu" aria-haspopup="true" aria-expanded="true">
        <span>{{ auth()->user()->name }}</span>
          <!-- Heroicon name: chevron-down -->
        <svg class="inline-block mr-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
    </span>
    </div>

    <!--
      Dropdown panel, show/hide based on dropdown state.

      Entering: "transition ease-out duration-100"
        From: "transform opacity-0 scale-95"
        To: "transform opacity-100 scale-100"
      Leaving: "transition ease-in duration-75"
        From: "transform opacity-100 scale-100"
        To: "transform opacity-0 scale-95"
    -->
    <div id="profileMenu" class="z-10 right-0 origin-top-right absolute w-56 rounded-md shadow-lg"
         style="top:2rem;opacity:0;"
    >
        <div class="rounded-md bg-white shadow-xs">
            <div aria-labelledby="options-menu" aria-orientation="vertical" class="py-1" role="menu">
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="{{ route('quiz.index') }}"
                   role="menuitem"
                >My Quizzes
                </a>
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="{{ route('user.settings.create') }}"
                   role="menuitem"
                >Account settings</a>
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="#"
                   role="menuitem"
                >Support
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                            role="menuitem"
                            type="submit"
                    >Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let profileMenu = $("#profileMenu");
        profileMenu.clickAway(function(){
            if(profileMenu.css('opacity') === '1')
            {
                close();
            }
        });
        function close()
        {
            profileMenu.animate({opacity:0, top:'2rem'}, 200, ()=>profileMenu.hide());
        }
        function open() {
            profileMenu.show().animate({opacity:1, top:'3.6rem'}, 200, ()=>profileMenu.show());
        }
        function changeState()
        {
            if(profileMenu.css('opacity') === '0')
            {
                open();
            }else
            {
                close();
            }
        }
    </script>
@endpush