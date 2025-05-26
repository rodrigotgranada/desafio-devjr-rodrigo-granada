@extends('layouts.guest')

@section('content')
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Entrar na sua conta
    </h2>

    <form method="POST" action="{{ route('login') }}" class="mt-6">
        @csrf
        <div class="flex flex-col gap-4">
            <div>
                <x-input-label for="email" value="E-mail" />
                <x-text-input name="email" type="email" placeholder="Seu e-mail" required autofocus />
                <x-input-error :messages="$errors->get('email')" />

            </div>
            <div>
                <x-input-label for="password" value="Senha" />
                <x-password-input name="password" placeholder="Sua senha" required />

            </div>
        </div>

        <div class="flex flex-col gap-4">
            <x-primary-button class="mt-6 justify-center">
                Entrar
            </x-primary-button>

            <div class="text-center">
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Não tem uma conta? Registre-se
                </a>
            </div>
        </div>

    </form>
@endsection
