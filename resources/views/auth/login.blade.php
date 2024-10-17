<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-black dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
            </label>
        </div>

        <!-- Botones de Register y Log in -->
        <div class="flex flex-col items-center justify-center mt-4 space-y-2">

            <!-- Botón de Log in -->
            <x-primary-button class="w-full flex items-center justify-center">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>

            <!-- Forgot Password -->
            <a href="{{ route('password.request') }}" class="w-full flex items-center justify-center px-4 py-2 bg-black hover:bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>

        <!-- Register -->
        <div class="flex flex-col items-center justify-center mt-4 space-y-2">
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                ¿No tienes una cuenta? 
                <a href="{{ route('register') }}" class="text-black hover:text-gray-500 underline">
                    Regístrate
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
