@props(['class' => '', 'text' => null])

<x-primary-button 
    href="{{ route('logout') }}" 
    method="POST"
    class="{{ $class }}"
    bgColor="bg-white"
    hoverBgColor="hover:bg-indigo-100"
    textColor="text-indigo-700"
>
    <x-icons.logout-icon class="inline" />
    @if($text)
        <span class="ml-2 hidden md:inline">{{ $text }}</span>
    @endif
</x-primary-button> 