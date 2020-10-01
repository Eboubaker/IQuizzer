<input name="{{ $name }}" type="{{ $type ?? 'text' }}"
@if($hidden)
    {{ "hidden" }}
@else
    placeholder="{{ $placeholder ?? $label ?? ""}}" value="{{ $value??"" }}"
    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12 border-red-500"
@endif
>
