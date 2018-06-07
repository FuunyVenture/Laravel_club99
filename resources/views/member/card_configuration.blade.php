@extends('layouts.frontend.app')

@section('title', 'Card Configuration')

@section('css')

@endsection

@section('content')
    {{--content header--}}
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Card Configuration</h2>
        </div>
    </div>
    {{--end content header--}}
    {{--main content--}}
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 col-md-offset-4">
                {!! Form::open(['url' =>  isset($package)? 'member/subscription/set-subscription' :'member/subscription/card',
                'method' => 'post', 'class' => 'form-horizontal require-validation',
                'id'=>'card_form', 'data-cc-on-file'=> 'false', 'data-stripe-publishable-key'=> env('STRIPE_KEY')]) !!}
                <div class="form-group">
                    <div class="col-md-12">
                        <label class='control-label'>Name on Card</label>
                        {!! Form::text('', null,['class' => 'form-control', 'placeholder'=>'Name on Card', 'id'=> 'card_name', 'autocomplete' =>'off']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class='control-label'>Card Number *</label>
                        {!! Form::text('', null,['class' => 'form-control validate[required]', 'placeholder'=>'Card Number', 'id'=> 'card_number', 'autocomplete' =>'off']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label class='control-label'>CVC *</label>
                        {!! Form::text('', null,['class' => 'form-control validate[required]', 'placeholder'=>'ex. 311', 'id'=> 'card_cvc', 'autocomplete' =>'off']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class='control-label'>Exp. Month *</label>
                        {!! Form::text('', null,['class' => 'form-control validate[required]', 'placeholder'=>'MM', 'id'=> 'card_mm', 'autocomplete' =>'off']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class='control-label'>Exp. Year*</label>
                        {!! Form::text('', null,['class' => 'form-control validate[required]', 'placeholder'=>'YYYY', 'id'=> 'card_yy', 'autocomplete' =>'off']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        @if(isset($package))
                            {!! Form::submit('Continue in Subscription >>', ['class'=>'col-md-12 col-xs-12 btn btn-primary']) !!}
                        @else
                            {!! Form::submit('Save Card details', ['class'=>'col-md-12 col-xs-12 btn btn-primary']) !!}
                        @endif
                    </div>
                </div>
                <div class='error form-group hide'>
                    <div class='alert-danger alert'>
                        Please correct the errors and try again.
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='card_form']").validationEngine('attach',
                    {
                        promptPosition: "bottomRight", scroll: false,
                        prettySelect: true,
                        usePrefix: prefix
                    });
        });

        $(function () {

            var $form = $("#card_form");

            $form.on('submit', function (e) {
                if ($(this).validationEngine('validate')) {
                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('#card_number').val(),
                            cvc: $('#card_cvc').val(),
                            exp_month: $('#card_mm').val(),
                            exp_year: $('#card_yy').val()
                        }, stripeResponseHandler);
                    }
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                            .removeClass('hide')
                            .find('.alert')
                            .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='creditCardToken' value='" + token + "'/>");
                    @if(isset($package))
                        $form.append("<input type='hidden' name='package' value='" + {{ $package->id }} +"'/>");
                    @endif
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection
