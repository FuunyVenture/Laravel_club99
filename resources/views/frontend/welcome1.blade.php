@extends('layouts.frontend.single')

@section('title', 'Welcome to '.getSetting('SITE_TITLE'))

@section('css')
    {!! Html::style('assets/plugins/pricingTable/pricingTable.min.css') !!}
    <style type="text/css">
        ul.vpt_plan > li {
            font-family: Sans-Serif;
        }
    </style>
@endsection

@section('content')
    <!-- start home -->
    <section id="home">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 wow fadeIn" data-wow-delay="0.3s">
                        <h1 class="text-upper">Welcome to {{ getSetting('SITE_TITLE') }}</h1>
                        <p class="tm-white">Laraship Pro is the first user membership software built on Laravel that
                            provides complete management to any subscription site</p>
                        <img src="{{ asset('assets/dist/img/software-img-admin.png') }}" class="img-responsive"
                             alt="home img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->
    <!-- start divider -->
    <section id="divider">
        <div class="container">
            <div class="row">
                <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                    <i class="fa fa-laptop"></i>
                    <h3 class="text-uppercase">RESPONSIVE LAYOUT</h3>
                    <p>AdminLTE Best open source admin dashboard & control panel theme. AdminLTE
                        provides a range of responsive, reusable, and commonly used components.</p>
                </div>
                <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                    <i class="fa fa-twitter"></i>
                    <h3 class="text-uppercase">BOOTSTRAP 3</h3>
                    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first
                        projects on the web.</p>
                </div>
                <div class="col-md-4 wow fadeInUp templatemo-box" data-wow-delay="0.3s">
                    <i class="fa fa-desktop"></i>
                    <h3 class="text-uppercase">Frontend</h3>
                    <p>Nice Frontend Design and Members Dashboard which flexible, not fixed, works on mobile, desktop,
                        or any other device.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end divider -->
    <!-- start feature -->
    <section id="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
                    <h2 class="text-uppercase">Thank Your For Using Laraship Pro</h2>
                    <p>Laraship Pro is the first User Membership software built on Laravel that Provides Complete
                        Management to any Subscription Site Including :
                    <ul>
                        <li>User Management</li>
                        <li>Subscription Management</li>
                        <li>Role Management</li>
                        <li>Features Management</li>
                        <li>Package Management</li>
                        <li>Setting Management</li>
                        <li>Content Management</li>
                    </ul>
                    </p>
                    <i class="fa fa-code"></i>Laraship is Easy to install , Documentation is available!
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
                    <img src="{{ asset('assets/dist/img/software-img-admin.png') }}" class="img-responsive"
                         alt="feature img">
                </div>
            </div>
        </div>
    </section>
    <!-- end feature -->
    <!-- start feature1 -->
    <section id="feature1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <img src="{{ asset('assets/dist/img/software-img.png') }}" class="img-responsive" alt="feature img">
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <h2 class="text-uppercase">Buy Our Software</h2>
                    <p>Laraship is available at Code Canyon</p>
                    <a href="http://codecanyon.net/item/laraship-laravel-membership-administration-/15650201"
                       class="btn btn-primary text-uppercase"><i class="fa fa-download"></i> Buy Laraship Pro</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end feature1 -->
    @if(Auth::guest())
        <!-- start pricing -->
        <section id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow bounceIn">
                        <h2 class="text-uppercase">Our Pricing</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($packages as $package)
                                <div class="vpt_plan-container col-md-3 no-margin {{ $package->featured }}">
                                    <ul class="vpt_plan drop-shadow {{ $package->featured=='featured'?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $package->featured }}">
                                        <li class="vpt_plan-name"><strong>{{ $package->name }}</strong></li>
                                        <li class="vpt_plan-price"><span class="vpt_year"><i
                                                        class="fa fa-{{ getSetting('DEFAULT_CURRENCY') }}"></i></span>{{ $package->cost }}
                                            <span
                                                    class="vpt_year"
                                                    style="vertical-align:bottom">{{ $package->cost_per }}</span></li>
                                        <li class="vpt_plan-footer"><a href="{{ url('/register') }}"
                                                                       class="pricing-select">Subscribe
                                                Now</a></li>
                                        <?php $i = 1; ?>
                                        @foreach($package->features as $feature)
                                            @if($feature->isActive())
                                                @if($i%2)
                                                    <li>{{ $feature->pivot->spec }}</li>
                                                @else
                                                    <li class="vptbg">{{ $feature->pivot->spec  }}</li>
                                                @endif
                                                <?php $i++; ?>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end pricing -->
    @endif
    <!-- start contact -->
    <section id="contact">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <h2 class="text-uppercase">Contact Us</h2>
                        <h4>Address</h4>
                        {!!  getSetting('ADDRESS') !!}
                    </div>
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="contact-form">
                            {!! Form::open(['url' =>  '/contact-us', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), ['class' => 'form-control validate[required]', 'placeholder'=>'Name']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class' => 'form-control  validate[required,custom[email]]', 'placeholder'=>'Email']) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::text('subject', old('subject'), ['class' => 'form-control  validate[required]', 'placeholder'=>'Subject']) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::textarea('message', old('message'), ['class' => 'form-control  validate[required]', 'rows'=> 4]) !!}
                            </div>
                            <div class="col-md-8">
                                <input type="submit" class="form-control text-uppercase" value="Send">
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact -->
    <section id="map">
        <div class="">
            <div class="row">
                <div id="googleMap" style="width:100%;height:480px;"></div>
            </div>
        </div>
    </section>
@endsection

@section('js')

    {!! Html::script('http://maps.googleapis.com/maps/api/js') !!}
    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}
    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        function initialize() {
            var lat = "{{ getSetting('MAP_LATITUDE') }}";
            var lng = "{{ getSetting('MAP_LONGITUDE') }}";
            var mapProp = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        $(document).ready(function () {
            // Validation Engine init
            var prefix = 's2id_';
            $("form[id^='validate']").validationEngine('attach',
                    {
                        promptPosition: "bottomRight", scroll: false,
                        prettySelect: true,
                        usePrefix: prefix
                    });

            $(function () {
                /*new WOW().init();
                 $('.laraship-nav').singlePageNav({
                 offset: 70,
                 updateHash: true,
                 filter: ':not(.external)',
                 });*/

                /* Hide mobile menu after clicking on a link
                 -----------------------------------------------*/
                $('.navbar-collapse a').click(function () {
                    $(".navbar-collapse").collapse('hide');
                });
            })
        })
    </script>
@endsection
