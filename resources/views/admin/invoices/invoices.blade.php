{{--invoices are issued by club99 for members
    This view generates a GUI with a list of invoices in the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Invoices')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}
@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="page-head-line">
            <span>Invoices</span>
            <span class="btn btn-primary text-danger" style="cursor: pointer;">
                <a href="{{url('/admin/invoices/create')}}">Create an invoice</a>
            </span>
        </div>

        <div class="table-search-filter">
            <div class="col-xs-12 filter-search text-right">

                <span>Filter by</span>
                <span class="dropdown">
                    <select class="minimal" id="filter-invoices">
                        <option value="default" selected>All</option>
                        <optgroup label="Status">
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                        </optgroup>
                    </select>
                </span>

                <span>Search</span>
                <span><input type="text" id="invoicesInput"></span>
            
            </div>
        </div>
        {{--end header content--}}
        {{--main contet - list of invoices--}}
        <table id="invoices-table" class="table datatable dt-responsive" style="width:100%;">
            <thead>
                <tr>
                    <th>InvoiceID</th>
                    <th>MemberID</th>
                    <th>Invoice Date</th>
                    <th>Due Date</th>
                    <th>Invoice Total</th>
                    <th>Receipt Code</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="table-bottom-border"></div>
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
        /* Get invoice's table data, draw the table and manage table's search and filter. */
        $(document).ready(function () {
            var table = $("#invoices-table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/invoices") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: true},
                    {data: 'member_id', name: 'member_id', orderable: false, searchable: true},
                    {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
                    {data: 'due_date', name: 'due_date', orderable: false, searchable: true},
                    {data: 'total', name: 'total', orderable: false, searchable: true},
                    {data: 'store_code', name: 'store_code'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: true}
                ],
                fnCreatedRow: function (row, data) {
                    var _status = data.status.match(/<span>(.*?)<\/span>/g).map(function (val) {
                        return val.replace(/<\/?span>/g, '');
                    })[0];

                    $(row).attr('status', _status);
                }
            });
            table.column('3:visible').order('asc').draw();

            $('#invoicesInput').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('#filter-invoices').on('change', function () {
                if ($(this).val() == 'default') {
                    $('#invoices-table').find('tbody').find('tr').each(function () {
                        $(this).show();
                    })
                } else if ($(this).val() == 'Paid') {
                    $('#invoices-table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('status') == 'Paid')
                            $(this).show();
                        else $(this).hide();
                    })
                } else if ($(this).val() == 'Unpaid') {
                    $('#invoices-table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('status') == 'Unpaid')
                            $(this).show();
                        else $(this).hide();
                    })
                }
            });
        });
    </script>
@endsection
