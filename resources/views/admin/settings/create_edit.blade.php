@extends('layouts.admin.app')

@section('title', 'Settings')

@section('css')
    <!-- tags in input field -->
    {!! Html::style('assets/plugins/jquery-tagit-master/css/tagit.css') !!}
    {!! Html::style('assets/plugins/jquery-tagit-master/css/tagit.ui-zendesk.css') !!}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-gear"></i> {{ isset($setting) ? 'Edit' : 'Add' }} Setting
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @if(isset($setting) && $setting->key_cd == 'COUNTRIES')
            <div class="box">
                {{--<div class="box-header with-border">
                    <h3 class="box-title">Setting Details Form</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>--}}
                <div class="box-body">
                    {!! Form::open(['url' => isset($setting) ? URL::to('admin/settings/'.$setting->id )  :  URL::to('admin/settings') ,'files' => true, 'method' => isset($setting) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                    {!! Form::hidden('setting_id', isset($setting) ? $setting->id: null) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('key_cd', 'Key *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                @if(isset($setting))
                                    {!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key','readonly']) !!}
                                @else
                                    {!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key']) !!}

                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'Type *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                {!! Form::text('type', old('type', isset($setting) ? $setting->type : $type), ['class' => 'form-control validate[required]', 'placeholder'=>'Type', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_value', 'Display Value *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                {!! Form::text('display_value', old('display_value', isset($setting) ? $setting->display_value : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Display Value']) !!}
                            </div>
                        </div>
                        @foreach(json_decode($setting->value) as $cIndex => $country)
                            <div class="form-group">
                                {!! Form::label('country', 'Country Name *', ['class' => 'control-label col-md-2']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('country', old('country', isset($country) ? $country->name : ''), ['class' => 'form-control validate[required]', 'placeholder'=>'Country Name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="s-tags-{{$cIndex}}" name="tags" value="@foreach($country->states as $index => $state){{$state->name}}@if($index < count($country->states) - 1),@endif()@endforeach" style="display: none;">
                                <ul class="states-tags" id="states-tags"></ul>
                            </div>
                        @endforeach
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="box">
                {{--<div class="box-header with-border">
                    <h3 class="box-title">Setting Details Form</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>--}}
                <div class="box-body">
                    {!! Form::open(['url' => isset($setting) ? URL::to('admin/settings/'.$setting->id )  :  URL::to('admin/settings') ,'files' => true, 'method' => isset($setting) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                    {!! Form::hidden('setting_id', isset($setting) ? $setting->id: null) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('key_cd', 'Key *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                @if(isset($setting))
                                    {!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key','readonly']) !!}
                                @else
                                    {!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key']) !!}

                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'Type *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                {!! Form::text('type', old('type', isset($setting) ? $setting->type : $type), ['class' => 'form-control validate[required]', 'placeholder'=>'Type', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('display_value', 'Display Value *', ['class' => 'control-label col-md-2']) !!}
                            <div class="col-md-8">
                                {!! Form::text('display_value', old('display_value', isset($setting) ? $setting->display_value : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Display Value']) !!}
                            </div>
                        </div>
                        @if(isset($setting) && $setting->type == 'SELECT' || $type == 'SELECT' )
                            <div class="form-group" id="type_select">
                                {!! Form::label('value', 'Value *', ['class' => 'control-label col-md-2']) !!}
                                <div class="col-md-8">
                                    <ul id="options-select" class="fake-input" tabindex="1" style="width:100%;"
                                        data-values="{{ isset($setting) ? $setting->getOriginal('value') : ''}}">

                                    </ul>
                                </div>
                            </div>
                        @elseif(isset($setting) && $setting->type == 'FILE' || $type == 'FILE' )
                            <div class="form-group" id="type_text">
                                {!! Form::label('value', 'Value *', ['class' => 'control-label col-md-2']) !!}
                                <div class="col-md-4">
						<span class="btn  btn-file  btn-primary">Upload File
                            {!! Form::file('value') !!}
						</span>
                                </div>
                                @if(isset($setting))
                                    <div class="col-md-4">
                                        <a class="btn btn-info"
                                           href="{{ url('admin/settings/download/'.$setting->id) }}">
                                            Download</a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="form-group" id="type_text">
                                {!! Form::label('value', 'Value *', ['class' => 'control-label col-md-2']) !!}
                                <div class="col-md-8">
                                    {!! Form::textarea('value', old('value', isset($setting) ? $setting->value : null), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                {!! Form::submit( (isset($setting) ? 'Update': 'Add') . ' Setting', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div><!-- .col-md-12 -->
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        @endif
    </section><!-- /.content -->
@endsection


@section('js')

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    {!! Html::script('assets/plugins/jQueryUI/jquery-ui.min.js') !!}
    {!! Html::script('assets/plugins/jquery-tagit-master/lib/jquery.tagit.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {
            if ($("#options-select").length > 0) {
                var options = [];

                $("#options-select").tagit({
                    tags: options,
                    field: "value[]"
                });

                var values = $("#options-select").data("values");
                if (values.length > 0) {
                    $.each(values, function (i, e) {
                        $("#options-select").tagit("addTag", e);
                    });
                }
            }

            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach', {
                promptPosition: "bottomRight", scroll: false,
                prettySelect: true,
                usePrefix: prefix
            });
        });

        $(".states-tags").each(function(index) {
            $(this).tagit({
                singleField: true,
                singleFieldNode: $('#s-tags-' + index)
            })
        });
        /*$(".states-tags").tagit({
            singleField: true,
            singleFieldNode: $('.s-tags')
        });*/
    </script>
@endsection