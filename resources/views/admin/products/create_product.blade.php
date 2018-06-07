@extends('layouts.admin.app')

@section('title', 'Create product')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12 back" style="margin-left: 15px;"><a href="{{ url('admin/products') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12 padding-bottom"><h3>Add Product</h3></div>
        </div>
        {{--end header content--}}
        {{-- open form to create a product --}}
        <form method="post" action="{{url('admin/products')}}" novalidate>
            {{csrf_field()}}
            {{--main content--}}
            <div class="new-box" style="padding:30px;">
                <div class="row">
                    <div class="col-xs-12 col-lg-8">
                        <div class="row padding-bottom">
                            <label class="col-xs-6 col-md-4 control-label">Name of product:</label>
                            <div class="col-xs-6 col-md-4">
                                <div class="input-group flex">
                                    <div class="col-xs-12">
                                        <input id="name" type="text" class="form-control" value="{{old('name')}}"
                                               name="name" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row padding-bottom">
                            <label class="col-xs-6 col-md-4 control-label">Price:</label>
                            <div class="col-xs-6 col-md-4">
                                <div class="input-group flex">
                                    <div class="col-xs-1 s-regular size50"><span>$</span></div>
                                    <div class="col-xs-11">
                                        <input id="price" class="form-control" value="{{old('cost')}}"
                                               type='number'
                                               name="cost" step='0.01'
                                               placeholder='0.00' style="text-align:right;" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-baseline">
                            <div class="col-xs-4 col-md-3 margin-tb os-regular size50">Tax class</div>
                            <div class="col-xs-4 col-md-3">
                                <div class="radio">
                                    <label class="control-label">
                                        <input type="radio" name="taxable" value="taxable"
                                               @if(old('taxable') == 'taxable')checked="checked"@endif
                                               style="margin-top: -5px;">
                                        <strong>Taxable</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-3">
                                <div class="radio">
                                    <label class="control-label">
                                        <input type="radio" name="taxable" value="none"
                                               @if(!old('taxable'))checked="checked"@elseif(old('taxable') == 'none')checked="checked"@endif
                                               style="margin-top: -5px;">
                                        <strong>None</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary" type="submit">Save product</button>
                    </div>
                </div>
            </div>
            {{--end main content--}}
        </form>
        {{--close form --}}
    </section>

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