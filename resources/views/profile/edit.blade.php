@extends('partials.layout')
@section('content')
    <div class="container mx-auto w-2/3 my-4 space-y-6">
        <h1 class="text-2xl font-semibold">{{ __('Profile') }}</h1>

        <div class="card bg-base-300 shadow-sm p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="card bg-base-300 shadow-sm p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="card bg-base-300 shadow-sm p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
