@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $post->id }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $post->title }}</td>
            </tr>
            <tr>
                <th>Summary</th>
                <td>{{ $post->summary }}</td>
            </tr>
            <tr>
                <th>Body</th>
                <td>{{ $post->body }}</td>
            </tr>
            <tr>
                <th>Thumbnail</th>
                <td>IMAGE</td>
            </tr>
            </tbody>
        </table>
        <div class="nav">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection