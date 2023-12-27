<!doctype html>
<html lang="en">

<head>
    <title>Meta Mavericks – The Brilliant Game Changers | The Meta Mavericks</title>
    <meta name="keywords" content="">
    <meta name="description"
        content="Award-winning Mobile App Development Company in USA specializing in mobile app services. Hire mobile app developers to create cutting-edge apps.">

    <x-head-links />

</head>

<body class="hompg">

    <x-header />

 <!--Page Header Start-->
 <section class="page-header">
    <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
    </div>
    <div class="page-header__shape-1"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Get In touch with us</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Contact</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->



     <!--contact Page Start-->
<section class="contact-page">
    <div class="container">
        <div class="contact-page__top">
            <div class="row">
                <div class="col-xl-12">
                    <ul class="contact-page__points-list list-unstyled">
                        <li>
                            <div class="contact-page__icon">
                                <span class="icon-location"></span>
                            </div>
                            <div class="contact-page__content">
                                <h3 class="contact-page__content-title">Our Address</h3>
                                <p>5380 OLD BULLARD RD STE 223, <br> TYLER, TX 75703, United States</p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-page__icon">
                                <span class="icon-phone"></span>
                            </div>
                            <div class="contact-page__content">
                                <h3 class="contact-page__content-title">Contact Info</h3>
                                <p>
                                    <a href="tel:+12812153298">(281) 215-3298</a>
                                    <!--<a href="tel:+12812153298">(281) 215-3298</a>-->
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-page__icon">
                                <span class="icon-email-mail"></span>
                            </div>
                            <div class="contact-page__content">
                                <h3 class="contact-page__content-title">Email Address</h3>
                                <p>
                                    <a href="mailto:info@themetamavericks.com">info@themetamavericks.com</a>
                                    <!--<a href="mailto:contect@themetamavericks.com">contect@themetamavericks.com</a>-->
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="team-details__bottom contact-page__bottom">
            <div class="row">
                <div class="col-xl-12">
                    <div class="comment-form-2">
                        <h3 class="comment-form-2__title">Get In touch with us</h3>
                        <form action="{{ route('contact-form') }}" method="POST" id="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="comment-form-2__input-box">
                                        <input type="text" placeholder="Your Name" name="name">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="comment-form-2__input-box">
                                        <input type="email" placeholder="Your Email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="comment-form-2__input-box">
                                        <input type="tel" placeholder="Phone Number"  name="phone">
                                    </div>
                                    <div class="comment-form-2__input-box text-message-box">
                                        <textarea name="message" placeholder="Write Message"></textarea>
                                    </div>
                                    <div class="comment-form-2__btn-box">
                                         <input type="Submit" class="btnmain" value="Submit" id="contact-form-btn">
                                            <input class="" type="hidden" name="ctry" value="">
                                    <!--<input type="hidden" name="pc" value="">-->
                                    <input type="hidden" name="cip" value="">
                                    <input type="hidden" name="hiddencapcha" value="">
                                    <input type="hidden" id="location" name="locationURL" value="">
                                    <input type="hidden" id="formtype" name="formtype" value="1">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="result"></div><!-- /.result -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--contact Page End-->

    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- sweet alert cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>
</html>
