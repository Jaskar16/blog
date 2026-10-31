@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <form action="{{ route('tags.update', $tag) }}" method="POST" class="card bg-base-300 shadow-sm w-2/3 mx-auto p-3">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Name</legend>
                <input name="name" value="{{ old('name', $tag->name) }}" type="text"
                    class="input w-full @error('name') input-error @enderror" placeholder="Tag name" />
                @error('name')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
