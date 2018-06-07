{{--senders are club99 retailers that can be added to a shipment.
    Senders added by the member appear in add shipment form only for that member, admin also can see these senders in his dashboard.
    This view generates a GUI that allows the member to add a sender--}}
@extends('layouts.member.app')

@section('title', 'Add Senders')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

@endsection

@section('content')
    {{--open section--}}
    <section class="content">
        {{--open form--}}
        <form id="edit-affiliate-form" method="POST" action="{{url('member/senders')}}">
            {{--content header--}}
            <div class="row">
                <div class="col-xs-12 back"><a href="{{ url('member/senders') }}">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
                <div class="col-xs-12 padding-bottom"><h3>Add sender</h3></div>
            </div>
            {{--end content header--}}
            {{--main content-complete sender details--}}
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
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-3 col-sm-6 col-md-5 col-lg-3 control-label">URL:</label>
                                <div class="col-md-4">
                                    <div class="input-group" style="width:100%;">
                                        <input id="url" type="text" class="form-control" name="url"
                                               value="{{ old('url') }}">
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
                    <button type="submit" class="btn btn-primary">Save sender</button>
                </div>
            </div>
            {{--end content footer--}}
        </form>
        {{--end form--}}
    </section>
    {{--end section--}}
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').on('submit', function() {
                $('button[type="submit"]').attr('disabled', true);
            });
        });
    </script>
@endsection