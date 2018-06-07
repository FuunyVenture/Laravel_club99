{{--products are club99 services that can be added to an invoce
    This view generates a GUI with a list of products in the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Products')

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
            <div class="col-xs-12"><h3>Products</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a class="btn btn-primary text-danger" href="{{url('/admin/products/create')}}">
                    <span>Add product</span>
                </a>
            </div>
        </div>
        {{--end header content--}}
        {{--main content - list of products--}}
        <div class="row">
            <div class="col-md-8">
                <div class="box-body">
                    <table id="products-table" class="table datatable dt-responsive" style="width:100%;">
                        <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Taxable</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
        /* Get product's table data and draw the table */
        $(document).ready(function () {
            var table = $("#products-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url("admin/datatables/fees") !!}',
                columns: [
                    {data: 'name', name: 'name', orderable: false, searchable: false},
                    {data: 'taxable', name: 'taxable', orderable: false, searchable: false},
                    {data: 'cost', name: 'cost', orderable: false, searchable: false}
                ]
            });
            /*table.column('3:visible').order('asc').draw();*/
        });
    </script>
@endsection