@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <form method="POST" action="{{ route('password.store') }}" class="card bg-base-300 shadow-sm w-2/3 mx-auto p-3 my-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <fieldset class="fieldset">
                <legend class="fieldset-legend">@lang('Email')</legend>
                <input name="email" value="{{ old('email', $request->email) }}" type="email"
                    class="input w-full @error('email') input-error @enderror" required autofocus autocomplete="username" />
                @error('email')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <!-- Password -->
            <fieldset class="fieldset">
                <legend class="fieldset-legend">@lang('Password')</legend>
                <input name="password" type="password"
                    class="input w-full @error('password') input-error @enderror" required autocomplete="new-password" />
                @error('password')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <!-- Confirm Password -->
            <fieldset class="fieldset">
                <legend class="fieldset-legend">@lang('Confirm Password')</legend>
                <input name="password_confirmation" type="password"
                    class="input w-full @error('password_confirmation') input-error @enderror" required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
@endsection
