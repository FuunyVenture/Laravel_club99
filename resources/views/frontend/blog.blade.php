@extends('layouts.frontend.app')

@section('title', 'Blog')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Blog</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($posts as $post)
                <div class="col-md-11">
                    <h4><a href="{{ url($post->slug) }}">{{ $post->title }}</a></h4>
                    <div class="post-content">
                        {!! $post->excerpt()  !!}
                    </div>
                    <div class="read-more">
                        <a href="{{ url($post->slug) }}">Read More &gt;&gt;</a>
                    </div>
                    <hr/>
                </div>
            @endforeach
        </div>
        <div class="col-md-12">
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
