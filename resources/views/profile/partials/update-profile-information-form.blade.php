<section>
    <header>
        <h2 class="card-title">{{ __('Profile Information') }}</h2>
        <p class="text-sm opacity-70 mt-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- Name -->
        <fieldset class="fieldset">
            <legend class="fieldset-legend">@lang('Name')</legend>
            <input name="name" value="{{ old('name', $user->name) }}" type="text"
                class="input w-full @error('name') input-error @enderror" required autofocus autocomplete="name" />
            @error('name')
                <p class="label text-error">{{ $message }}</p>
            @enderror
        </fieldset>

        <!-- Email -->
        <fieldset class="fieldset">
            <legend class="fieldset-legend">@lang('Email')</legend>
            <input name="email" value="{{ old('email', $user->email) }}" type="email"
                class="input w-full @error('email') input-error @enderror" required autocomplete="username" />
            @error('email')
                <p class="label text-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link btn-sm px-0">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <div role="alert" class="alert alert-success mt-2">
                        <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                    </div>
                @endif
            @endif
        </fieldset>

        <div class="flex items-center gap-4 mt-4">
            <button class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <div role="alert" class="alert alert-success py-2">
                    <span>{{ __('Saved.') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
