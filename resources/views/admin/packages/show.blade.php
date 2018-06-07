{{--This view generate a GUI with the details of a subscription package--}}

@extends('layouts.admin.app')

@section('title', 'Package')

@section('css')

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-xs-12 back"><a  href="{{ url('admin/packages') }}">
                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
    </div>
    <h3 class="box-title">{{ $package->name. ' Package' }}</h3>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h4>Package Details</h4>
                        <div class="table-responsive no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="width: 30%;">
                                        <small class="">Name:</small>
                                    </td>
                                    <td><small class="text-info">{{ $package->name }}</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="">Cost:</small>
                                    </td>
                                    <td>
                                        <small class="text-info">{{ $package->cost .'/'.$package->cost_per. ' '. getSetting('DEFAULT_CURRENCY') }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="">Plan:</small>
                                    </td>
                                    <td><small class="text-info">{{ $package->plan }}</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="">Status:</small>
                                    </td>
                                    <td>
                                        <small class="text-info">{{ $package->status }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="">Featured:</small>
                                    </td>
                                    <td>
                                        <small class="text-info">{{ $package->featured }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="">Pricing Order:</small>
                                    </td>
                                    <td><small class="text-info">{{ $package->pricing_order }}</small></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Package Features List</h4>
                        <ul>
                            @foreach($package->features as $feature)
                                <li class="completed-invoice">
                                    {{ $feature->name }}
                                   {{-- <p>{{ $feature->pivot->spec }}</p>--}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
