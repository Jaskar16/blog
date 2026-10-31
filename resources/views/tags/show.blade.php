@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <a href="{{ route('tags.index') }}" class="btn btn-primary">Back</a>
        <div class="card bg-base-300 shadow-sm mt-2">
            <table class="table table-zebra">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $tag->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $tag->name }}</td>
                    </tr>
                    <tr>
                        <th>Posts</th>
                        <td>{{ $tag->posts->count() }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $tag->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th>
                        <td>{{ $tag->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">Posts with this tag</h2>
        <table class="table table-zebra">
            <thead>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($tag->posts as $post)
                    <tr class="hover:bg-base-300">
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td><a href="{{ route('post', $post) }}" class="btn btn-sm btn-info">View</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No posts with this tag yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
