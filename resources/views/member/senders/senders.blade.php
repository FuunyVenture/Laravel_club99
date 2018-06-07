{{--senders are club99 retailers that can be added to a shipment
    This view generates a GUI with a list of senders in the member dashboard--}}
@extends('layouts.member.app')

@section('title', 'Senders')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}
@endsection

@section('content')
    {{--open section--}}
    <section class="content">
        {{--content header--}}
        <div class="page-head-line">
            <span>Senders management</span>
            <span>
                <a class="btn btn-primary text-danger" href="{{url('/member/senders/create')}}">
                    Create new sender
                </a>
            </span>
        </div>
        <div class="table-search-filter">
            <div class="col-xs-12 col-sm-3"><h4>Senders</h4></div>

            <div class="col-xs-12 col-sm-10 filter-search text-right">
                <span>Search</span>
                <span><input type="text" id="retailersInput"></span>
            </div>
        </div>
        {{--end content header--}}
        {{--main content-list of al senders--}}
        <div class="row">
            <div class="col-md-12">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Sender ID</th>
                        <th>Name</th>
                        <th>Website</th>
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
    {{--end section--}}
@endsection

@section('js')
    <!-- DataTables -->
    {!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

    {!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}


    <script type="text/javascript">
        /* Get senders' table data, draw the table and manage table's search. */
        $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("member/datatables/retailers") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true},
                    {data: 'name', name: 'name', orderable: false, searchable: true},
                    {data: 'website', name: 'website', orderable: false, searchable: true},
                    {data: 'archived', name: 'archived', orderable: false, searchable: true},
                ]
            });
            table.column('0:visible').order('asc').draw();

            $('#retailersInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection