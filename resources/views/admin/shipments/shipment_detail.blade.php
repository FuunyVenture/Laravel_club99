@extends('layouts.admin.app')

@section('title', 'Shipment Detail')

@section('css')

@endsection

@section('content')
    <div class="content">
        <div class="row">
            {{--content header--}}
            <div class="col-xs-12 back">
                <a href="{{ url('admin/shipments') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
            </div>
            <div class="col-xs-12"><h3>Shipment detail</h3></div>
            {{--end content header--}}
            {{--main content-display shipment details--}}
            <div class="col-xs-12">
                <div class="well-box link-color">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="flex-only-vertical">
                                <span class="invoice-address">ShipmentID:</span>
                                <div class="completed-invoice">
                                    <strong>{{$shipment->id}}</strong>
                                </div>
                                <span class="btn btn-{{$shipment->status}}">
                                    {{$shipmentStatusMap[$shipment->status]}}
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 info">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Sender: </span>
                                    <span class="completed-invoice">{{$shipment->retailer->name}}</span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Tracking number: </span>
                                    <span class="completed-invoice">
                                                @if($shipment->tracking_number)
                                            {{$shipment->tracking_number}}
                                        @else
                                            none
                                        @endif
                                            </span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Order number: </span>
                                    <span class="completed-invoice">
                                                @if($shipment->order_number)
                                            {{$shipment->order_number}}
                                        @else
                                            none
                                        @endif
                                            </span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Weight: </span>
                                    <span class="completed-invoice">
                                                @if($shipment->weight)
                                            {{$shipment->weight}}lbs
                                        @else
                                            none
                                        @endif
                                            </span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Dimensions: </span>
                                    <span class="completed-invoice">
                                                @if($shipment->length && $shipment->width && $shipment->height)
                                            {{$shipment->length}}cm x {{$shipment->width}}cm
                                            x {{$shipment->height}}cm
                                        @else
                                            none
                                        @endif
                                            </span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <span class="invoice-address">Uploaded Invoice: </span>
                                    <span class="completed-invoice">
                                        @if(isset($shipment->uploaded_file))
                                            <a href="{{url($shipment->uploaded_file)}}?download=1">View</a>
                                            |
                                            <a class="message_box" data-box="#message-box-change">Change</a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well-box">
                    <div class="row">
                        <h4 class="col-xs-12 detail-head-line">Member details</h4>
                        <div class="col-xs-12 col-sm-6 info">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span class="invoice-address">Member id:</span>
                                    <span class="completed-invoice">{{$shipment->user->id}}</span>
                                </div>
                                <div class="col-xs-12">
                                    <span class="invoice-address">Address:</span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->address1}}
                                    </span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->address2}}
                                    </span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->city}}
                                    </span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->country}}
                                    </span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->zip_code}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 info">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span class="invoice-address">First name:</span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->firstname}}
                                    </span>
                                </div>

                                <div class="col-xs-12">
                                    <span class="invoice-address">Last name:</span>
                                    <span class="completed-invoice">
                                        {{$shipment->delivery_details->lastname}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well-box">
                    <div class="row">
                        <div class="col-xs-12 col-lg-7">
                            <h4 class="detail-head-line">Purchase details</h4>
                            <div class="panel panel-default detail">
                                <table id="data_table" class="table datatable dt-responsive detail"
                                       style="width:100%; border-bottom:1px solid grey;">
                                    <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Item value</th>
                                        <th>Classification</th>
                                        <th>Classification duty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $subTotal = 0; $totalDuty = 0; ?>
                                    @foreach($shipment->items as $item)
                                        <tr>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>${{number_format($item->cost, 2, '.', ',')}}</td>
                                            <td>{{$item->tax->description}}</td>
                                            <td>{{$item->tax->duty}}%</td>
                                        </tr>
                                        <?php $subTotal += $item->qty * $item->cost; ?>
                                        <?php $totalDuty += ($item->qty * $item->cost) * $item->tax->duty / 100; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <div class="os-regular size44">
                                    Subtotal:
                                    <strong>${{number_format($subTotal, 2, '.', ',')}}</strong>
                                </div>
                                <div class="os-regular size44">
                                    Shipping cost:
                                    ${{number_format($shipment->retailer_shipping_cost, 2, '.', ',')}}
                                </div>
                                <div class="os-regular size44">
                                    Tax:
                                    ${{number_format($shipment->retailer_tax, 2, '.', ',')}}
                                </div>
                                <div class="os-regular size44 margin-tb">
                                    Total shipment value:
                                    <span class="completed-invoice">
                                        ${{number_format(($subTotal + $shipment->retailer_shipping_cost + $shipment->retailer_tax), 2, '.', ',')}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-5">
                            <h4 class="detail-head-line">Shipment costs</h4>
                            <div class="row well-box link-color flex">
                                <div class="col-xs-6 line-height">
                                    <div>
                                        <span class="invoice-address"><strong>Total duty:</strong></span>
                                        <span class="invoice-address text-nowrap">
                                            $ {{number_format($totalDuty, 2, '.', ',')}}
                                        </span>
                                    </div>

                                    <div>
                                        <span class="invoice-address">
                                            <strong>Total VAT{{ '@' . getSetting('VAT_TAX') }}%:</strong>
                                        </span>
                                        <span class="invoice-address text-nowrap">
                                            $ {{number_format($shipment->duty_tax, 2, '.', ',')}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    @if($shipment->product->invoices->first())
                                        <span class="invoice-address well-box">
                                            <a href="{{url('/admin/invoices/' . $shipment->product->invoices->first()->id)}}">
                                                View invoice
                                            </a>
                                        </span>
                                    @elseif($shipment->status != 'pending_approval')
                                        <span class="invoice-address well-box">
                                            <a href="{{url('/admin/invoices/create/user/' . $shipment->user->id . '/shipment/' . $shipment->id)}}">
                                                Create invoice
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <a class="btn btn-primary"
                        href="{{ url('admin/shipments/'.$shipment->id.'/edit') }}" class="btn btn-edit">
                        Edit shipment
                    </a>
                    @if($shipment->status == 'pending_approval')
                        <a class="btn btn-primary"
                           href="{{url('admin/shipments/' . $shipment->id . '/approve')}}">
                            Approve shipment
                        </a>
                        <a class="btn btn-primary"
                           href="{{url('admin/shipments/' . $shipment->id . '/cancel')}}">
                            Cancel shipment
                        </a>
                    @elseif($shipment->status == 'ordered')
                        <a class="btn btn-primary"
                           href="{{url('admin/shipments/' . $shipment->id . '/collect')}}">
                            Collect shipment
                        </a>
                    @endif
                </div>
            </div>
            {{--end main content--}}
        </div>
    </div>
    {{--message box- change shipment invoice--}}
    <div class="message-box animated fadeIn" id="message-box-change">
        <div class="mb-change-shipment-invoice mb-container">
            <div class="mb-middle" style="color:white">
                <form id="change-shipment-invoice" action="{{url('admin/upload-shipment-invoice')}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12 flex">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="hidden" name="shipment_id" value="{{$shipment->id}}">
                                    <input type="file" name="shipment_invoice" accept="application/pdf,image/*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-edit" type="submit">Upload</button>
                                    <a id="close-wizard" class="btn btn-primary mb-control-close">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{--end message box--}}
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            });
        });
    </script>
@endsection