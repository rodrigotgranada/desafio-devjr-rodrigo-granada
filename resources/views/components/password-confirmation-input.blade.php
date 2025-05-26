@props([
    'name' => 'password_confirmation',
    'id' => null,
    'placeholder' => 'Confirme sua senha',
    'class' => '',
    'hint' => 'As senhas devem ser iguais',
    'target' => 'password',
])

<div class="relative" x-data="{ confirm: '', senha: '', show: false }"
     x-init="senha = document.getElementById('{{ $target }}') ? document.getElementById('{{ $target }}').value : '';
             $watch('confirm', value => { senha = document.getElementById('{{ $target }}') ? document.getElementById('{{ $target }}').value : ''; })">
    <input
        x-bind:type="show ? 'text' : 'password'"
        x-model="confirm"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'appearance-none py-1 px-2 border-0 border-b border-gray-300 focus:border-indigo-500 focus:ring-0 rounded-none w-full pr-10 ' . $class]) }}
        />
    <button type="button"
        class="absolute inset-y-0 right-0 flex px-3 text-gray-500"
        @click="show = !show"
        tabindex="-1"
        style="top: 0; bottom: 0;"
    >
        <svg x-show="!show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.542 3.95A9.956 9.956 0 0021.542 12c-1.274-4.057-5.065-7-9.542-7-1.02 0-2.012.127-2.963.366" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
        </svg>
    </button>
    @if($hint)
    <div class="flex items-center mt-1">
        <span class="text-sm text-gray-500">{{ $hint }}</span>
        <svg x-show="confirm && confirm === senha" x-cloak class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    @endif
</div> 