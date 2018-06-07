@extends('layouts.frontend.app')

@section('title', $post->title)

@section('meta_desc', $post->meta_desc)

@section('meta_keywords', $post->meta_keywords)

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">{{ $post->title }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $post->content !!}
        </div>
    </div>
@endsection

@section('js')
@endsection
