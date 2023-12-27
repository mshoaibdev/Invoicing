
<noscript>
    <div id="jqcheck"><img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB60lEQVQ4T2NkwAHePzrxf3ebL1jWp/0oA5egGiM2pVgFQQq31uj/N/ANZvj+8T3D7aNHGDwbTxNvwKtbO/9f3dLHYJ+axfDn5w+GI/NnMRhFtTEISJtjGIIh8Pv39/87ak0ZzCLiGMRUNMCufnLxDMOlrZsY3JtOMrCwsKPowTDg3tGZ/59f2sVgFRvPkO+bAzZgwsZJDEcXzWNQtIlikDGIwG3Az+9v/+9qsGOwTc1h4JeQhhswcfMUhrcP7zEcXzyXwb3xMAMbuwDcEBTTzi7P/s/M8IFB3zccbDPMBSADQODs2sUMzFwyDIah/ZgGfHt/7/+BvmAGm+RsBl4RMawGfHr5jOHowlkMjiUbGDj55MCGwE060Of1X0RZi0Hb2Q4e3eguAElc2X2A4e2DmwwOhVsRBnx6cfH/yXm5DFZxyQxcAoJ4Dfj24T3DsUVzGcwSJjLwSxkygk3ZVmv4X805gkHZRBNXwkQRv3/+NsP1nUsYvFvOMzI+PLXo/73DSxgsouIYOHj5UBRi8wJIwY8vnxlOLV/CIGcewsC4vkDhv01yLoOIoiqG7bgMACn88Owxw8HpvQyMGwqV/vs19TMwQnxDEthYW8DAeGCC3/9XN46TpBGmWEzDkoHx06dP/z9//kyWAby8vAwAcza2SBMOSCMAAAAASUVORK5CYII="
            alt="No Script" /> Javascript is disabled. Please enable it for better working experience.</div>
</noscript>

<!-- Start sidebar widget content -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">X</a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="index"><img src="assets/images/whiteTheMeta.png" alt="" /></a>
                        </div>
                        <div class="content-box">
                            <h4>About Us</h4>
                            <p>We believe in the potential of the web and apps for business success. Our products make
                                businesses stand out in the cut-throat competition.</p>
                        </div>
                        <div class="form-inner">
                            <h4>Get a free quote</h4>
                            <form method="post"
                                action="https://themetamavericks.com/webpages/bannerFormController.php">
                                <div class="form-group">
                                    <input type="text" name="Name" placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="Email" placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <textarea name="Message" placeholder="Message..."></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <input class="btmmain" type="Submit" value="Submit">
                                    <input type="hidden" name="ctry" value="">
                                    <!--<input type="hidden" name="pc" value="">-->
                                    <input type="hidden" name="cip" value="">
                                    <input type="hidden" name="hiddencapcha" value="">
                                    <input type="hidden" id="location" name="locationURL"
                                        value="https://themetamavericks.com/">
                                    <input type="hidden" id="formtype" name="formtype" value="1">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End sidebar widget content -->



<div class="page-wrapper">
    <header class="main-header">
        <nav class="main-menu">
            <div class="main-menu__wrapper">
                <div class="main-menu__wrapper-inner">
                    <div class="main-menu__left">
                        <div class="main-menu__logo">
                            <a href="{{ route('home') }}"><img src="assets/images/whiteTheMeta.png" alt=""></a>
                            <!-- <h4 style="    color: #fff;
    font-size: 26px;
    line-height: 44px;">The Meta Mavericks</h4> -->
                        </div>
                    </div>
                    <div class="main-menu__main-menu-box">
                        <div class="main-menu__main-menu-box-left">
                            <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                            <ul class="main-menu__list">
                                <li class="dropdown current">
                                    <a href="{{ route('home') }}">Home </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#">Services</a>
                                    <div class="dropwrp">
                                        <div class="row">
                                            <div class="col-md-6 p-0">
                                                <ul>
                                                    <li><a href="{{ route('digital-commerce') }}">Digital Commerce </a></li>
                                                    <li><a href="{{ route('business-process-outsourcing') }}">Business Process Outsourcing</a></li>
                                                    <li><a href="{{ route('e-commerce-development') }}">E Commerce Development</a></li>
                                                    <li><a href="{{ route('app-development') }}">Application Development </a></li>
                                                    <li><a href="{{ route('game-app-development') }}">Game Development</a></li>


                                                </ul>
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <ul>
                                                    <li><a href="{{ route('security') }}">Security</a></li>
                                                    <li><a href="{{ route('blockchain-game-development') }}">Blockchain Game Development</a></li>
                                                    <li><a href="{{ route('user-experience') }}">User Experience</a></li>
                                                    <li><a href="{{ route('cloud-team') }}">Cloud Team</a></li>
                                                    <li><a href="{{ route('quality-assurance') }}">Quality Assurance</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ route('about') }}">About</a>
                                </li>

                                <li>
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="main-menu__main-menu-box-right">
                            <div class="main-menu__call-btn-box">
                                <div class="main-menu__call">
                                    <div class="main-menu__call-icon">
                                        <span class="icon-phone"></span>
                                    </div>
                                    <div class="main-menu__call-content">
                                        <p>Make a call</p>
                                        <h4><a href="tel:+12812153298">(281) 215-3298</a></h4>
                                    </div>
                                </div>
                                <div class="main-menu__btn-box">
                                    <a href="{{ route('contact') }}" class="main-menu__btn">Lets Talk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu__right">
                        <div class="main-menu__bottom-search-nav-sidebar">
                            <div class="main-menu__search-box">
                                <a href="javascript:;"
                                    class="main-menu__search search-toggler icon-search"><span>Search</span></a>
                            </div>
                            <div class="main-menu__side-content-icon">
                                <a class="navSidebar-button" href="javascript:;"><span
                                        class="icon-dots-menu"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
