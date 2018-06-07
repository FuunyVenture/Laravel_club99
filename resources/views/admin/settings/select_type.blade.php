@extends('layouts.admin.app')

@section('title', 'Settings')

@section('css')

@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-gear"></i> Add Setting
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class=""><a href="{{ url('admin/settings') }}"><i class="fa fa-gears"></i> Settings</a></li>
        <li class="active"><i class="fa fa-gear"></i> Add Setting</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Setting</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    
                         <div class="col-md-4">
                            <a href="{{ url('admin/settings/create/TEXT') }}"  style="width:150px" class="btn btn-primary">Add Text Setting</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('admin/settings/create/SELECT') }}" style="width:150px" class="btn btn-primary">Add Select Setting</a>
                        </div>
                         <div class="col-md-4">
                            <a href="{{ url('admin/settings/create/FILE') }}" style="width:150px" class="btn btn-primary">Add File Setting</a>
                        </div>
                    
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection

@section('js')
@endsection