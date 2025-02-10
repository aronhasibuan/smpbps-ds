@props(['active'=>false])

<a {{ $attributes }} class=" {{ $active ? 'bg-[#228be6] text-white' : 'text-black hover:bg-[#e8f3fc]' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : false}}"> {{ $slot }} </a>