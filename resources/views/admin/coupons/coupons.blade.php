{{--coupons are created by the admin
    This view generates a GUI that lists the coupons for the admin dashboard --}}

@extends('layouts.admin.app')

@section('title', 'Coupons')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}
@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12"><h3>Coupon management</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a class="btn btn-primary text-danger" href="{{url('/admin/coupons/create')}}" style="padding: 5px 20px;">
                    <span>Create new coupon</span>
                </a>
            </div>
            <div class="col-xs-8 padding-subtitle">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-lg-4"><h2>Coupons</h2></div>
                    <div class="col-xs-12 col-sm-9 col-lg-4 padding0 coupon-search filter-search">
                        <div class="col-xs-7 col-lg-6 text-right" style="top:8px;">Search</div>
                        <div class="col-xs-5 col-lg-6 padding0">
                            <input type="text" id="couponsInput" style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end header content--}}
        {{--main content- list of coupons--}}
        <div class="row">
            <div class="col-md-8 relative-table">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Coupon Code</th>
                        <th>Amount</th>
                        <th>Date created</th>
                        <th>End date</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
        /* Get coupons' table data, draw the table and handle table's search. */
       $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/coupons") !!}',
                columns: [
                    {data: 'code', name: 'code', orderable: false, searchable: true},
                    {data: 'value', name: 'value', orderable: false, searchable: true},
                    {data: 'start_date', name: 'start_date', orderable: false, searchable: false},
                    {data: 'end_date', name: 'end_date', orderable: false, searchable: false},
                ]
            });
            table.column('3:visible').order('asc').draw();

           $('#couponsInput').on('keyup', function () {
               table.search(this.value).draw();
           });
        });
    </script>
@endsection