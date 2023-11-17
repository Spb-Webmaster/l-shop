@extends('layouts.auth')
@section('title', 'Регистрация')
@section('content')
    <x-forms.auth-form
        title="Регистрация"
        action="{{ route('register.handle') }}"
        method="POST"
    >
        @csrf

        <x-forms.text-input
            type="text"
            name="name"
            placeholder="Имя"
            value="{{ old('name') }}"
            required="true"
            :isError="$errors->has('name')"
        />

        @error('name')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

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
            :isError="$errors->has('password')"
        />

        @error('password')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            type="password"
            name="password_confirmation"
            placeholder="Повторите пароль"
            required="true"
            :isError="$errors->has('email')"
        />

        @error('password_confirmation')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Зарегистрироваться
        </x-forms.primary-button>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">

                <div class="text-xxs md:text-xs"><a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">Войти в аккаунт</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-form>

@endsection
