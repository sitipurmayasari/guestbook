<x-authentication-layout>
    <div class="flex items-center justify-center h-16 px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <a class="block" href="{{ route('dashboard') }}">

            <img width="65" height="65" src="{{ asset('images/logo.png') }}" alt="" srcset="">
        </a>
    </div>
    <br>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Reset your Password') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <!-- Form -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <x-jet-label for="email">{{ __('Email Address') }} <span class="text-rose-500">*</span></x-jet-label>
            <x-jet-input id="email" type="email" name="email" :value="old('email')" required autofocus />
        </div>
        <div class="flex justify-end mt-6">
            <x-jet-button>
                {{ __('Send Reset Link') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
</x-authentication-layout>
