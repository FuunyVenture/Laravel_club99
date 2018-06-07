{{--This view generate a GUI with a list of retailers added by admin--}}
@extends('layouts.member.app')

@section('title', 'Shop')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection

@section('content')
    {{--open section--}}
    <div class="row">
        {{--content header--}}
        <div class="col-xs-12" style="margin-left: 40px;">
            <h3>Shop</h3>
        </div>
        {{--end content header--}}
        {{--main content-list of retailers--}}
        <div class="col-xs-12">
            @foreach($retailers as $retailer)
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="box-shop">
                        {{--the following code was used for discount--}}
                        {{--<div class="row text-center">
                            <label class="sale">Get 5% off now</label>
                        </div>--}}

                        <div class="col-xs-12" style="padding-top: 30px;">
                            <div class="row text-center">
                                <img class="image" src="{{url($retailer->logo)}}">
                            </div>
                            <div class="row text-center padding10">
                                <a class="btn btn-shop" href="{{url($retailer->website)}}" target="_blank">
                                    Shop {{$retailer->name}} now
                                </a>
                            </div>
                            {{--the following code was used for coupon code--}}
                            {{--<div class="row text-center padding10 os-bold size50">Use coupon code at checkout: </div>
                            <div class="row text-center os-bold size50">
                                club99loveSave
                            </div>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{--end main content--}}
    </div>
    {{--end section--}}
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
