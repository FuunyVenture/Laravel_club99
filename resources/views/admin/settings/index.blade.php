{{--This view generetate a GUI with a list of settings for the admin--}}

@extends('layouts.admin.app')

@section('title', 'Settings')

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
         Settings
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        {{--<div class="box-header with-border">
            <h3 class="box-title">Settings List</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>--}}
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                    <tr>
                        <th>Setting</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!-- /.box-body -->
        {{--<div class="box-footer">
            <p class="text-muted small">
                <i class="fa fa-pencil"></i> Edit Setting
            </p>
        </div>--}}<!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection


@section('js')
<!-- DataTables -->
{!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

{!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

<script type="text/javascript">
    /* Get settings' table data and draw the table. */
    $(document).ready(function () {
        var table = $("#data_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url("admin/datatables/settings") !!}',
            columns: [
                {data: 'display_value', name: 'display_value'},
                {data: 'value', name: 'value'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        table.column('0:visible').order('desc').draw();
    });
</script>
@endsection
