@extends('layouts.frontend.app')

<style>
    .flat .plan {
        border-radius: 2px;
        list-style: none;
        padding: 0 0 20px;
        margin: 0 0 15px;
        background: #fff;
        text-align: center;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12);
    }

    .flat .plan li.plan-header {
        padding: 15px;
        font-size: 24px;
        line-height: 24px;
        color: #1c181d;
        background: #fff;
        border-bottom: 3px solid #c12036;
    }

    .flat .plan li.package-feature {
        padding-top: 15px;
        padding-bottom: 15px;
        border-top: 2px solid #dcdcdc;
    }

    .flat .plan li.package-feature:nth-child(2) {
        border: none;
    }

</style>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12" style="text-align:center"><h2>Packages</h2></div>
        </div>
        <div class="row">
            <div class=" col-xs-12 text-center sutitle-packages">Through our subscription packages we make shipping easy and affordable</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-centred">
                <div class="row flat">
                    @foreach($packages as $package)
                        <div class="col-sm-4 col-md-3 col-xs-12">
                            <ul class="plan plan1">
                                <li class="plan-header">
                                    <div class="row">
                                        <div class="col-md-12 package-name">
                                            {{$package->name}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 package-cost">
                                            <span class="dollar">$</span>
                                            <span class="cost">{{$package->cost}}</span>
                                            <span class="cost-per">/{{$package->cost_per}}</span>
                                        </div>
                                    </div>
                                </li>
                                @foreach($package->features as $feature)
                                    <li class="package-feature">
                                        {{$feature->name}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="border"></div>
        <div class="row">
            <div class="col-xs-12" style="text-align:center"><h2>Join clubb99.love now!</h2></div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align:center"><a  href="{{ url('/guest#signup') }}" class="btn btn-primary">Sign up</a></div>
        </div>
    </div>
@endsection