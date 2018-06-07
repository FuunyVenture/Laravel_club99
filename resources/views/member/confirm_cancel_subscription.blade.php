@extends('layouts.frontend.app')

@section('title', 'Confirm Cancel Subscription')

@section('css')

@endsection

@section('content')
    {{--content header--}}
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Confirm Cancel Subscription</h2>
        </div>
    </div>
    {{--end content header--}}
    {{--main content--}}
    <div class="row">
        <div class="col-md-12">
            <h3>You are going to Cancel your <b>{{ \Auth::user()->package->name }}</b> Package.</h3>

            {!! Form::open(['url' =>  'member/subscription/cancel', 'method' => 'delete']) !!}
            {!! Form::submit('Continue in Cancel Subscription >>', ['class'=>'btn btn-warning']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
