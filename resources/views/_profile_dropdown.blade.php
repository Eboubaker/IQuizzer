<div class="relative inline-block text-left" x-data="{ opened:false }">
    <div>
    <span class="rounded-md shadow-sm">
      <button @click="opened=!opened" type="button" class="focus:outline-none lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white" id="options-menu" aria-haspopup="true" aria-expanded="true">
        {{ auth()->user()->name }}
          <!-- Heroicon name: chevron-down -->
        <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
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
    <div :class="!opened?'hidden':''" class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg">
        <div class="rounded-md bg-white shadow-xs">
            <div aria-labelledby="options-menu" aria-orientation="vertical" class="py-1" role="menu">
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="{{ route('quiz.index') }}"
                   role="menuitem"
                >My Quizzes
                </a>
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="/settings"
                   role="menuitem"
                >Account settings</a>
                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                   href="/support"
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