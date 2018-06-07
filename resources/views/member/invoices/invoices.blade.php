{{--invoices are issued by club99 for members
    This view generates a GUI with a list of invoices in the member dashboard--}}
@extends('layouts.member.app')

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
        <div class="page-head-line">Invoices</div>

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
            {{--end content header--}}
        </div>
        {{--main content--}}
        <table id="invoices-table" class="table datatable dt-responsive" style="width:100%;">
            <thead>
            <tr>
                <th>InvoiceID</th>
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
        /* Get invoices' table data, draw the table and manage table's search and filter. */
        $(document).ready(function () {
            var table = $("#invoices-table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("member/datatables/invoices") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: false},
                    {data: 'created_at', name: 'created_at', orderable: true, searchable: false},
                    {data: 'due_date', name: 'due_date', orderable: false, searchable: false},
                    {data: 'total', name: 'total', orderable: false, searchable: false},
                    {data: 'store_code', name: 'store_code'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
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
