@extends('frontend.layout.master')
@section('content')
@foreach ($posts as $post)
    <div class="post post-row">
        <a class="post-img" href="{{ action('BlogController@detail', $post->slug) }}"><img src="{{ asset($post->image) }}" alt=""></a>
        <div class="post-body">
            <div class="post-category">
                <a href="{{ action('BlogController@category', $post->category->slug) }}">{{ $post->category->name }}</a>
            </div>
            <h3 class="post-title"><a href="{{ action('BlogController@detail', $post->slug) }}">{{ $post->title }}</a></h3>
            <ul class="post-meta">
                <li>Posted By. {{ $post->user->name }}</a></li>
                <li>{{ $post->created_at }}</li>
            </ul>

            
        </div>
    </div>
@endforeach
<div class="row text-center">
    {{ $posts->links() }}
</div>
@endsection

