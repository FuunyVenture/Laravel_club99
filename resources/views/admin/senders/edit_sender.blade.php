@extends('layouts.admin.app')

@section('title', 'Edit Senders')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

@endsection

@section('content')
    <section class="content">
        {{--open form--}}
        <form id="edit-affiliate-form" method="POST" action="{{url('admin/senders/' . $retailer->id)}}">
            {{method_field('PUT')}}
            {{csrf_field()}}
            {{--content header--}}
            <div class="row">
                <div class="col-xs-12 back"><a href="{{ url('admin/senders') }}">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
                <div class="col-xs-12 padding-bottom"><h3>Edit sender</h3></div>
            </div>
            {{--end content header--}}
            {{--main content--}}
            <div class="new-box">
                <div class="row">
                    <div class="col-xs-12 padding-tb">
                        {{csrf_field()}}
                        <div class="col-md-9">
                            <div class="row form-group">
                                <label class="col-md-5 col-lg-3 control-label">Name of sender:</label>
                                <div class="col-md-4">
                                    <div class="input-group" style="width: 100%;">
                                        <input id="" type="text" class="form-control" name="name"
                                               value="@if(old('name')){{old('name')}}@else{{$retailer->name}}@endif"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-3 col-sm-6 col-md-5 col-lg-3 control-label">URL:</label>
                                <div class="col-md-4">
                                    <div class="input-group" style="width:100%;">
                                        <input id="url" type="text" class="form-control" name="url"
                                               value="@if(old('url')){{old('url')}}@else{{$retailer->website}}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end main content--}}
            {{--content footer--}}
            <div class="row">
                <div class="col-md-12 text-right">
                    @if($retailer->archived == 0)
                        <a class="os-bold btn btn-edit" href="{{url('admin/senders/' . $retailer->id . '/delete')}}">
                            Archive sender
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary">Save sender</button>
                </div>
            </div>
            {{--end content footer--}}
        </form>
        {{--end form--}}
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            });
        });
    </script>
@endsection