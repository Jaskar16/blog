<section>
    <header>
        <h2 class="card-title">{{ __('Delete Account') }}</h2>
        <p class="text-sm opacity-70 mt-1">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-error mt-4"
        onclick="document.getElementById('confirm_user_deletion').showModal()">
        {{ __('Delete Account') }}
    </button>

    <dialog id="confirm_user_deletion" class="modal">
        <div class="modal-box">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h3 class="text-lg font-bold">
                    {{ __('Are you sure you want to delete your account?') }}
                </h3>

                <p class="text-sm opacity-70 mt-2">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <!-- Password -->
                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">@lang('Password')</legend>
                    <input name="password" type="password" placeholder="{{ __('Password') }}"
                        class="input w-full @error('password', 'userDeletion') input-error @enderror" />
                    @error('password', 'userDeletion')
                        <p class="label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="modal-action">
                    <button type="button" class="btn"
                        onclick="document.getElementById('confirm_user_deletion').close()">
                        {{ __('Cancel') }}
                    </button>
                    <button class="btn btn-error">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Clicking outside the modal closes it -->
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.getElementById('confirm_user_deletion').showModal();
        </script>
    @endif
</section>
