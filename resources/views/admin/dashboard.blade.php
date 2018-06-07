{{-- Dashboard it's a quick overview of member/admin activity --}}

@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="remove-margin">

        <div class="col-xs-12">
            <div class="col-xs-12">
                <h3 class="dashboard-title">Dashboard</h3>
            </div>
        </div>

        <div class="col-xs-12">

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Shipment arrivals</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-shopping-bag fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                You have no shipments arriving soon!
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/shipments')}}">View all shipments
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Total Shipments</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-inbox fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                <span class="os-bold">{{$approvedShipments}}</span>
                                Shipments
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/shipments')}}">Add a shipment
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Payments Due</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                You have
                                <span class="os-bold">{{$approvedShipments}}</span>
                                outstanding invoices 
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link dash-link-active">
                            <a href="{{url('admin/shipments')}}">View all Invoices
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
                                <span class="os-bold">Member Test 2</span>
                                <div>100 MAIN ST, PO BOX 1022</div>
                                <div>SEATTLE WA 98104, USA</div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container bottom-container-empty">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">ExtraShopper subscription</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right">
                                <i class="subscription-icon" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-12">
                                You have 
                                <span class="os-bold">1 year left</span>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container-subscription">
                        <div class="col-xs-6">
                            <span class="os-bold">Started:</span> 2017-01-17
                        </div>
                        <div class="col-xs-6 text-right">
                            <span class="os-bold">Ending:</span> 2018-01-17
                        </div>
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
                        <span class="">Our most popular senders</span>
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

            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">Total shipments</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right">
                                <img src="{{ asset('assets/dist/img/dashboard/totalshipmentsicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                Total of all approved shipments
                                <div class="os-bold">
                                    <span>{{$approvedShipments}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/shipments')}}">View shipments
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">Shipments approvals</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right">
                                <img src="{{ asset('assets/dist/img/dashboard/shipmentapprovalsicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                Shipment orders waiting approval
                                <div class="os-bold">
                                    <span>{{$pendingShipments}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/shipments')}}">View shipments
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">Shipments collection</div>
                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right" >
                                <img src="{{ asset('assets/dist/img/dashboard/shipmentcollectionicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                Shipments ready to be collected
                                <div class="os-bold">
                                    <span>{{$pickupReadyShipments}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/shipments')}}">View shipments
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">New members</div>
                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right">
                                <img src="{{ asset('assets/dist/img/dashboard/newmembersicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                New members this week
                                <div class="os-bold">
                                    <span>{{$newMembers}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/users')}}">View members
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">

                    <div class="col-xs-12 box-head-text">Unpaid invoices</div>
                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4 text-right">
                                <img src="{{ asset('assets/dist/img/dashboard/unpaidinvoicesicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                Outstanding payments on invoices
                                <div class="os-bold">
                                    <span>{{$unpaidInvoices}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/invoices')}}">View invoices
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-container">
                    <div class="col-xs-12 box-head-text">Invoice payments</div>

                    <div class="col-xs-12 top10">
                        <div class="flex-vertical">
                            <div class="col-xs-4">
                                <img src="{{ asset('assets/dist/img/dashboard/invoicepaymentsicon.svg') }}"
                                     alt=""/>
                            </div>
                            <div class="col-xs-12">
                                Payments received this week
                                <div class="os-bold">
                                    <span>{{$paidInvoices}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-container">
                        <div class="dash-link">
                            <a href="{{url('admin/invoices')}}">View invoices
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xs-12 col-md-dash col-lg-4">
                <div class="box-cont">
                    <div class="row">
                        <div class="col-xs-12 padding-bottom">Our most popular retailers</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="small-box-container">
                            Amazon
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="small-box-container">
                            FOREVER 21
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="small-box-container">
                                H&M
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection

@section('js')
@endsection
