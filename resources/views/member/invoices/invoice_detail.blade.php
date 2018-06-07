@extends('layouts.member.app')

@section('title', 'Invoice Detail')

@section('css')

@endsection
{{--open section--}}
@section('content')
    <div class="content">
        <div class="row">
            {{--content header--}}
            <div class="col-xs-12 back"><a href="{{ url('member/invoices') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
            <div class="col-xs-12 col-sm-6 page-head-line">Pay Invoice</div>
            <div class="col-xs-12 col-sm-6">
                <div class="invoice-due text-right">
                    @if($invoice->status == 'unpaid')
                        <span>Due {{\Carbon\Carbon::parse($invoice->due_date)->diffForHumans()}}</span>
                        <a href="{{ url('member/invoices/' . $invoice->id . '/pay') }}"
                           class="btn btn-primary btn-invoices">
                            Pay invoice
                        </a>
                    @else
                        {{--<div class="col-xs-11 text-right" style="color:#c12036;">
                            Paid
                        </div>--}}
                    @endif
                </div>
                {{--end content header--}}
            </div>
            {{--main content--}}
            <div class="col-xs-12">
                <div class="well-box invoice-pay">
                    <div class="row" style="border-bottom: 1px solid #d6d6d6;">
                        <div class="col-xs-12 col-sm-6 invoice-address">
                            <img class="svg"
                                src="{{ asset('assets/dist/img/Club99love-logo-red.svg') }}"
                                alt=""
                                style="width: 120px;"/>
                            <span>
                                <div>
                                    {{$invoice->user->home_address->address1}},
                                    {{$invoice->user->home_address->address2}},
                                    {{$invoice->user->home_address->city}}
                                </div>
                                <div>
                                    {{$invoice->user->home_address->state}},
                                    {{$invoice->user->home_address->zip_code}}
                                </div>
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-6 text-right vat">
                            VAT Sales Invoice / VAT Sales Receipt
                        </div>
                    </div>

                    <div class="row middle">
                        <div class="col-xs-8">
                            <h3>
                                {{$invoice->user->firstname}}
                                {{$invoice->user->lastname}}
                            </h3>     
                            <div class="invoice-address">
                                {{$invoice->user->bill_address->address1 or ''}}
                                {{$invoice->user->bill_address->address2 or '' }}
                            </div>
                            <div class="invoice-address">
                                {{$invoice->user->bill_address->city or ''}}
                                {{$invoice->user->bill_address->state or ''}}
                                {{$invoice->user->bill_address->zip_code or ''}}
                            </div>
                        </div>

                        <div class="col-xs-4">    
                            <span class="col-xs-4">
                                <div class="invoice-address">Invoice number:</div>
                                <div class="completed-invoice">{{$invoice->id}}</div>
                            @if(isset($invoice->store_payment))
                                <div class="invoice-address">Receipt Code:</div>
                                <div class="completed-invoice">{{$invoice->store_payment->code}}</div>
                            @endif
                            </span>
                            <span class="col-xs-4">
                                <div class="invoice-address">Invoice date:</div>
                                <div class="completed-invoice">
                                    {{\Carbon\Carbon::parse($invoice->created_at)->format('d-M-Y')}}
                                </div>
                            </span>
                            <span class="col-xs-4">
                                <div class="invoice-address">Invoice due date:</div>
                                <div class="completed-invoice">
                                    {{\Carbon\Carbon::parse($invoice->due_date)->format('d-M-Y')}}
                                </div>
                            </span>
                        </div>
                    </div>

                    <table id="data_table" class="table datatable dt-responsive table-striped pay-invoice">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Duty cost</th>
                            <th>Tax</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $subTotal = 0; $totalVat = 0; ?>
                        @foreach($invoice->products as $product)
                            <tr>
                                <td>
                                    @if($product->type == 'shipment')
                                        <a href="{{url('member/shipments/' . $product->shipment->id)}}">
                                            {{$product->shipment->name}}
                                        </a>
                                    @elseif($product->type == 'fee')
                                        {{$product->fee->name}}
                                    @elseif($product->type == 'package')
                                        {{$product->package->name}}
                                    @else
                                        Coupon {{$product->coupon->code}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 'shipment')
                                        ${{number_format($product->shipment->duty_cost, 2, '.', ',')}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 'shipment')
                                        ${{number_format($product->shipment->duty_tax, 2, '.', ',')}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 'shipment')
                                        ${{number_format(($product->shipment->duty_cost + $product->shipment->duty_tax), 2, '.', ',')}}
                                    @elseif($product->type == 'fee')
                                        ${{$product->fee->cost}}
                                    @elseif($product->type == 'package')
                                        ${{$product->package->cost}}
                                    @else
                                        ${{$product->coupon->type == 'percentage' ? (0 - ($product->coupon->value / 100) * $invoice->total) : (0 - $product->coupon->value)}}
                                    @endif
                                </td>
                            </tr>
                            <?php
                            if ($product->type == 'shipment') {
                                $subTotal += $product->shipment->duty_cost + $product->shipment->duty_tax;
                            } else if ($product->type == 'fee') {
                                $subTotal += $product->fee->cost;

                                if ($product->fee->taxable == 'taxable') {
                                    $totalVat += getSetting('VAT_TAX') / 100 * $product->fee->cost;
                                }
                            } else if ($product->type == 'package') {
                                $subTotal += $product->package->cost;
                            } else {
                                $subTotal -= $product->coupon->type == 'percentage' ? ($product->coupon->value / 100) * $invoice->total : $product->coupon->value;
                            }

                            if ($subTotal < 0) $subTotal = 0;
                            ?>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="os-regular text-right size44">
                        <div>
                            Subtotal:
                            <span class="os-bold">${{number_format($subTotal, 2, '.', ',')}}</span>
                        </div>
                        <div>
                            Total VAT{{ '@' . getSetting('VAT_TAX') }}%:
                            ${{number_format($totalVat, 2, '.', ',')}}
                        </div>
                        <div>
                            Total shipment value:
                            <span class="os-bold total-price">
                                ${{number_format($subTotal + $totalVat, 2, '.', ',')}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            {{--end main content--}}
        </div>
    </div>
@endsection
{{--end section--}}
@section('js')

@endsection