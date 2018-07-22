@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    {{ $post->title }}
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text font-italic">{{ $post->summary }}</p>
                <p class="card-text">{{ $post->body }}</p>
            </div>
        </div>
    </div>
@endsection