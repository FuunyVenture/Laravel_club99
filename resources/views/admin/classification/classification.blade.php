{{--classifications are needed to atach taxes to items from a shipment
    This view generates a GUI with list of classifications for the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Classsification')

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
            <div class="col-xs-12"><h3>Classification management</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a class="btn btn-primary text-danger" href="{{url('/admin/classification/create')}}"
                   style="padding: 5px 20px;">
                    <span>Create new classification</span>
                </a>
            </div>
            <div class="col-xs-8 padding-subtitle">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-lg-4"><h2>Classification</h2></div>
                    <div class="col-xs-12 col-sm-9 col-lg-4 padding0 coupon-search filter-search">
                        <div class="col-xs-7 col-lg-6 text-right" style="top:8px;">Search</div>
                        <div class="col-xs-5 col-lg-6 padding0">
                            <input type="text" id="classificationInput" style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end header content--}}
        {{--main content-table with all classificaton from clubb99--}}
        <div class="row">
            <div class="col-md-8 relative-table">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Classification Id</th>
                        <th>Name</th>
                        <th>Duty</th>
                        <th>Status</th>
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
        /* Get classification's table data, draw the table and handle table's search. */
        $(document).ready(function () {
            var table = $("#data_table").DataTable({
                processing: true,
                serverSide: false,
                ajax: '{!! url("admin/datatables/classifications") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true},
                    {data: 'description', name: 'description', orderable: false, searchable: true},
                    {data: 'duty', name: 'duty', orderable: false, searchable: false},
                    {data: 'enabled', name: 'enabled', orderable: false, searchable: false},
                ]
            });
            table.column('0:visible').order('asc').draw();

            $('#classificationInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection