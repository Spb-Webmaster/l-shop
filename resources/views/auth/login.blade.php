@extends('layouts.auth')
@section('title', 'Вход в аккаунт')
@section('content')
    <x-forms.auth-form
        title="Вход в аккаунт"
        action="{{ route('login.handle') }}"
        method="POST"
    >
        @csrf

        <x-forms.text-input
            type="email"
            name="email"
            placeholder="E-mail"
            required="true"
            value="{{ old('email') }}"
            :isError="$errors->has('email')"
        />
        @error('email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            type="password"
            name="password"
            placeholder="Пароль"
            required="true"
            :isError="$errors->has('email')"
        />
        <x-forms.primary-button>
            Войти
        </x-forms.primary-button>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('forgot') }}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
                <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-form>

@endsection
