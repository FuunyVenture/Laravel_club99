{{--features are required by subscription packages(see packages folder)
    This view generates a GUI with a list of available features --}}

@extends('layouts.admin.app')

@section('title', 'Features')

@section('css')
    <!-- DataTables -->
    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}
@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12"><h3>Membership management</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a href="{{ url('admin/features/create') }}" class="btn btn-primary">+Add features</a>
            </div>
            <div class="col-xs-8 padding-subtitle">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-lg-4"><h2>Features</h2></div>
                </div>
            </div>
        </div>
        {{--end header content--}}
       {{--main content - list of features--}}
        <div class="row">
            <div class="col-md-12 relative-table">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        {{--end main content--}}
    </section>

    @include('layouts.admin.includes.message_boxes', ['item' => 'Feature', 'delete' => true])

@endsection

@section('js')
    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

    <script type="text/javascript">
        var preventDefault = true;

        $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url("admin/datatables/features") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });
            table.column('2:visible').order('asc').draw();

            table.on('draw.dt', function () {
                if (preventDefault)
                    preventDefault = false;
                else {
                    $('#notifications').prepend(
                            '<div class="noti-alert pad no-print">' +
                            '<div class="alert alert-success alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                            '<h4><i class="icon fa fa-check"></i> Success</h4>' +
                            '<ul>' +
                            '<li>'+ actionData.success +'</li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>'
                    );
                }
            });
        });
    </script>
@endsection
