@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <textarea type="text" name="summary" class="form-control" id="summary">
                        {{ old('summary') }}
                    </textarea>
                        @if ($errors->has('summary'))
                            <div class="alert alert-danger">{{ $errors->first('summary') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea type="text" name="body" class="form-control" id="body" rows="7">
                        {{ old('body') }}
                    </textarea>
                        @if ($errors->has('body'))
                            <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                        @if ($errors->has('thumbnail'))
                            <div class="alert alert-danger">{{ $errors->first('thumbnail') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection