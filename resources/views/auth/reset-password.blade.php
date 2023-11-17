@extends('layouts.auth')
@section('title', 'Восстановление пароля')
@section('content')
    <x-forms.auth-form
        title="Восстановление пароля"
        action="{{ route('password.handle') }}"
        method="POST"
    >
        @csrf

        <input type="hidden" value="{{ $token }}" name="token" />

        <x-forms.text-input
            type="email"
            name="email"
            placeholder="E-mail"
            value="{{ request('email') }}"
            required="true"
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
            Обновить пароль
        </x-forms.primary-button>

        <x-slot:buttons>
        </x-slot:buttons>
    </x-forms.auth-form>

@endsection
