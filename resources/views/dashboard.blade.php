@extends('partials.layout')
@section('content')
    <div class="container mx-auto w-2/3 my-4 space-y-6">
        <h1 class="text-2xl font-semibold">{{ __('Dashboard') }}</h1>

        <div class="card bg-base-300 shadow-sm">
            <div class="card-body">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
@endsection
