@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <a href="{{ route('tags.create') }}" class="btn btn-primary">New Tag</a>
        {{ $tags->links() }}
        <table class="table table-zebra">
            <thead>
                <th>Name</th>
                <th>Posts</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr class="hover:bg-base-300">
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts_count }}</td>
                        <td>
                            <div class="join">
                                <a href="{{ route('tags.show', $tag) }}" class="btn btn-info">View</a>
                                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning">Edit</a>
                                <button form="delete-form-{{ $tag->id }}" type="submit" class="btn btn-error">Delete</button>
                            </div>
                            <form id="delete-form-{{ $tag->id }}" action="{{ route('tags.destroy', $tag) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th>Name</th>
                <th>Posts</th>
                <th>Actions</th>
            </tfoot>
        </table>
        {{ $tags->links() }}
    </div>
@endsection
