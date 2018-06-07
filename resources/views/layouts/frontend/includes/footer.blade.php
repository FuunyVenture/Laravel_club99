<!-- start footer -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <div class="col-xs-12">
                    <img
                            class="svg"
                            src="{{ asset('assets/dist/img/svg/logo-footer.svg') }}"
                            alt="" />
                </div>
                <div class="col-xs-12 footer-copy">
                    <i class="fa fa-copyright" aria-hidden="true"></i>
                    <span>2016 club99.love</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <a class="footer-text">About us</a>
                <a href="{{ url('/faq') }}" class="footer-text">FAQ</a>
                <a href="{{ url('/contact-us') }}" class="footer-text">Contact us</a>
                <a href="{{ url('/privacy-policy') }}" class="footer-text">Privacy Policy</a>
                <a href="{{ url('/terms-of-use') }}" class="footer-text">Terms of use</a>

                <div class="row">

                    <ul class="list-inline footer-card-brands">
                        <li>
                            <span>We accept payment from</span>
                        </li>
                        <li>
                            <img class="svg"
                                 src="{{ asset('assets/dist/img/frontend/visa-logo-new.png') }}"
                                 alt=""/>
                        </li>
                        <li>
                            <img class="svg"
                                 src="{{ asset('assets/dist/img/frontend/640px-MasterCard_logo.png') }}"
                                 alt=""/>
                        </li>
                        <li>
                            <img class="svg"  style="width: 85px;"
                                 src="{{ asset('assets/dist/img/frontend/Scotiabank_Logo.svg.png') }}"
                                 alt=""/>
                        </li>
                        <li>
                            <img class="svg"  style="width: 70px;"
                                 src="{{ asset('assets/dist/img/frontend/rbc_logo.png') }}"
                                 alt=""/>
                        </li>
                        <li>
                            <img class="svg"  style="width: 85px;"
                                 src="{{ asset('assets/dist/img/frontend/firstcaribbean.png') }}"
                                 alt=""/>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 social">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-google-plus" aria-hidden="true" ></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
