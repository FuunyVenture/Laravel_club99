<style>
    .flat {
        flex-wrap: wrap;
    }
    .flat .plan {
        border-radius: 2px;
        list-style: none;
        padding: 0 0 20px;
        margin: 0 0 15px;
        background: #fff;
        text-align: center;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .2), 0 1px 1px 0 rgba(0, 0, 0, .14), 0 2px 1px -1px rgba(0, 0, 0, .12);
    }

    .flat .plan li.plan-header {
        padding: 15px;
        /*font-size: 24px;*/
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
<div class="row">
    <div class="col-xs-12 col-centred">
        <div class="row">
            <div class=" col-xs-12 text-center title-subscription">Please select which membership package would you like
                to use
            </div>
        </div>
        <div class="row flat">
            @foreach($packages as $package)
                <div class="col-md-3 col-xs-12">
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
                        <li class="plan-action">
                            <a data-package="{{$package->id}}"
                               class="select-subscription select-subscription-{{$package->id}} btn btn-danger">
                                Select subscription
                            </a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
