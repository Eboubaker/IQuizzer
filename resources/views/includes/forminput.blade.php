<div class="flex flex-col mb-4">
    <label for="{{ $name }}" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
        {{ $label??"" }}
    </label>
    <div class="relative">
        <div class="absolute flex border border-transparent left-0 top-0 h-full w-10">
            @if ($svg)
            <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-100 text-gray-600 text-lg h-full w-full">
               {!! $svg !!}
                {{-- <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg> --}}
            </div>
            @endif
        </div>
        @input([
            "value" => $value ?? null,
            "label" => $label ?? null,
            "name" => $name
        ])
        
    </div>
    @error($name)
    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
        {{ $message }}
    </span>
    @enderror
</div>
