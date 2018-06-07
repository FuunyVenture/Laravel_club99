@extends('layouts.frontend.app')

@section('title', 'Confirm Subscription')

@section('css')

@endsection

@section('content')
    {{--content header--}}
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Confirm Subscription</h2>
        </div>
    </div>
    {{--end content header--}}
    {{--main content--}}
    <div class="row">
        <div class="col-md-12">
            @if(isset(\Auth::user()->package->id))
                <h3>You are going to change your <b>{{ \Auth::user()->package->name }}</b> Package with
                    <b>{{ $package->name }}</b> Package.</h3>
            @else
                <h3>You are going to Subscribe to <b>{{ $package->name }}</b> Package.</h3>
            @endif
            {!! Form::open(['url' =>  'member/subscription/swap-subscription', 'method' => 'post']) !!}
            {!! Form::hidden('package_id', $package->id) !!}
            {!! Form::submit('Continue in Subscription >>', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
