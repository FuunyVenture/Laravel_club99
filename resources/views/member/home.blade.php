@extends('layouts.frontend.app')

@section('title', 'Home')

@section('css')

@section('content')
    @if(!Auth::user()->package()->get()->isEmpty())
        @include('member.dashboard')
    @else
        @include('member.subscription')
    @endif
@endsection
