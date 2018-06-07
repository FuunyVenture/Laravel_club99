@extends('layouts.admin.app')

@section('title', 'Create coupons')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/coupons') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12 padding-bottom"><h3>Create coupon</h3></div>
        </div>
        {{--end header content--}}
        {{--main content--}}
        <div class="new-box">
            <div class="row">
                <div class="col-xs-12 padding-tb">
                    {{--open form - fields for adding a coupon--}}
                    <form action="{{url('/admin/coupons')}}" method="POST" novalidate>
                        {{csrf_field()}}
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Coupon code:</label>
                            <div class="col-md-7 col-lg-4">
                                <div class="input-group flex left">
                                    <div clas="col-md-3">
                                        <input id="coupon_code" type="text" class="form-control" name="coupon_code"
                                               placeholder="0.00"
                                               value="{{old('coupon_code')}}"
                                               required>
                                    </div>
                                    {{--<div class="col-md-5 os-regular size44">
                                        <span>15 characters</span>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Amount:</label>
                            <div class="input-group">
                                <div class="col-md-5">
                                    <input id="amount" type="text" class="form-control" name="amount"
                                           value="{{old('amount')}}"
                                           placeholder="0.00" required>
                                </div>
                                <div class="col-md-7 flex">
                                    <div class="radio" style="margin-top:0px">
                                        <label class="flex">
                                            <input type="radio" name="type" value="percentage"
                                                   @if(!old('type'))checked="checked"
                                                   @elseif(old('type') == 'percentage')checked="checked"@endif
                                            >
                                            <div class="col-md-7 os-regular"><span>%</span></div>
                                        </label>
                                    </div>
                                    <div class="radio" style="margin-top:0px">
                                        <label class="flex">
                                            <input type="radio" name="type" value="dollars"
                                                   @if(old('type') && old('type') == 'dollars')checked="checked"@endif
                                            >
                                            <div class="col-md-7 os-regular"><span>$</span></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Start date:</label>
                            <div class="col-md-7 col-lg-4 os-regular size44">
                                <input type="text" placeholder="Start date" id="start_date" name="start_date" required
                                       value="{{old('start_date')}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 control-label">End date:</label>
                            <div class="col-md-7 col-lg-4 os-regular size44">
                                <input type="text" placeholder="End date" id="end_date" name="end_date" required
                                       value="{{old('end_date')}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-primary" type="submit">Save coupon</button>
                            </div>
                        </div>
                    </form>
                    {{--close form--}}
                </div>
            </div>
        </div>
        {{--end main content--}}
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#start_date').datepicker({
                format: "dd/mm/yyyy"
            }).on('changeDate', function (newStartDate) {
                var startDate = newStartDate.date;
                $('#end_date').datepicker('setStartDate', startDate);
            });

            $('#end_date').datepicker({
                format: "dd/mm/yyyy"
            }).on('changeDate', function(newEndDate) {
                var endDate = newEndDate.date;
                $('#start_date').datepicker('setEndDate', endDate);
            });
        });
    </script>
@endsection