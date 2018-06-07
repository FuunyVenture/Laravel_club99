@extends('layouts.admin.app')

@section('title', 'Create/Edit Features')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ url('admin/features') }}" class="back">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
        <h1>
           {{ isset($feature) ? 'Edit' : 'Add' }} Feature
        </h1>

    </section>
    <section class="content">
        <div class="box">
            {{--header content--}}
            <div class="box-header with-border">
                <h3 class="box-title">Feature Details Form</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"></button>
                </div>
            </div>
            {{--end header content--}}
            {{--main content - create/edit a features--}}
            <div class="box-body" data-feature="{{ isset($feature) ? $feature : '' }}">
                {!! Form::open(['url' =>  isset($feature) ? 'admin/features/'.$feature->id  :  'admin/features', 'method' => isset($feature) ? 'put' : 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                {!! Form::hidden('feature_id', isset($feature) ? $feature->id: null) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Name *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('name', old('name', isset($feature) ? $feature->name: null), ['class' => 'form-control validate[required]', 'placeholder'=>'Feature Name']) !!}
                            </div>
                        </div>
                        {{--<div id="checkbox-row" class="form-group">
                            {!! Form::label('is_shipment', 'Is Shipment Feature?', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-sm-8">
                                <input id="is_shipment" type="checkbox" name="is_shipment">
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                {!! Form::submit((isset($feature)?'Update': 'Add'). ' Feature', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            {{--end main content--}}
            <div class="box-footer">
            </div>
        </div>
    </section>
@endsection


@section('js')
    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
            });

            //Initialize Select2 Elements
            $(".select2").select2({
                placeholder: "Please Select",
                allowClear: true
            });


            if($('.box-body').attr('data-feature') != '') {
                feature = JSON.parse($('.box-body').attr('data-feature'));
                if(feature.type == 'shipment' ) {
                    $('#is_shipment').prop('checked', true);
                    $('#checkbox-row').after($('<div id="quantity-row" class="form-group">' +
                            '<label class="control-label col-md-3">Quantity*</label>' +
                            '<div class="col-md-9">' +
                            '<input type="number" name="shipment_quantity" id="shipment_quantity" required>' +
                            '</div>' +
                            '</div>'));
                    $('#shipment_quantity').val(feature.qty);
                }
            }

            $('#is_shipment').change(function () {
                if ($(this).is(":checked")) {
                    $('#checkbox-row').after($('<div id="quantity-row" class="form-group">' +
                            '<label class="control-label col-md-3">Quantity*</label>' +
                            '<div class="col-md-9">' +
                            '<input type="number" name="shipment_quantity" id="shipment_quantity" required>' +
                            '</div>' +
                            '</div>'));
                } else {
                    $('#quantity-row').remove();
                }

            });

            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                    {
                        promptPosition: "bottomRight", scroll: false,
                        prettySelect: true,
                        usePrefix: prefix
                    });
        });
    </script>
@endsection
