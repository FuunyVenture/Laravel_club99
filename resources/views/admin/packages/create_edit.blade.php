@extends('layouts.admin.app')

@section('title', 'Packages')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ url('admin/packages') }}" class="back">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
        <h3>
            {{ isset($package) ? 'Edit' : 'Add' }} Package
        </h3>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                {!! Form::open(['url' =>  isset($package) ? 'admin/packages/'.$package->id  :  'admin/packages', 'method' => isset($package) ? 'put' : 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                {!! Form::hidden('package_id', isset($package) ? $package->id: null) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Package Details</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', 'Package Name *', ['class' => 'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::text('name', old('name', isset($package) ? $package->name: null), ['class' => 'form-control validate[required]', 'placeholder'=>'Package Name']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('cost', 'Cost *', ['class' => 'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::number('cost', old('cost',  isset($package) ? $package->cost : null), ['class' => 'form-control validate[required,custom[number],min[0]]', 'placeholder'=>'Cost', 'step' => "0.01"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('cost_per', 'Cost Per *', ['class' => 'control-label col-md-4']) !!}
                            <div class="col-md-8">
                                {!! Form::text('cost_per', old('cost_per', isset($package) ? $package->cost_per : null ), ['class' => 'form-control validate[required]', 'placeholder'=>'Cost Per']) !!}
                            </div>
                        </div>
                    </div><!-- .col-md-6 -->
                    <div class="col-md-6">
                        <h4>Package Features List</h4>
                        <div class="row">
                            @foreach($features as $feature)
                                <div class="form-group flex">
                                    <div class="col-md-1">
                                        {!! Form::checkbox('features[]', $feature->id, (isset($package) && ($package->features->contains($feature->id)) ) ? true : false, ['class'=>'minimal']) !!}
                                    </div>
                                    <div class="col-md-11">
                                        {!! Form::label('features', $feature->name, ['class' => 'col-md-11', 'style'=>'text-align:left;']) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit((isset($package)?'Update': 'Add'). ' Package', ['class'=>'btn btn-primary pull-right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->

@endsection


@section('js')
    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
            });

            //Initialize Select2 Elements
            $(".select2").select2({
                placeholder: "Please Select",
                allowClear: true
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
