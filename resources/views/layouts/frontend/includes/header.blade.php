<!-- start navigation -->
<nav class="navbar navbar-default navbar-fixed-top laraship-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="{{ url('/') }}" class="navbar-brand external"><img src="{{asset('assets/dist/img/Club99love-logo.svg')}}"></a>
        </div>
        <div class="collapse navbar-collapse">
{{--            <ul class="nav navbar-nav navbar-left text-uppercase">
                <li><a href="{{ url('/how-it-works') }}" class="{{ Request::is('how-it-works') ? 'current': '' }}">How it works</a></li>
                <li><a href="{{ url('/packages') }}" class="{{ Request::is('packages') ? 'current': '' }}">Packages</a></li>
                <li><a href="{{ url('/help') }}" class="{{ Request::is('help') ? 'current': '' }}">Help</a></li>
                --}}{{-- <li><a class="{{ Auth::guest() ? '':'external' }}"
                        href="{{ Auth::guest() ? url('/#pricing') : url('member/pricing') }}"><b>Pricing</b></a></li>
                 <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
                 @foreach(getMenuItems('HEADER') as $item)
                     <li><a class="external" href="{{ url($item->url) }}"><b>{{ $item->title }}</b></a></li>
                 @endforeach--}}{{--

            </ul>--}}
            <ul class="nav navbar-nav navbar-right text-uppercase">
                @if (Auth::guest())
                    <li><a class="btn btn-danger external header-auth-buttons" data-hashtag="signup" href="{{ url('/guest#signup') }}">Sign up</a></li>
                    {{--<li class="bar">|</li>--}}
                    <li><a class="external header-auth-buttons" data-hashtag="login" href="{{ url('/guest#login') }}">Login</a></li>
                @endif
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <b>Welcome {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }} !</b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="external" href="{{ url('member/subscription') }}"><i class="fa fa-btn fa-home"></i>&nbsp;Dashboard</a>
                            </li>
                            {{--  <li><a class="external" href="{{ url('member/profile') }}"><i class="fa fa-btn fa-user"></i>&nbsp;Profile</a>
                             </li>
                          - @if('Admin' === \Auth::user()->role->name)
                                 <li><a class="external" href="{{ url('admin/dashboard') }}">
                                         <iclass="fa fa-btn fa-user-secret"></i>&nbsp;
                                         Admin Panel</a></li>
                             @endif--}}
                            <li><a class="external" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>&nbsp;Logout</a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-xs"><img src="{{ asset(Auth::user()->avatar) }}"
                                               style="height: 32px;width: 32px;"/></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
