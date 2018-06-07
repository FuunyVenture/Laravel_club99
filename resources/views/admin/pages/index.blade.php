{{--This view is not currently used. Pages are blog/articles that can edited by admin--}}


@extends('layouts.admin.app')

@section('title', 'Content')

@section('css')
        <!-- DataTables -->
{!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-files-o"></i> Content
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-files-o"></i> Content</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Content List</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Published</th>
                    <th>Published At</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <p class="text-muted small">
                <i class="fa fa-pencil"></i> Edit Content |
                <i class="fa fa-remove"></i> Delete Content |
                <i class="fa fa-eye"></i> View Content
            </p>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->

@include('layouts.admin.includes.message_boxes', ['item' => 'Content', 'delete' => true])

@endsection

@section('js')
        <!-- DataTables -->
{!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

{!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#data_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url("admin/datatables/pages") !!}',
            columns: [
                {data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                {data: 'published', name: 'published'},
                {data: 'published_at', name: 'published_at'},
                {data: 'blog_post', name: 'blog_post'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        table.column('5:visible').order('asc').draw();
    });
</script>
@endsection