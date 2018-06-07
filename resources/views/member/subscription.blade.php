@extends('layouts.member.subscription.app')

@section('title', 'Subscription')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection

@section('content')
    {{--content header- the steps for subscription--}}
    <div id="subscription-wizard">
        <h3>Select subscription package</h3>
        <section>
            @include('layouts.member.subscription.includes.packages')
        </section>
        <h3>Payment details</h3>
        <section>
            @include('layouts.member.subscription.includes.payment_methods')
        </section>
        <h3>Create profile</h3>
        <section>
            @include('layouts.member.subscription.includes.create_profile')
        </section>
    </div>
    {{--end content header--}}
    {{--main content - list of payment methods--}}
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="credit-card">
            @include('layouts.member.subscription.includes.credit_card')
        </div>
        <div role="tabpanel" class="tab-pane fade" id="cash-in-store">
            @include('layouts.member.subscription.includes.cash_in_store')
        </div>
        <div role="tabpanel" class="tab-pane fade" id="gift-card-coupon">
            @include('layouts.member.subscription.includes.gift_card')
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    <script type="text/javascript">

        $(document).ready(function () {

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

            var selectedPackage = "";
            var packages = {!! json_encode($packages->toArray()) !!};

            console.log(packages);

            var delayTimer;

            function doSearch(text) {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(function () {
                    var url = '{{url('/member/subscription/verify-coupon')}}';
                    var data = {};
                    data.coupon_code = text;
                    data._token = '{{ csrf_token() }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: data,
                        success: function (data, status, headers) {
                            if (data.error) {
                                $('*[package-price]').html('$ ' + selectedPackage[0].cost);
                                $('.summary-coupon-row').remove();
                                $('.coupon-error').remove();
                                $('.coupon_code').after($('<span class="coupon-error">' + data.error.message + '</span>'));

                            } else {
                                var price = 0;
                                var discount = 0
                                if (data.coupon.type == 'percentage') {
                                    price = selectedPackage[0].cost - (data.coupon.value / 100) * selectedPackage[0].cost;
                                    discount = (data.coupon.value / 100) * selectedPackage[0].cost;
                                } else {
                                    price = selectedPackage[0].cost - data.coupon.value;
                                    discount = data.coupon.value;
                                    if (price < 0) {
                                        price = 0;
                                    }
                                }

                                $('.summary-coupon-row').remove();
                                $('.coupon-error').remove();
                                $('.summary-row').after($('<div class="row summary-coupon-row"><div class="col-xs-6 package-coupon">Coupone Code: ' +
                                        '<span style="font-weight: bold" package-name="">' + data.coupon.code + '</span>' +
                                        '</div><div class="col-xs-6 text-right package-coupon" >- $' + discount.toFixed(2) + ' </div></div>'
                                ));
                                $('*[package-price-net]').html('$ ' + price.toFixed(2));
                            }

                        },
                        error: function (data, status, headers) {

                        }
                    });
                }, 1000);
            }

            $('.coupon_code').on('input', function () {
                $('.coupon_code').val($(this).val());
                doSearch($(this).val());
            });



            $("#subscription-wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "fade",
                autoFocus: true,
                enableAllSteps: false,
                enablePagination: false,
                titleTemplate: '<span class="number" number="#index#"></span> <span class="step-title step-title-#index#">#title#</span>',
                onStepChanging: function (event, currentIndex, newIndex) {
                    $('a[data-toggle="tab"]').parent().removeClass('active');
                    $('.tab-pane.active').removeClass('active');
                    return true;
                },
            });

            if('{{!isset(\Auth::user()->home_address)}}' == '1' &&
                    '{{isset(\Auth::user()->subscription) ? \Auth::user()->subscription->status : '0'}}' == 'active') {
                console.log('profile_controller', '{{!isset(\Auth::user()->home_address)}}');
                $("#subscription-wizard").steps("next");
                $("#subscription-wizard").steps("next");
            }


            $("#birthday").birthdayPicker({
                maxAge: 100,
                minAge: 0,
                maxYear: 2016,
                "dateFormat": "middleEndian",
                "monthFormat": "number",
                "placeholder": true,
                "defaultDate": false,
                "sizeClass": "selectpicker"
            });

            $('.selectpicker').selectpicker().change(function () {
                $(this).valid()
            });

            $('.select-subscription').click(function (event) {
                selectedPackage = $.grep(packages, function (element, index) {
                    return element.id == $(event.target).attr('data-package');
                });
                $('span[package-name]').html(selectedPackage[0].name);
                $('*[package-price-net]').html('$ ' + selectedPackage[0].cost);
                $('*[package-price]').html('$ ' + selectedPackage[0].cost);
                $("#subscription-wizard").steps('next');

                $('a[data-toggle="tab"]').first().parent().addClass('active');
                $('.tab-pane').first().addClass('in active');
            });

            $('.payment-submit').click(function (event) {
                if ($("#" + $(event.target).attr('data-form') + "-form").valid()) {

                    if ($(event.target).attr('data-form') == 'cash-in-store') {
                        $("#subscription-wizard").steps("remove", 2);
                        $("#subscription-wizard").steps("add", {
                            title: "Pending Validation",
                            content : '<div class="row">' +
                            '<div class="col-xs-12 col-centred">' +
                            '<p>Waiting for admin to review your subscription.</p>' +
                            '</div>' +
                            '</div>'
                        });
                    }

                    var url = '{{url('/member/subscription')}}' + '/set-subscription-' + $(event.target).attr('data-form');
                    var data = {};
                    data = $("#" + $(event.target).attr('data-form') + "-form").serializeObject();
                    data._token = '{{ csrf_token() }}';
                    data.package = selectedPackage[0].id;
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: data,
                        success: function (data, status, headers) {
                            console.log(data);
                            if (data.error) {
                                $('html, body').animate({scrollTop: '0px'}, 300);

                                $('.noty_inline_layout_container').find('li').remove();
                                $('#payment-notification').noty(
                                        {
                                            text: data.error,
                                            type: 'error',
                                            theme: 'relax'
                                        }
                                );
                            } else {
                                $("#subscription-wizard").steps('next');
                                $('#subscription-notification').noty(
                                        {
                                            text: 'Subscription purchase was successful',
                                            type: 'success',
                                            theme: 'relax'
                                        }
                                );
                            }

                        },
                        error: function (data, status, headers) {
                            console.log(data.responseText);
                        }
                    });
                }
            });


            $('#create-profile-btn').click(function () {
                if ($("#create-profile-form").valid()) {
                    var url = '{{url('/member/subscription/create-subscription-profile')}}';
                    var data = {};
                    data = $("#create-profile-form").serializeObject();
                    data._token = '{{ csrf_token() }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: data,
                        success: function (data, status, headers) {
                            window.location = '{{url('/member/dashboard')}}';
                        },
                        error: function (data, status, headers) {
                            console.log(data.responseText);
                        }
                    });
                }
            });
        });


        new Vue({
            el: '#profile-app',
            data: {
                firstname: "",
                lastname: "",
                addressline1: "",
                addressline2: "",
                city: "",
                state: "",
                zipcode: "",
            }
        });

    </script>
@endsection
