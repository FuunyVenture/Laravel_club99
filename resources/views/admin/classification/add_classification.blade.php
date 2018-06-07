@extends('layouts.admin.app')

@section('title', 'Add Classification')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-12 back"><a href="{{ url('admin/classification') }}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a></div>
            <div class="col-xs-12 padding-bottom"><h3>Create Classification</h3></div>
        </div>
        {{--end header content--}}
        {{--main content--}}
        <div class="new-box">
            <div class="row">
                <div class="col-xs-12 padding-tb">
                    <form action="{{url('/admin/classification')}}" method="POST" novalidate>
                        {{csrf_field()}}
                        <div class="row form-group">
                            <label class="col-md-4 control-label">Classification name:</label>
                            <div class="col-md-7 col-lg-4">
                                <div class="input-group left">
                                    <div clas="col-md-3">
                                        <input id="classification_name" type="text" class="form-control"
                                               name="description"
                                               placeholder="Description"
                                               value="{{old('description')}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-md-4 control-label">Duty:</label>
                            <div class="col-xs-12 col-md-8 col-lg-3 input-group flex">
                                <div class="col-xs-5">
                                    <input id="amount" type="text" class="form-control" name="duty"
                                           value="{{old('duty')}}"
                                           placeholder="0.00" required>
                                </div>

                                <div class="col-xs-7 os-regular size44"><span>%</span></div>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-primary" type="submit">Save classification</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--end main content--}}
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