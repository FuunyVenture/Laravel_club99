{{-- Dashboard it's a quick overview of member activity --}}

@extends('layouts.member.app')

@section('title', 'Dashboard')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection


@section('content')
    <div class="remove-margin">
        {{--content header--}}
        <div class="col-xs-12">
            <div class="col-xs-12">
                <h3 class="dashboard-title">Dashboard</h3>
            </div>
        </div>
        {{--end content header--}}
        {{--main content- containers of a quick overview of member activity--}}
        <div class="col-xs-12">

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Shipment arrivals</div>

                    @if(!Auth::user()->shipments()
                                        ->where('status', '=', 'ready_for_pickup')
                                        ->get()
                                        ->isEmpty() &&
                                    !Auth::user()->shipments()
                                        ->where('status', '=', 'ready_for_pickup')
                                        ->orderBy('pickup_date', 'asc')
                                        ->where('pickup_date', '>=', Carbon\Carbon::now())
                                        ->get()
                                        ->isEmpty())
                        <div class="dash-info">You have one package arriving in:</div>
                    @endif
                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-bag fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                @if(!Auth::user()->shipments()
                                        ->where('status', '=', 'ready_for_pickup')
                                        ->get()
                                        ->isEmpty() &&
                                    !Auth::user()->shipments()
                                        ->where('status', '=', 'ready_for_pickup')
                                        ->orderBy('pickup_date', 'asc')
                                        ->where('pickup_date', '>=', Carbon\Carbon::now())
                                        ->get()
                                        ->isEmpty())
                                    <span style="font-size:37px;">
                                        {{Carbon\Carbon::parse(Auth::user()->shipments()
                                            ->where('status', '=', 'ready_for_pickup')
                                            ->orderBy('pickup_date', 'asc')
                                            ->where('pickup_date', '>=', Carbon\Carbon::now())->first()->pickup_date)
                                            ->diffForHumans(Carbon\Carbon::now(), true)}}
                                    </span>
                                @else
                                    <div class="col-xs-12">You have no shipments arriving soon!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('member/shipments')}}">View all shipments 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">{{Auth::user()->subscription->package->name}} subscription</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="subscription-icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                You have
                                <span class="os-bold">{{Carbon\Carbon::parse(Auth::user()->subscription->created_at)->diffForHumans(Carbon\Carbon::parse(Auth::user()->subscription->ends_at), true)}}</span>
                                left
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container-subscription">
                        <div class="col-xs-6">
                            <span class="os-bold">Started:</span>
                            {{Carbon\Carbon::parse(Auth::user()->subscription->created_at)->toDateString()}}
                        </div>
                        <div class="col-xs-6 text-right">
                            <span class="os-bold">Ending:</span>
                            {{Carbon\Carbon::parse(Auth::user()->subscription->ends_at)->toDateString()}}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Total Shipments</div>

                    {{--<div class="dash-info">Shipments used this month:</div>--}}
                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-inbox fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                <span class="os-bold">{{Auth::user()->shipments()->where('status', '!=', 'pending_approval')->count()}}
                                    {{--  / {{Auth::user()->subscription->package->features()->where('type', '=', 'shipment')->first()->qty}}--}}
                                </span>
                                Shipments
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('member/shipments')}}">Add a shipment 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Payments due</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                You have
                                <span class="os-bold">
                                    {{$invoices->count()}}
                                </span>
                                outstanding invoice
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('member/invoices')}}">View all Invoices
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container box-container-address">
                    <div class="col-xs-12 box-head-text">US Shipping Address</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-files-o fa-2x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                <span class="os-bold">{{Auth::user()->firstname . ' ' . Auth::user()->lastname }}</span>
                                <div>
                                    {!! getSetting('US_ADDRESS') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container bottom-container-empty">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="box-head-text text-center">
                        <div class="left-arrow">
                            <img src="{{ asset('assets/dist/img/dashboard/arrow-shops-left.svg') }}"
                                         alt=""/>
                        </div>
                        <span>Our most popular senders</span>
                        <div class="right-arrow">
                            <img src="{{ asset('assets/dist/img/dashboard/arrow-shops-right.svg') }}"
                                         alt=""/>
                        </div>
                    </div>

                    <div class="col-xs-12 top10">
                        <div class="popular-senders text-center">
                            <img src="{{ asset('assets/dist/img/member/shop/amazon.png') }}" alt=""/>
                            <img src="{{ asset('assets/dist/img/member/shop/h&m.png') }}" alt=""/>
                            <img src="{{ asset('assets/dist/img/member/shop/zara.png') }}" alt=""/>
                            <img src="{{ asset('assets/dist/img/member/shop/amazon.png') }}" alt=""/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--end main content--}}
    </div>
@endsection
@section('js')
    <script type="text/javascript">

    </script>
@endsection
