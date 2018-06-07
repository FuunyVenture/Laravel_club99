@extends('layouts.admin.app')

@section('title', 'Menus')

@section('css')
        <!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-list-alt"></i> {{ isset($menu) ? 'Edit' : 'Add' }} Menu
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/menus') }}"><i class="fa fa-list-alt"></i> Menus</a></li>
        <li class="active"><i
                    class="fa {{ isset($menu) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($menu) ? 'Edit' : 'Add' }}
            Menu
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Menu Details Form</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => isset($menu) ? URL::to('admin/menus/'.$menu->id )  :  URL::to('admin/menus') , 'method' => isset($menu) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('title', 'Title *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('title', old('title', isset($menu) ? $menu->title : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Title']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('location', 'Location *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::select('location', getSetting('MENUS_LOCATION'), old('location', isset($menu) ? $menu->location: null), ['class' => 'form-control select2 validate[required]']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('item_order', 'Item Order *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::number('item_order', old('item_order',   isset($menu) ? $menu->item_order : null ), ['class' => 'form-control validate[required,custom[integer],min[1]]', 'placeholder'=>'Item Order']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'URL *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        {!! Form::text('url', old('url', isset($menu) ? $menu->url : null), ['class' => 'form-control validate[required]', 'placeholder'=>'URL']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
                        <label class="check">{!! Form::checkbox('status',1,  old('status' , (isset($menu) && ($menu->getOriginal('status') == 1) ) ? true : false ) ,['class'=>'minimal']) !!}
                            Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($menu) ? 'Update': 'Add') . ' Menu', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div><!-- .col-md-12 -->
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
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
            checkboxClass: 'icheckbox_minimal-blue'
        });

        //Initialize Select2 Elements
        $(".select2").select2();

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