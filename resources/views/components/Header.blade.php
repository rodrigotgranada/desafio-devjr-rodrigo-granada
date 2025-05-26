<nav class="bg-indigo-700 shadow fixed w-full z-10 top-0 left-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-white text-xl font-bold tracking-wide">
                    <x-logo class="w-7 h-7 mr-2 text-white" />
                    Todo App
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-white font-medium">{{ ucfirst(Auth::user()->name) }}</span>
                <x-logout-button text="Sair" />
            </div>
        </div>
    </div>
</nav> 