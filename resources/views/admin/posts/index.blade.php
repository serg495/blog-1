@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success btn-block" href="{{ route('posts.create') }}">Create new user</a>
        <table align="center" class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Summary</th>
                <th scope="col">Body</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ str_limit($post->summary, 50, '...') }}</td>
                    <td>{{ str_limit($post->body, 150, '...') }}</td>
                    <td>IMAGE</td>
                    <td class="nav flex-column">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-success">Show</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@endsection