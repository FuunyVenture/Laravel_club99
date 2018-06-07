@extends('layouts.frontend.app')

@section('title', $page->title)

@section('meta_desc', $page->meta_desc)

@section('meta_keywords', $page->meta_keywords)

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">{{ $page->title }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $page->content !!}
        </div>
    </div>
@endsection

@section('js')
@endsection
