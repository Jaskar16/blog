@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <form method="POST" action="{{ route('password.confirm') }}" class="card bg-base-300 shadow-sm w-2/3 mx-auto p-3 my-4">
            @csrf

            <p class="text-sm mb-2">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <!-- Password -->
            <fieldset class="fieldset">
                <legend class="fieldset-legend">@lang('Password')</legend>
                <input name="password" type="password"
                    class="input w-full @error('password') input-error @enderror" required autocomplete="current-password" />
                @error('password')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="flex justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
@endsection
