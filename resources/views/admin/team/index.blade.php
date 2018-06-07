{{--Users are clubb99 clients called members.
    This view generate a GUI with a list o members for the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Admins')

@section('css')
    <!-- DataTables -->
    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12"><h3 class="box-title">Admins</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a class="btn btn-primary text-danger" href="{{ url('admin/team/create') }}"
                   style="padding: 5px 20px;">
                    <span>+ Add an admin</span>
                </a>
            </div>
            <div class="box-body">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Admin ID</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
    </section><!-- /.content -->

    @include('layouts.admin.includes.message_boxes', ['item' => 'User', 'delete' => true])

@endsection

@section('js')
    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

    <script type="text/javascript">
        /* Get user's table data, draw the table and manage table's search and filter. */
        $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/team") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'firstname', name: 'firstname'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            table.column('3:visible').draw();

            $('#membersInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection