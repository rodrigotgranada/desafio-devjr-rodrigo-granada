@props([
    'show' => false,
    'title' => 'Confirmar ação',
    'message' => 'Tem certeza?',
    'confirmText' => 'Confirmar',
    'cancelText' => 'Cancelar',
    'confirmColor' => 'bg-red-600 hover:bg-red-700',
    'action' => '',
    'xShow' => 'showDeleteModal',
    'method' => 'DELETE',
])

<div
    x-show="{{ $xShow }}"
    style="display: none;"
    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40"
>
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h2 class="text-lg font-semibold mb-2">{{ $title }}</h2>
        <p class="mb-4">{{ $message }}</p>
        <div class="flex justify-end gap-2">
            <x-primary-button
                type="button"
                bgColor="bg-gray-300"
                hoverBgColor="hover:bg-gray-400"
                textColor="text-gray-700"
                @click="{{ $xShow }} = false"
            >
                {{ $cancelText }}
            </x-primary-button>
            <x-primary-button
                type="button"
                :bgColor="$confirmColor"
                textColor="text-white"
                @click="$refs.form.submit()"
            >
                {{ $confirmText }}
            </x-primary-button>
        </div>
        <form x-ref="form" method="POST" action="{{ $action }}" class="hidden">
            @csrf
            @if(strtoupper($method) !== 'POST')
                @method($method)
            @endif
            {{ $slot }}
        </form>
    </div>
</div> 