<x-guest-layout>

    <div class="brand-logo">
        <img src="{{ url('images/portal-logo.png') }}">
    </div>

    <x-validation-errors class="mb-4" />

    @session('status')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ $value }}
    </div>
    @endsession

    <h6 class="font-weight-light">Sign in to continue.</h6>

    <form class="pt-3" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <x-label for="username" value="{{ __('Username') }}" />
            <x-input id="username" class="form-control form-contorl-lg" type="text" name="username" :value="old('email')" required autofocus autocomplete="username" placeholder="Username"/>
        </div>

        <div class="form-group">
            <x-label for="password" value="{{ __('Password') }}" />
            <div class="input-group">
                <x-input id="password" class="form-control form-control-lg" type="password" name="password" required
                    autocomplete="current-password" placeholder="Password" />
                <div class="input-group-append">
                    <button class="btn btn-outline btn-sm form-control form-control-lg" type="button" id="togglePassword">
                        <i class="mdi mdi-eye-outline" id="passwordIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <x-button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                {{ __('LOG IN') }}
            </x-button>
        </div>

        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label for="remember_me" class="form-check-label text-muted">
                    <x-checkbox id="remember_me" name="remember" class="form-check-input" />
                    {{ __('Remember me') }}
                </label>
            </div>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot password?') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>