{{--This view is not used --}}
@extends('layouts.frontend.app')

@section('title', 'Our Pricing')

@section('css')
    {!! Html::style('assets/plugins/pricingTable/pricingTable.min.css') !!}
    <style type="text/css">
        ul.vpt_plan > li {
            font-family: Sans-Serif;
        }
    </style>
@endsection

@section('content')
    {{--content header--}}
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-head-line">Our Pricing</h2>
        </div>
    </div>
    {{--end content header--}}
    {{--main content--}}
    <div class="row">
        @if(\Auth::user()->package_id == 0)
            <div class="col-md-12" style="margin-bottom: 10px;">
                <h3>Select Your Package Now and Join us</h3>
            </div>
        @endif
        <div class="col-md-12">
            @foreach($packages as $package)
                <div class="vpt_plan-container col-md-3 no-margin {{ $package->featured }}">
                    <ul class="vpt_plan drop-shadow {{ $package->featured=='featured'?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $package->featured }}">
                        <li class="vpt_plan-name"><strong>{{ $package->name }}</strong></li>
                        <li class="vpt_plan-price"><span class="vpt_year"><i
                                        class="fa fa-{{ getSetting('DEFAULT_CURRENCY') }}"></i></span>{{ $package->cost }}
                            <span
                                    class="vpt_year" style="vertical-align:bottom">{{ $package->cost_per }}</span>
                        </li>
                        @if(\Auth::user()->package_id == $package->id)
                            <li class="vpt_plan-footer"><a href="#" class="pricing-select">Current Package</a></li>
                        @else
                            <li class="vpt_plan-footer"><a
                                        href="{{ url('member/subscription/subscribe/'.$package->id) }}"
                                        class="pricing-select">Subscribe
                                    Now</a></li>
                        @endif
                        <?php $i = 1; ?>
                        @foreach($package->features as $feature)
                            @if($feature->isActive())
                                @if($i%2)
                                    <li>{{ $feature->pivot->spec }}</li>
                                @else
                                    <li class="vptbg">{{ $feature->pivot->spec }}</li>
                                @endif
                                <?php $i++; ?>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
    {{--end main content--}}
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
