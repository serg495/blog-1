@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    {{ $post->title }}
                </h5>
                <img class="card-img-top" src="{{ optional( $post->getMedia('images')->first())->getUrl('thumb') }}" alt="">
            </div>
            <div class="card-body">
                <p class="card-text font-italic">{{ $post->summary }}</p>
                <p class="card-text">{{ $post->body }}</p>
            </div>
            <div class="card-body nav justify-content-between">
                @can('like post')
                    @if($post->isLiked())
                        <a href="{{ route('like.destroy', $post) }}">
                            <i class="text-danger fa fa-2x fa-heart"></i>
                        </a>
                    @else
                        <a href="{{ route('like.store', $post) }}">
                            <i class="text-black-50 text-danger fa fa-2x fa-heart"></i>
                        </a>
                    @endif
                @endcan
                <span>{{ $post->likesCount() }} likes</span>
                <span>{{ $post->viewsCount() }} views</span>
            </div>
        </div>
    </div>
@endsection