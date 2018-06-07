@extends('layouts.admin.app')

@section('title', 'Edit Classification')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/classification') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12 padding-bottom"><h3>Edit classification</h3></div>
        </div>
        {{--end header content--}}
        {{--open form (edit a classification by admin)--}}
        <form action="{{url('/admin/classification/' . $tax->id)}}" method="POST" novalidate>
            {{method_field('PUT')}}
            {{csrf_field()}}
            {{--main content--}}
            <div class="new-box">
                <div class="row">
                    <div class="col-xs-12 padding-tb">
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Classification name:</label>
                            <div class="col-md-7 col-lg-4">
                                <div class="input-group left">
                                    <div clas="col-md-3">
                                        <input id="classification_name" type="text" class="form-control"
                                               name="description"
                                               placeholder="Description"
                                               value="@if(old('description')){{old('description')}}@else{{$tax->description}}@endif"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class=" col-xs-12 col-md-4 control-label">Duty:</label>
                            <div class="col-xs-12 col-md-8 col-lg-3 input-group flex">
                                <div class="col-xs-5">
                                    <input id="amount" type="text" class="form-control" name="duty"
                                           value="@if(old('duty')){{old('duty')}}@else{{$tax->duty}}@endif"
                                           placeholder="0.00" required>
                                </div>
                                <div class="col-xs-7 os-regular size44"><span>%</span></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class=" col-xs-4 col-md-4  col-lg-4 control-label">Enabled:</label>
                            <div class="col-xs-8 col-md-8 col-lg-3 input-group">
                                <div class="col-xs-6">
                                    <div class="radio flex-only-vertical radio-classification">
                                        <label>
                                            <input type="radio" name="enabled" value="yes"
                                                   @if($tax->enabled) checked @endif>
                                            Yes
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-xs-6">
                                    <div class="radio flex-only-vertical radio-classification">
                                        <label>
                                            <input type="radio" name="enabled" value="no"
                                                   @if(!$tax->enabled) checked @endif>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--end main content--}}
            {{--footer content--}}
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="os-bold btn btn-primary" href="{{url('admin/classification/' . $tax->id . '/delete')}}">
                        Delete classification
                    </a>
                    <button type="submit" class="btn btn-primary">Save classification</button>
                </div>
            </div>
            {{--end footer content--}}
        </form>
        {{--close form (edit a classification by admin)--}}
    </section>

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