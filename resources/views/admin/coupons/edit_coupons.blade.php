@extends('layouts.admin.app')

@section('title', 'Edit coupons')

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
            <div class="col-xs-12 padding-bottom"><h3>Edit coupon</h3></div>
        </div>
        {{--end header content--}}
        {{--open form - fields for editing a coupon --}}
        <form action="{{url('admin/coupons/' . $coupon->id)}}" method="POST">
            {{method_field('PUT')}}
            {{csrf_field()}}
            {{--main content--}}
            <div class="new-box">
                <div class="row">
                    <div class="col-xs-12 padding-tb">
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Coupon code:</label>
                            <div class="col-md-7 col-lg-4">
                                <div class="input-group flex left">
                                    <div clas="col-md-3">
                                        <input id="coupon_code" type="text" class="form-control" name="coupon_code"
                                               placeholder="0.00"
                                               value="@if(old('coupon_code')){{old('coupon_code')}}@else{{$coupon->code}}@endif"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Amount:</label>
                            <div class="input-group">
                                <div class="col-md-5">
                                    <input id="amount" type="text" class="form-control"
                                           name="amount"
                                           value="@if(old('amount')){{old('amount')}}@else{{$coupon->value}}@endif"
                                           placeholder="0.00" required>
                                </div>
                                <div class="col-md-7 flex">
                                    <div class="radio" style="margin-top:0px">
                                        <label class="flex">
                                            <input type="radio" name="type" value="percentage"
@if(!old('type') && $coupon->type=='percentage')checked="checked"@elseif(old('type') == 'percentage')checked="checked"@endif
                                            >
                                            <div class="col-md-7 os-regular"><span>%</span></div>
                                        </label>
                                    </div>
                                    <div class="radio" style="margin-top:0px">
                                        <label class="flex">
                                            <input type="radio" name="type" value="dollars"
@if(!old('type') && $coupon->type=='dollars')checked="checked"@elseif(old('type') == 'dollars')checked="checked"@endif
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
                                <input type="text"
                                       value="@if(old('start_date')){{old('start_date')}}@else{{\Carbon\Carbon::parse($coupon->start_date)->format('d/m/Y')}}@endif"
                                       placeholder="Start date"
                                       id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 control-label">End date:</label>
                            <div class="col-md-7 col-lg-4 os-regular size44">
                                <input type="text"
                                       value="@if(old('end_date')){{old('end_date')}}@else{{\Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y')}}@endif"
                                       placeholder="End date" id="end_date" name="end_date" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end main content--}}
            {{--footer content--}}
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="os-bold size50" href="{{url('admin/coupons/' . $coupon->id . '/delete')}}">
                        Delete coupon
                    </a>
                    <button type="submit" class="btn btn-primary">Save coupon</button>
                </div>
            </div>
            {{--end footer content--}}
        </form>
        {{--close form --}}
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var startDateValues = $('#start_date').val().split('/');
            var endDateValues = $('#end_date').val().split('/');
            var startDate = new Date(parseInt(startDateValues[2]), (parseInt(startDateValues[1]) - 1), parseInt(startDateValues[0]));
            var endDate = new Date(parseInt(endDateValues[2]), (parseInt(endDateValues[1]) - 1), parseInt(endDateValues[0]));

            $('#start_date').datepicker({
                format: "dd/mm/yyyy",
                endDate: endDate
            }).on('changeDate', function (newStartDate) {
                var startDate = newStartDate.date;
                $('#end_date').datepicker('setStartDate', startDate);
            });

            $('#end_date').datepicker({
                format: "dd/mm/yyyy",
                startDate: startDate
            }).on('changeDate', function(newEndDate) {
                var endDate = newEndDate.date;
                $('#start_date').datepicker('setEndDate', endDate);
            });
        });
    </script>
@endsection