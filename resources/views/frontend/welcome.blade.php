@extends('layouts.frontend.single')

@section('title', 'Welcome to '.getSetting('SITE_TITLE'))

@section('css')
    <style type="text/css">
        /* 
        CSS CONTENTS
        
        header section
        feature how it works
        shop section
        membership benefits
        packages section
        */

        .homepage {
            background-color: #f7f7f7;
            color:  #1C181C;
            padding-bottom: 143px;
        }
        @media screen and (max-width: 635px) {
            .homepage {
                padding-bottom: 243px;
            }
        }
        
        /* header section */
        .header-h1 {
            font-family: OpenSans Regular !important;
            font-size: 171.42% !important;
            color:  #fff;
            text-align: left !important;
        }

        .header-h1-subtitle {
            font-size: 100% !important;
            margin-bottom: 50px;
        }

        .header-p {
            font-family: OpenSans Regular;
            font-size: 71.42%;
            color:  #fff;
            text-align: left;
        }

        .header-button a {
            text-align: left !important;
            padding: 8px 18px;
            font-family: OpenSans Regular;
            font-size:55%;
        }

        .header-overlay { 
            padding-top: 170px;
            padding-bottom: 170px;
        }
        /* end header section */

        /* feature how it works */
        .how-works-box {
            background-color: #f7f7f7;
        }

        .how-works-box h2 {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 100px;
            font-family: OpenSans Light;
            font-weight: 300;
        }

        .feature-intro {
            margin: 10px 0px;
            padding: 30px 0px;
            line-height: 32px;
        }

        .feature-intro > span {
            font-family: OpenSans Semibold;
        }

        .feature-intro > img {
            vertical-align: sub;
        }
        
        /* vertical dividers */
        .feature-intro:last-child {
            border-left: 1px solid #c1c1c1;
        }

        /* horrizontal dividers */
        .dividers {
            margin: 0px 10px;
            border-bottom: 1px solid #c1c1c1;
        }

        .member-title div:first-child {
            margin-top: 10px;
            font-family: OpenSans Bold;
            font-size: 70%;
            color: #c12036;
        }

        .member-title div:last-child {
            max-width: 410px;
            margin: auto;
            font-size: 53%;
        }

        .semi-bold {
            font-family: OpenSans Semibold;
        }
        /* end feature how it works */

        /* shop section */
        .where-to-shop-title {
            height: 140px;
            margin-top: 88px;
            background-color: #fff;
            border-top: 1px solid #eeeeee;
            border-bottom: 1px solid #eeeeee;
        }

        .where-to-shop-title h2 {
            margin-bottom: 0px;
            font-family: OpenSans Light;
            font-weight: 300;
        }

        .where-to-shop-title div {
            font-size: 20px;
            font-family: OpenSans Regular;
            color: #c12036;
        }

        .where-to-shop .small-box-container {
            height: 150px;
            background-color: white;
            position: relative;
            box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.11);
            border-radius: 3px;
        }

        .where-to-shop .small-box-container img {
            max-width: 50%;
            margin: 0 auto;
            height: auto;
        }

        .shops {
            min-height: 116px;
            padding: 32px 0px;
            background-color: #f0f0f0;
        }

        .shops img {
            margin: 0px 24px;
            max-height: 60px;
            max-width: 130px;
        }
        /* end shop section */

        /* membership benefits */
        .membership-benefits {
            min-height: 531px;
            background-color: #c12036;
            color: white;
        }

        .membership-benefits > img {
            position: absolute;
        }

        .membership-text {
            padding: 0 40px;
            padding-top: 70px;
        }

        .membership-text h2 + p {
            margin: 0 46px;
            font-size: 63%;
            line-height: 28px;
        }

        .membership-text .row{
            margin-bottom: 50px;
        }

        .membership-text img {
            vertical-align: top;
            margin-right: 4px;
            margin-top: -4px;
        }

        .text {
            font-family: OpenSans Regular;
            font-size: 50%;
        }

        .benefits {
            padding: 0 20px;
        }

        .benefits:nth-child(2n+1) {
            text-align: right; 
        }

        .benefits span {
            width: 90%;
            display: inline-block;
        }

        .arrow-down {
            width: 70px;
            margin: 0px auto;
        }

        .arrow-down > div {
            position: absolute;
            content: url("assets/dist/img/frontend/arrow-down.svg");
        }

        @media screen and (max-width: 768px) {

            .benefits {
                padding: 20px;
                text-align: left;
            }

            .benefits:nth-child(2n+1) {
                text-align: left;
            }

            .membership-text .row{
                margin-bottom: 0px;
            }

        }
        /* end membership benefits */

        /* packages section */
        .where-to-shop .text,
        .home-packages .text {
            font-family: OpenSans Regular;
            font-size: 50%;
        }

        .packages-bg {
            position: relative;
        }

        .home-packages h2 {
            margin-top: 83px;
            margin-bottom: 50px;
            color: #c12036;
        }

        .padding-bottom {
            padding-bottom: 15px;
        }

        .home-packages .plan-header {
            padding: 25px 25px 0px;
            min-height: 80px;
            line-height: 34px;
            text-align: center;
            border: 1px solid #dcdcdc;
            font-size: 28px;
            font-family: OpenSans Regular;
            background: #fff;
        }

        .home-packages .flat div:hover ul {
            /*margin-top: -10px;
            margin-bottom: -10px;*/
        }

        .home-packages .flat div:hover ul {
            border: 1px solid red;
            border-radius: 4px;
        }

        .home-packages .flat div:hover .plan-header + li {
            border-bottom: 3px solid #c12036;
        }

        .package-name {
            float: left;
            color: #c12036;
        }

        .home-packages .cost {
            float: right;
            line-height: 39px;
            font-size: 22px;
        }

        @media screen and (max-width: 1715px) {
            .home-packages .cost, .package-name {
                float: none;
                display: block;
            }

            .home-packages .plan-header {
                text-align: center;
                padding-top: 5px;
            }
        }
        
        .home-packages .cost > span {
            font-size: 18px;
        }

        .home-packages .package-feature {
            padding-top: 15px;
            padding-bottom: 15px;
            border: 1px solid #dcdcdc;
            border-bottom: 2px solid #dcdcdc;
            text-align: center;
            background: #fff;
        }

        .home-packages .plan-header + li {
            border-bottom: 3px solid #c12036;
        }

        .home-packages .plan {
            list-style: none;
            padding: 0px;
            margin: 0 0 15px;
        }

        .home-packages .plan :first-child {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }

        .home-packages .plan :last-child {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .package-feature {
            font-size: 56%;
            color: #373c43;
            font-family: OpenSans Semibold;
        }

        .message-btn {
            margin-top: 66px;
            margin-bottom: 90px;
            font-size: 28px;
            font-family: OpenSans Semibold;
        }

        .message-btn div:last-child {
            font-family: OpenSans Regular;
            color: #656565;
        }

        .message-btn > div {
            margin-bottom: 30px;
        }

        .signup {
            width: 168px;
            height: 65px;
            padding-top: 14px;
            font-size: 22px;
        }

        .map {
            position: absolute;
            left: 20%;
            bottom: 0px;
        }

        @media screen and (max-width: 1199px) {
            .map{
                left: 0px;
            }
        }

        .map-background {
            position: absolute;
            top: 0px;
            width: 3000px;
            height: 277px;
            background-color: #fff;
        }

        /* end packages section */

    </style>
@endsection

@section('content')
    <div class="row">
        <section id="home">
            <div class="overlay header-overlay">
                <div class="container">

                    <div class="row">
                        <div class="col-md-6 col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                            <h1 class="header-h1">Shop online at US stores</h1>
                            <p class="header-h1 header-h1-subtitle">Get free shipping to The Bahamas</p>
                            <p class="header-p">Annual packages starting as low as $99</p>
                            <div class="row ">
                                <div class="col-xs-12 header-button text-left padding-bottom">
                                    <a href="{{ url('/guest#signup') }}" class="btn btn-primary">Sign up now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <div class="row">
        <div class="content homepage">
            <div class="how-works-box">
                <div class="row">
                    <div class="col-xs-12"><h2>How Club99 works</h2></div>
                </div>

                {{--how it works--}}
                <div class="row text-center">
    
                    <div class="row flat">
    
                        <div class="col-xs-12 col-sm-4 feature-intro">
                            <img src="{{ asset('assets/dist/img/frontend/subscribe-icon.png') }}">
                            <span>Subscribe</span>
                            <div class="member-title">
                                <div>Sign up as a member</div>
                                <div><span class="semi-bold">and receive FREE shipping</span> on all select products purchased online.</div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-4 feature-intro">
                            <img class="image" src="{{ asset('assets/dist/img/frontend/shop-icon.png') }}">
                            <span>Shop</span>
                            <div class="member-title">
                                <div>When you shop on US websites,</div>
                                <div><span class="semi-bold">enter your complete Club99 address</span> as your delivery address at checkout.</div>
                            </div>
                        </div>
    
                    </div>
    
                    <div class="row flat">
                        <div class="col-xs-12 col-sm-4 dividers"></div>
                        <div class="col-xs-12 col-sm-4 dividers"></div>
                    </div>
    
                    <div class="row flat">
    
                        <div class="col-xs-12 col-sm-4 feature-intro">
                            <img src="{{ asset('assets/dist/img/frontend/ship-icon.png') }}">
                            <span>Ship</span>
                            <div class="member-title">
                                <div>We'll email you when order is delivered</div>
                                <div><span class="semi-bold">to our export facility warehouse.</span><br>Then sign in to Club99 and release it.</div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-4 feature-intro">
                            <img class="image" src="{{ asset('assets/dist/img/frontend/save-icon.png') }}">
                            <span>Save</span>
                            <div class="member-title">
                                <div>No billing surprises</div>
                                <div><span class="semi-bold">when your item is received. Import taxes are worked out up front </span> so there are no hidden fees & bad surprises.</div>
                            </div>
                        </div>
    
                    </div>
    
                </div>
                {{--end how it works block--}}
            </div>

            {{--Where to shop--}}
            <div class="row where-to-shop">
                <div class="col-xs-12 text-center">
                    <div class="where-to-shop-title">
                        <h2>Where to shop</h2>
                        <div>Brands you love, delivered to you </div>
                    </div>

                    <div class="shops">
                        <img class="image" src="{{ asset('assets/dist/img/member/amazon.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/h&m.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/wallmart.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/ebay.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/zara.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/forever21.png') }}">
                        <img class="image" src="{{ asset('assets/dist/img/member/brandsmart.png') }}">
                    </div>
                </div>
            </div>

            {{--end where to shop--}}
            {{--Membership benefits--}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="membership-benefits">
                        <img class="image" src="{{ asset('assets/dist/img/frontend/99ico.png') }}">

                        <div class="row">

                            <div class="col-xs-8 col-xs-offset-2 col-lg-8 col-lg-offset-2 membership-text">
                                
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1 text-center">
                                        <h2>Membership benefits</h2>
                                        <p class="text">Club99 continues to reward members in exciting new ways and deliver the ultimate shopping experience</p>
                                    </div>
                                </div>

                                <div class="row text">
                                    <div class="col-xs-12 col-sm-6 benefits">
                                        <img class="image" src="{{ asset('assets/dist/img/frontend/check-icon.png') }}">
                                        <b>Unlimited free shipping</b>, never pay freight charges again on imported goods under 10lbs.
                                    </div>
                                    <div class="col-xs-12 col-sm-6 benefits">
                                        <img class="image" src="{{ asset('assets/dist/img/frontend/check-icon.png') }}">
                                        <span>
                                            <b>Up to 50% store discounts</b> at participating local retail outlets.
                                        </span>
                                    </div>
                                </div>

                                <div class="row text">
                                    <div class="col-xs-12 col-sm-6 benefits">
                                        <img class="image" src="{{ asset('assets/dist/img/frontend/check-icon.png') }}">
                                        <b>Hassle free product</b> returns to the United States.
                                    </div>
                                    <div class="col-xs-12 col-sm-6 benefits">
                                        <img class="image" src="{{ asset('assets/dist/img/frontend/check-icon.png') }}">
                                        <span>
                                            <b>Surprise flash offers</b> throughout the year - and more.
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{--end Membership benefits--}}

            <div class="packages-bg">
                <img class="map" src="{{ asset('assets/dist/img/frontend/map.png') }}">
                <div class="map-background"></div>
                <div class="arrow-down">
                    <div></div>
                </div>
                {{--packages--}}
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 home-packages">
                
                        <div class="col-xs-12 text-center">
                            <h2>Packages</h2>
                        </div>
                
                        <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                            <div class="row flat" style="align-items: stretch; justify-content: center; flex-wrap: wrap;">
                                @foreach($packages as $package)
                                    <div class="col-xs-12 col-md-4">
                                        <ul class="plan">
                                            <li class="plan-header">
                                                <span class="package-name">
                                                    {{$package->name}}
                                                </span>
                                                <span class="cost">
                                                    $ {{$package->cost}}
                                                    <span>/{{$package->cost_per}}</span>
                                                </span>
                                            </li>
                                            <li></li>
                                            @if(count($package->features) > 0)
                                                @foreach($package->features as $feature)
                                                    <li class="package-feature">
                                                        {{$feature->name}}
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{--end packages--}}
                
                {{--<div class="row">
                    <div class="col-xs-5 text-center padding-bottom">
                        <span>
                            <b>Club99</b> continues to reward members in exciting new ways and deliver
                            the ultimate shopping experience
                        </span>
                    </div>
                </div>--}}
                
                <div class="row">
                    <div class="col-xs-12 text-center message-btn">
                        <div>
                            <div>Through our subscription packages we make shipping</div>
                            <div>easy and affordable</div>
                        </div>
                        <a href="{{ url('/guest#signup') }}" class="btn btn-primary signup">Sign up now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{--end how it works--}}

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
