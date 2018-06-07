@extends('layouts.admin.app')

@section('title', 'Affiliates')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}

    {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

    {!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection

@section('content')
    <section class="content">
        {{--open form --}}
        <form id="add-affiliate-form" method="POST" action="{{url('admin/affiliates')}}" novalidate>
            {{--content header--}}
            <div class="row">
                <div class="col-xs-12 back">
                    <a href="{{ url('admin/affiliates') }}">
                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back
                    </a>
                </div>
                <div class="col-xs-12 padding-bottom"><h3>Add affiliate</h3></div>
            </div>
            {{--end content header--}}
            {{--main content--}}
            <div class="new-box">
                <div class="row">
                    <div class="col-xs-12 padding-tb">
                        <div class="col-md-3 text-center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="profile-image">
                                        <img src="{{ asset('assets/img/logo-placeholder.png') }}" width="100%"
                                             alt="Logo"/>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <span class="btn btn-file btn-primary">Add picture</span>
                                    <input type="file" accept="image/*" required name="logo"
                                           style="visibility: hidden; position: fixed; top: -100px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row form-group">
                                <label class="col-md-6 col-lg-3 control-label">Name of affiliate:</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 100%;">
                                        <input id="name"
                                               value="@if(session('name')) {{session('name')}} @endif"
                                               type="text" class="form-control"
                                               name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-6 col-lg-3 control-label">URL:</label>
                                <div class="col-md-6">
                                    <div class="input-group" style="width:100%;">
                                        <input id="url"
                                               value="@if(session('url')) {{session('url')}} @endif"
                                               type="text" class="form-control"
                                               name="url" required>
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
                    <button class="btn btn-primary" type="submit">Save affiliate</button>
                </div>
            </div>
            {{--end footer content--}}
        </form>{{--close form (add-affiliate-form)--}}
    </section>

@endsection

@section('js')
    <script type="text/javascript">
        /* Serialize form's fields to json object. */
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };

        $(document).ready(function () {
            /* Trigger file upload. */
            $('span.btn').on('click', function (event) {
                event.preventDefault();
                $('input[name="logo"]').click();
            });

            /* Update affiliate's image. */
            $('input[name="logo"]').on('change', function () {
                $('.profile-image').find('img').attr('src', (window.URL ? URL : webkitURL).createObjectURL($(this).prop('files')[0]));
                $(this).valid();
            });

            /* Submit form. */
            $('#add-affiliate-form').on('submit', function (event) {
                event.preventDefault();

                /* Check if the form's fields are valid. */
                if ($(this).valid()) {
                    var formData = new FormData();
                    $.each($(this).serializeObject(), function (key, value) {
                        formData.append(key, value);
                    });
                    formData.append('logo', $('input[name="logo"]').prop('files')[0]);

                    $.ajax({
                        type: "POST",
                        url: '{{url('admin/affiliates')}}',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log('submit shipment success', response);
                            window.location.href = '{{url('admin/affiliates')}}';
                        },
                        error: function (response) {
                            console.log('submit shipment error', response);
                            window.location.href = '{{url('admin/affiliates/create')}}';
                        }
                    });
                }
            })
        })
    </script>
@endsection