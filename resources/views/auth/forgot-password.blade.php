@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <form method="POST" action="{{ route('password.email') }}" class="card bg-base-300 shadow-sm w-2/3 mx-auto p-3 my-4">
            @csrf

            <p class="text-sm mb-2">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div role="alert" class="alert alert-success">
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Email Address -->
            <fieldset class="fieldset">
                <legend class="fieldset-legend">@lang('Email')</legend>
                <input name="email" value="{{ old('email') }}" type="email"
                    class="input w-full @error('email') input-error @enderror" required autofocus />
                @error('email')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
@endsection
