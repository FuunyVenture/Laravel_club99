@extends('layouts.frontend.app')

@section('title', 'Help')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
    <style>
        .flat .plan {
            border-radius: 2px;
            list-style: none;
            padding: 0 0 20px;
            margin: 0 0 15px;
            background: #fff;
            text-align: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .2), 0 1px 1px 0 rgba(0, 0, 0, .14), 0 2px 1px -1px rgba(0, 0, 0, .12);
        }

        .flat .plan li.plan-header {
            padding: 15px;
            font-size: 24px;
            line-height: 24px;
            color: #1c181d;
            background: #fff;
            border-bottom: 3px solid #c12036;
        }

        .flat .plan li.package-feature {
            padding-top: 15px;
            padding-bottom: 15px;
            border-top: 2px solid #dcdcdc;
        }

        .flat .plan li.package-feature:nth-child(2) {
            border: none;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12" style="text-align:center"><h2>How it works</h2></div>
        </div>
        <div class="row how-works-box">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <span class="text">You sign up for one of our subscription packages</span>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="row flat">
                            @foreach($packages as $package)
                                <div class="col-xs-12 col-sm-4">
                                    <ul class="plan plan1">
                                        <li class="plan-header">
                                            <div class="row">
                                                <div class="col-md-12 package-name">
                                                    {{$package->name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 package-cost">
                                                    <span class="dollar">$</span>
                                                    <span class="cost">{{$package->cost}}</span>
                                                    <span class="cost-per">/{{$package->cost_per}}</span>
                                                </div>
                                            </div>
                                        </li>
                                        @if(count($package->features) > 0)
                                            <li class="package-feature">
                                                {{$package->features->first()->name}}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="border"></div>
                <div class="row padding30">
                    <div class="col-xs-12 col-sm-7">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="small-box-container flat-xs">
                                    <img class="image" src="{{ asset('uploads/member/shop/h&m.png') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="small-box-container flat-xs">
                                    <img class="image" src="{{ asset('uploads/member/shop/h&m.png') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="small-box-container flat-xs">
                                    <img class="image" src="{{ asset('uploads/member/shop/h&m.png') }}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-sm-offset-1">
                        <span class="text">Buy from one of our popular affiliate shops</span>
                    </div>
                </div>
                <div class="border"></div>
                <div class="row padding30 flat">
                    <div class="col-xs-12 col-sm-4">
                        <span class="text">Send your shopping parcel to our US depot</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 text-center">
                        <img class="image" src="{{ asset('uploads/frontend/Map.svg') }}">

                    </div>
                </div>
                <div class="border"></div>
                <div class="row padding30 flat">
                    <div class="col-xs-12 col-sm-8 text-center">
                        <img class="image" src="{{ asset('uploads/frontend/Homeaddress.svg') }}">

                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <span class="text">We send your parcel to your home address</span>
                    </div>
                </div>
                <div class="row three-options">
                    <div class="col-xs-12 col-sm-4">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <img class="image" src="{{ asset('uploads/frontend/Lowshipping.svg') }}">

                            </div>
                            <div class="col-xs-12 text-center">
                                <span>Low shipping rates</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 flat">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <img class="image" src="{{ asset('uploads/frontend/safeandsecure.svg') }}">

                            </div>
                            <div class="col-xs-12 text-center">
                                <span>Safe and secure</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 flat">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <img class="image" src="{{ asset('uploads/frontend/discounts.svg') }}">

                            </div>
                            <div class="col-xs-12 text-center">
                                <span>Get discounts on purchases</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12" style="text-align:center"><h2>Join clubb99.love now!</h2></div>
                </div>
                <div class="row">
                    <div class="col-xs-12" style="text-align:center"><a href="{{ url('/guest#signup') }}"
                                                                        class="btn btn-primary">Sign up</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
