@extends('layouts.guest')

@section('content')
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Criar nova conta
    </h2>

    <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
        @csrf

        <x-input-label for="name" value="Nome" />
        <x-text-input name="name" type="text" placeholder="Seu nome" required autofocus />
        <x-input-error :messages="$errors->get('name')" />

        <x-input-label for="email" value="E-mail" />
        <x-text-input name="email" type="email" placeholder="Seu e-mail" required />
        <x-input-error :messages="$errors->get('email')" />

        <x-input-label for="password" value="Senha" />
        <x-password-input 
            name="password" 
            placeholder="Sua senha" 
            required 
            hint="A senha deve ter pelo menos 8 caracteres" 
            minlength="8" 
        />
        <x-input-error :messages="$errors->get('password')" />

        <x-input-label for="password_confirmation" value="Confirmar Senha" />
        <x-password-confirmation-input 
            target="password" 
            name="password_confirmation" 
            placeholder="Confirme sua senha" 
            required 
            hint="As senhas devem ser iguais" 
        />
        <x-input-error :messages="$errors->get('password_confirmation')" />

        <x-primary-button class="mt-4">
            Registrar
        </x-primary-button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                Já tem uma conta? Entre aqui
            </a>
        </div>
    </form>
@endsection
