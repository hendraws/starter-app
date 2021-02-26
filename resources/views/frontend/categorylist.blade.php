@extends('frontend.layout.master')
@section('content')
@foreach ($category as $list)
    <div class="post post-row">
        <a class="post-img" href="{{ action('BlogController@detail', $list->slug) }}"><img src="{{ asset($list->image) }}" alt=""></a>
        <div class="post-body">
            <div class="post-category">
                <a href="{{ action('BlogController@category', $list->category->slug) }}">{{ $list->category->name }}</a>
            </div>
            <h3 class="post-title"><a href="{{ action('BlogController@detail', $list->slug) }}">{{ $list->title }}</a></h3>
            <ul class="post-meta">
                <li>Posted By. {{ $list->user->name }}</a></li>
                <li>{{ $list->created_at }}</li>
            </ul>

            
        </div>
    </div>
@endforeach
<div class="row text-center">
    {{ $category->links() }}
</div>
@endsection

