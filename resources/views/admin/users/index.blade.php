{{--Users are clubb99 clients called members.
    This view generate a GUI with a list o members for the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Users')

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
            <div class="col-xs-12"><h3 class="box-title">Members</h3></div>
            <div class="col-xs-12 padding-bottom">
                <a class="btn btn-primary text-danger" href="{{ url('admin/users/create') }}"
                   style="padding: 5px 20px;">
                    <span>+ Add a member</span>
                </a>
            </div>
            <div class="col-xs-12 padding-subtitle">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-lg-6"><h2>Members</h2></div>
                    <div class="col-xs-12 col-sm-9 col-lg-6 padding0 filter-search">
                        <div class="col-xs-12 col-md-6 padding-bottom">
                            <div class="col-xs-5 text-right top">Filter by</div>
                            <div class="col-xs-6 dropdown padding0">
                                <select class="minimal" id="filter-users">
                                    <option value="default" selected>All</option>
                                    <optgroup label="Subscription">
                                        @foreach($packages as $package)
                                            <option value="{{$package->name}}">
                                                {{$package->name}}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    {{--<optgroup label="Status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </optgroup>--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="col-xs-5 col-md-4 text-right top">Search</div>
                            <div class="col-xs-4 padding0">
                                <input type="text" id="membersInput">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Membership ID</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Subscription</th>
                        <th>Subscription end</th>
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
                ajax: '{!! url("admin/datatables/users") !!}',
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'firstname', name: 'firstname'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'subscription_id', name: 'subscription_id'},
                    {data: 'subscription_end', name: 'subscription_end'},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                fnCreatedRow: function (row, data) {


                    /!*Subscription*!/
                    $(row).attr('subscription', data.subscription_id);


                }
            });

            table.column('3:visible').draw();

            $('#filter-users').on('change', function () {
                if ($(this).val() == 'default') {
                    $('#data_table').find('tbody').find('tr').each(function () {
                        $(this).show();
                    })
                }
                        @foreach($packages as $package)
                else if ($(this).val() == '{!!$package->name!!}') {
                    $('#data_table').find('tbody').find('tr').each(function () {
                        if ($(this).attr('subscription') == '{!!$package->name!!}')
                            $(this).show();
                        else $(this).hide();
                    })
                }
                @endforeach
            });

            $('#membersInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection