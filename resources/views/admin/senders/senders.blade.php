{{--senders are club99 retailers that can be added to a shipment
    This view generates a GUI with a list of senders in the admin dashboard--}}


@extends('layouts.admin.app')

@section('title', 'Invoies')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}
@endsection

@section('content')
    <section class="content">
        {{--content header--}}
        <div class="page-head-line">
            <span>Senders</span>
            <span>
                <a class="btn btn-primary text-danger" href="{{url('/admin/senders/create')}}">
                    Add a sender
                </a>
            </span>
        </div>
        <div class="table-search-filter">
            <div class="col-xs-12 col-sm-3"><h4>Senders added by Club99</h4></div>

            <div class="col-xs-12 col-sm-10 filter-search text-right">
                <span>Search</span>
                <span><input type="text" id="retailersInput"></span>
            </div>
        </div>
        {{--end content header--}}
        {{--main content-list of senders--}}
        <div class="row">
            <div class="col-md-12 relative-table">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Sender name</th>
                        <th>URL</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="table-bottom-border"></div>
            </div>
        </div>
        <br>
        <div class="table-search-filter">
            <div class="col-xs-12 col-sm-3"><h4>Senders added by members</h4></div>
            <div class="col-xs-12 col-sm-10 filter-search text-right">
                <span>Search</span>
                <span><input type="text" id="userSendersInput"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 relative-table">
                <table id="memberSender" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Sender name</th>
                        <th>URL</th>
                        <th>Member</th>
                        <th>Date added</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="table-bottom-border"></div>
            </div>
        </div>
        {{--end main content--}}
    </section>
@endsection

@section('js')
    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}


    <script type="text/javascript">
        /* Get sender's table data, draw the table and manage table's search. */
        $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/retailers") !!}',
                columns: [
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'website', name: 'website', orderable: false, searchable: true},
                    {data: 'date', name: 'date', orderable: false, searchable: true},
                    {data: 'archived', name: 'archived', orderable: false, searchable: true},
                ]
            });
            table.column('0:visible').order('asc').draw();

            $('#retailersInput').on('keyup', function () {
                table.search(this.value).draw();
            });

            var tableMembersSenders = $("#memberSender").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/member-senders") !!}',
                columns: [
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'website', name: 'website', orderable: false, searchable: true},
                    {data: 'member', name: 'member', orderable: false, searchable: true},
                    {data: 'date', name: 'date', orderable: false, searchable: true},
                    {data: 'archived', name: 'archived', orderable: false, searchable: true},
                ]
            });
            tableMembersSenders.column('0:visible').order('asc').draw();

            $('#userSendersInput').on('keyup', function () {
                tableMembersSenders.search(this.value).draw();
            });
        });
    </script>
@endsection