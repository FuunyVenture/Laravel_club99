{{--affiliates are retailers added by club99 admin and are featured in the afiliates page
    This view lists all affiliates form the admin--}}

@extends('layouts.admin.app')

@section('title', 'Affiliates')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection
@section('content')
    <div class="row">
        {{--header content--}}
        <div class="col-xs-12 margin-title"><h3>Affiliates</h3></div>
        <div class="col-xs-12 padding-bottom margin-title">
            <a href="{{url('/admin/affiliates/create')}}" class="btn btn-primary">+Add affiliate</a>
        </div>
        <div class="col-xs-12 padding-subtitle margin-title"><h2>Current affiliate</h2></div>
        {{--end header content--}}
        {{--main content-list of retailers(affiliates)--}}
        <div class="col-xs-12">
            @foreach($retailers as $retailer)
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <a href="{{ url('admin/affiliates/'.$retailer->id.'/edit') }}">
                        <div class="box-affiliates">
                            <div class="col-xs-12" style="padding-top: 30px;">
                                <div class="row text-center">
                                    <img class="image" src="{{url($retailer->logo)}}">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{--end main content-list of affiliates--}}
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
