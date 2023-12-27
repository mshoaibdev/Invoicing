<!doctype html>
<html lang="en">

<head>
    <title>Design and Development Agency | The Meta Mavericks</title>
    <meta name="keywords" content="">
    <meta name="description"
        content="Award-winning Mobile App Development Company in USA specializing in mobile app services. Hire mobile app developers to create cutting-edge apps.">

    <x-head-links />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    <style>
      .h3 {
        font-size: 26px;
      }
  
      @media (max-width: 991px) {
        .h3 {
          font-size: 20px;
        }
      }
  
      @media (max-width: 767px) {
        .h3 {
          font-size: 18px;
        }
      }
    </style>

</head>

<body class="landing-page">
  <div class="page-wrapper">
    <header class="main-header">
      <nav class="main-menu">
        <div class="main-menu__wrapper">
          <div class="main-menu__wrapper-inner row align-items-center">
            <div class="col-4 col-sm-3 col-lg-2">
              <div class="main-menu__logo">
                <a href="index"><img src="assets/images/whiteTheMeta.png" alt="" /></a>
              </div>
            </div>
            <div class="col d-none d-sm-block">
              <h6 class="text-center py-2">
                Have A Creative Business Idea?
                <span class="text-prime">Let's Talk And Make It A Reality.</span>
              </h6>
            </div>
            <div class="col-3 col-lg-2">
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                <span class="d-none d-lg-inline-block">Talk to us</span>
                <span class="d-inline-block d-lg-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                  </svg>
                </span>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <main class="main-page-wrapper design-and-dev__lp">
      <section class="hero-section">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="content-wrap text-center text-md-start py-4">
                <h1 class="mb-4">
                  Unleash the Power of Modern Tech with Meta Mavericks
                </h1>
                <!-- <h1 class="mb-4">
                  Web Designing &<br />Business Development Agency
                </h1> -->
                <p class="text-white mb-3 mb-lg-4">
                  Your One-Stop Destination for Spectacular Website Design, Development, and Logo Design Services!
                </p>
                <a href="#" class="btn btn-primary d-inline-flex gap-2" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Let's Talk
                  <svg width="14" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 7.16211H17M17 7.16211L11 1.16211M17 7.16211L11 13.1621" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </a>
              </div>
            </div>
            <div class="col-md-5">
              <form action="{{ route('contact-form') }}" method="POST"  id="contact-form">
                @csrf
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Enter First Name"  name="name" />
                </div>
                <div class="form-group mb-3">
                  <input type="email" class="form-control" placeholder="Enter Your Email" name="email"/>
                </div>
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phone" />
                </div>
                <div class="form-group mb-3">
                  <textarea  id="" rows="6" class="form-control" name="message" placeholder="Tell us how can we help you"></textarea>
                </div>
                <div class="form-group mb-3">
                  <button type="submit" class="btn bg-white w-100 btn-light " id="contact-form-btn" >
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <section class="our-process-section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="mb-4 text-center">Our Process</h2>
              <!-- <img
                  src="assets/images/design-and-development/4905735638964569.png"
                  class="w-100 d-block mb-3"
                /> -->
                <x-our-process-svg />
            </div>
          </div>
        </div>
      </section>

      <section class="our-portfolio-section" data-section-toggle-scope>
        <div class="container">
          <div class="row text-center justify-content-center mb-3 mb-lg-4">
            <div class="col-12 col-md-6 col-lg-5">
              <h2 class="text-white mb-3">Our Portfolio</h2>
              <p class="text-white">
                Where Creativity Meets Strategy: Unleash Your Brand's
                Potential with Innovative Design Agency.
              </p>
            </div>
          </div>
          <div class="row justify-content-center mb-4 mb-lg-5">
            <div class="col-12 col-md-9 col-lg-8">
              <div class="d-flex flex-wrap justify-content-center gap-2 gap-lg-3">
                <a href="#" class="btn btn-light active rounded-5" data-section-toggle="logosPortfolio">Logo Design</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="websitePortfolio">Website Development</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="mobileAppPortfolio">E-commerce</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="videoAnimationPortfolio">Video Animation</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="mobilePortfolio">Mobile Application</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="uiuxPortfolio">UI/UX Design</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="socialMediaPortfolio">Social Media management</a>
              </div>
            </div>
          </div>
          <div class="row mb-4 active" data-section="logosPortfolio">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.41.54 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.42.01 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.44.16 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.42.27 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.43.14 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/logo/Screenshot 2023-12-09 at 4.43.34 AM.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="websitePortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-car-wash-wcopilot-webflow-io-2023-11-29-21_32_36.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-cardealer-potenzaglobalsolutions-2023-12-14-03_59_41.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-cccbd-2023-12-14-04_03_26.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-compagniedeprovence-gb-2023-12-14-03_42_43.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-diamonddealerdirect-co-uk-2023-12-14-03_57_53.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-dimt-co-uk-2023-12-14-03_50_30.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="mobileAppPortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-doe-co-nz-2023-12-14-03_46_23.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-framebridge-2023-11-29-21_30_18.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-garlandpowersports-2023-12-14-03_45_18.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-giftshire-2023-11-29-21_30_51.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-wokculture-au-2023-12-14-03_41_49.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-goodcounsel-2023-11-29-21_29_25.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="videoAnimationPortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/49725634089562390483735.mp4" class="w-100" controls muted>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/892346590234562789345.mp4" class="w-100" controls muted>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/54690736823945h3.mp4" class="w-100" controls muted>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/492gh0857tg284g57825.mp4" class="w-100" controls muted>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/f3478fg278954f4.mp4" class="w-100" controls muted>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="video-wrap mb-4">
                <video src="assets/images/design-and-development/portfolio/videos/g78f4f2873g487234fg82734.mp4" class="w-100" controls muted>
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="mobilePortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA1.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA10.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA11.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA12.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA13.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/mobile-app/MA14.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="uiuxPortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-wokculture-au-2023-12-14-03_41_49.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-wnder-2023-12-14-04_04_45.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-virtual-assistant-128-webflow-io-2023-12-14-03_39_24.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-urbanopticon-2023-11-29-21_28_41.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-theiceco-co-uk-2023-12-14-03_51_07.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio/websites/screencapture-summitsteelworks-2023-12-14-03_53_24.jpg" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="row mb-4" data-section="socialMediaPortfolio" style="display: none;">
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__325656456456895.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__894523573453765.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__8953425346.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__89554534536342.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__89562347895623847.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="img-wrap mb-4">
                <img src="assets/images/design-and-development/portfolio__89562347895623847weq2w3.png" alt="" class="img-fluid" loading="lazy" />
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="#" class="btn btn-circular bg-white">
              View all Projects
            </a>
          </div>
        </div>
      </section>

      <section class="freelancer-section">
        <div class="container">
          <h2 class="text-center">We are everywhere</h2>
          <div class="row align-items-center justify-content-between py-lg-4 mb-4">
            <div class="col p-3 col-md-auto">
              <div class="img-wrap">
                <img src="assets/images/design-and-development/upwork-logo-png-transparent.png" class="img-fluid" />
              </div>
            </div>
            <div class="col p-3 col-md-auto">
              <div class="img-wrap">
                <img src="assets/images/design-and-development/Bark_Logo800-200.png" class="img-fluid" />
              </div>
            </div>
            <div class="col p-3 col-md-auto">
              <div class="img-wrap">
                <img src="assets/images/design-and-development/thumbtack3742894.png" class="img-fluid" />
              </div>
            </div>
            <div class="col p-3 col-md-auto">
              <div class="img-wrap">
                <img src="assets/images/design-and-development/2560px-Fiverr_logo.png" class="img-fluid" />
              </div>
            </div>
          </div>
          <h4 class="text-lighter text-center fw-normal">
            We are one stop solution for all your business needs.
          </h4>
        </div>
      </section>

      <section class="why-choose-us-section">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="img-wrap mb-4 mb-md-0">
                <img src="assets/images/design-and-development/attractive-girl-by-window.png" class="img-fluid" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="text-center text-md-start px-lg-4 px-xl-5">
                <h2>Why Choose Us?</h2>
                <p>
                  Metamavericks exceptional website solutions for your
                  business. Our team of experts combines creativity and
                  technical expertise to deliver outstanding results that meet
                  your unique needs and goals. With a focus on quality and
                  customer satisfaction, our website design agency ensures
                  that every aspect of your website is tailored to your
                  specific requirements. Our web development and design
                  services will take your online presence to new heights. Let
                  us help you succeed online.
                </p>
                <p>
                  <strong class="fw-medium">
                    Call Us and discuss your project with our experts today.
                  </strong>
                </p>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 mb-4">
                  <div class="col-auto">
                    <a href="tel:12812153298" class="border border-2 rounded-4 border-dark py-2 px-4 d-inline-block w-100">
                      <small>Just a call away</small><br />
                      <strong>Call Now</strong>
                    </a>
                  </div>
                  <div class="col-auto">
                    <a href="mailto:info@themetamavericks.com" class="border border-2 rounded-4 border-dark py-2 px-4 d-inline-block w-100">
                      <small>Merely a click away</small><br />
                      <strong>Email Now</strong>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="comprehensive-packages-section" data-section-toggle-scope>
        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-12 col-md-11 col-lg-9">
              <h2>Our Comprehensive Packages</h2>
              <p class="px-lg-5 mx-xl-5">
                "Invest in your company's future with our comprehensive
                financial solution. Contact us for pricing details and see how
                we can help you streamline your finances and reach your
                business goals.
              </p>
            </div>
          </div>
          <div class="row justify-content-center mb-4 mb-lg-5">
            <div class="col-12 col-md-11">
              <div class="d-flex flex-wrap justify-content-center gap-2 gap-lg-3 comprehensive-packages-nav">
                <a href="#" class="btn btn-light active rounded-5" data-section-toggle="logoDesignLogos">Logo Design</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="webDesignLogos">Website Development</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="mobileAppsLogos">Mobile Apps</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="eCommerceLogos">E-commerce</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="videoAnimationLogos">Video Animation</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="seoLogos">Search Engine Optimization</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="socialMediaLogos">Social Media management</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="gameDevelopmentLogos">Game Development</a>
                <a href="#" class="btn btn-light bg-white rounded-5" data-section-toggle="completeBusinessBranding">Complete Business Branding</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-5 pb-lg-5 active" data-section="logoDesignLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/logo-design/Group 806.png" />
                <img src="assets/images/design-and-development/logo-design/Group 807.png" />
                <img src="assets/images/design-and-development/logo-design/Group 808.png" />
                <img src="assets/images/design-and-development/logo-design/Group 809.png" />
                <img src="assets/images/design-and-development/logo-design/Group 810.png" />
                <img src="assets/images/design-and-development/logo-design/Group 811.png" />
                <img src="assets/images/design-and-development/logo-design/Group 812.png" />
                <img src="assets/images/design-and-development/logo-design/Group 813.png" />
                <img src="assets/images/design-and-development/logo-design/Group 814.png" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="webDesignLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dot-net/dot-net-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="mobileAppsLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/c/c-original.svg" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/androidstudio/androidstudio-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apple/apple-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/coffeescript/coffeescript-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain-wordmark.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/swift/swift-original.svg" />

                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" />

              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="eCommerceLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/ecommerce/Group 240.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 241.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 242.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 243.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 244.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 245.png" />
                <img src="assets/images/design-and-development/ecommerce/Group 246.png" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="videoAnimationLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/logo-design/Group 806.png" />
                <img src="assets/images/design-and-development/logo-design/Group 807.png" />
                <img src="assets/images/design-and-development/logo-design/Group 808.png" />
                <img src="assets/images/design-and-development/logo-design/Group 809.png" />
                <img src="assets/images/design-and-development/logo-design/Group 810.png" />
                <img src="assets/images/design-and-development/logo-design/Group 811.png" />
                <img src="assets/images/design-and-development/logo-design/Group 812.png" />
                <img src="assets/images/design-and-development/logo-design/Group 813.png" />
                <img src="assets/images/design-and-development/logo-design/Group 814.png" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="seoLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/seo/ClickFunnels.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/Google Analytics.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/Google Logomark.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/LeadPages.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/Mailchimp.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/Marketo.png" class="shadow-sm rounded-3 p-3" />
                <img src="assets/images/design-and-development/seo/Semrush Logomark.png" class="shadow-sm rounded-3 p-3" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="socialMediaLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/social-media/social_media_1.png" />
                <img src="assets/images/design-and-development/social-media/social_media_2.png" />
                <img src="assets/images/design-and-development/social-media/social_media_3.png" />
                <img src="assets/images/design-and-development/social-media/social_media_4.png" />
                <img src="assets/images/design-and-development/social-media/social_media_5.png" />
                <img src="assets/images/design-and-development/social-media/social_media_6.png" />
              </div>
            </div>
            <div class="col-12 mb-5 pb-lg-5" data-section="gameDevelopmentLogos">
              <div class="d-flex justify-content-center flex-wrap gap-3 services-offered-logos">
                <img src="assets/images/design-and-development/game-dev/26.png" />
                <img src="assets/images/design-and-development/game-dev/c-.png" />
                <img src="assets/images/design-and-development/game-dev/c-sharp.png" />
                <img src="assets/images/design-and-development/game-dev/java.png" />
                <img src="assets/images/design-and-development/game-dev/swift.png" />
                <img src="assets/images/design-and-development/game-dev/unity.png" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/go/go-original-wordmark.svg" />
              </div>
            </div>
          </div>
        </div>
        <!-- logo packages -->
        <div class="container active" data-section="logoDesignLogos">
          <div class="row justify-content-center">
            <!-- basic plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Logo Basic </h4>
                <h2 class="mb-3">$25</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">4 Logo Concepts</li>
                  <li class="mb-2">4 Revisions</li>
                  <li class="mb-2">1 Dedicated Designer</li>
                  <li class="mb-2">With Grey Scale Format</li>
                  <li class="mb-2">Format: JPEG</li>
                  <li class="mb-2">TAT: 48 – 72 Hours</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">100% Unique Design Guarantee</li>
                  <li class="mb-2">100% Money Back Guarantee</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- basic plan -->

            <!-- standard plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Logo Special </h4>
                <h2 class="mb-3">$64</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">6 Logo concepts</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">3 Industry Specific Designers (Dedicated Designers)</li>
                  <li class="mb-2">With Grey Scale Format</li>
                  <li class="mb-2">Free Icon Design</li>
                  <li class="mb-2">Formats: AI, PSD, EPS, PNG, SVG, JPG, PDF</li>
                  <li class="mb-2">TAT: 48 – 72 Hours</li>
                  <li class="mb-2">100% Satisfaction</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">Dedicated Account Manager</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- standard plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Logo Business</h4>
                <h2 class="mb-3">$124</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">10 Original Logo Concepts</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">5 Industry Specific Designers (Dedicated Designers)</li>
                  <li class="mb-2">Stationery Design (Business Card, Letterhead, Envelope)</li>
                  <li class="mb-2">FREE MS Word Letterhead</li>
                  <li class="mb-2">With Grey Scale Format</li>
                  <li class="mb-2">Free Icon Design</li>
                  <li class="mb-2">Formats: AI, PSD, EPS, PNG, SVG, JPG, PDF</li>
                  <li class="mb-2">TAT: 48 – 72 Hours</li>
                  <li class="mb-2">100% Satisfaction</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">Dedicated Account Manager</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Logo Elite</h4>
                <h2 class="mb-3">$160</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Unlimited Original Logo Concepts</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">8 Industry Specific Designers (Dedicated Designers)</li>
                  <li class="mb-2">Stationery Design (Business Card, Letterhead, Envelope)</li>
                  <li class="mb-2">FREE MS Word Letterhead</li>
                  <li class="mb-2">Icon Design</li>
                  <li class="mb-2">FREE Email Signature</li>
                  <li class="mb-2">FREE Social Media Banner</li>
                  <li class="mb-2">With Grey Scale Format</li>
                  <li class="mb-2">Formats: AI, PSD, EPS, PNG, SVG, JPG, PDF</li>
                  <li class="mb-2">TAT: 48 – 72 Hours</li>
                  <li class="mb-2">100% Satisfaction</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">Dedicated Account Manager</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Illustrative Logo Design</h4>
                <h2 class="mb-3">$299</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Comprehensive Consultation</li>
                  <li class="mb-2">Dedicated Illustrator</li>
                  <li class="mb-2">Unique Illustrative Design</li>
                  <li class="mb-2">Multiple Concept Choices</li>
                  <li class="mb-2">Unlimited Revision Rounds</li>
                  <li class="mb-2"> Stationery Design (Business Card, Letterhead, Envelope)</li>
                  <li class="mb-2">With Grey Scale Format</li>
                  <li class="mb-2">Formats: AI, PSD, EPS, PNG, SVG, JPG, PDF</li>
                  <li class="mb-2">TAT: 48 – 72 Hours</li>
                  <li class="mb-2">100% Satisfaction</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">Dedicated Account Manager</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->
          </div>
        </div>
        <!-- logo packages -->

        <!-- website packages -->
        <div class="container" data-section="webDesignLogos">
          <div class="row justify-content-center">
            <!-- basic plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Basic Website</h4>
                <h2 class="mb-3">$299</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">3 Page Website Design</li>
                  <li class="mb-2">Hover Effects</li>
                  <li class="mb-2">2 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">2 Stock Photos (You can provide us more)</li>
                  <li class="mb-2">Contact/Query Form</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- basic plan -->

            <!-- standard plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Professional Website</h4>
                <h2 class="mb-3">$699</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Up to 6 Pages Website Design</li>
                  <li class="mb-2">4 Stock Photos (You can provide us more)</li>
                  <li class="mb-2">2 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">Hover Effects</li>
                  <li class="mb-2">Content Management System (WordPress)</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Contact/Query Form</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Industry specified Team of Expert Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- standard plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Elite Website</h4>
                <h2 class="mb-3">$1099</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Upto 10 Pages Website Design</li>
                  <li class="mb-2">Custom, Interactive, Dynamic & High-End Web Design</li>
                  <li class="mb-2">Custom WordPress Development</li>
                  <li class="mb-2">5 Stock Images</li>
                  <li class="mb-2">5 Banner Designs</li>
                  <li class="mb-2">Sliding Banners</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hoover Effects</li>
                  <li class="mb-2">Content Management System </li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Online Appointment Booking, Scheduling and Online Ordering Integration (If required)</li>
                  <li class="mb-2">Google Friendly Sitemap</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Industry specified Team of Expert Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Identity Website</h4>
                <h2 class="mb-3">$1399</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">12 Unique Pages Website Design</li>
                  <li class="mb-2">Custom, Interactive, Dynamic & High-End Design</li>
                  <li class="mb-2">Customize WordPress (or) PHP Development</li>
                  <li class="mb-2">Interactive Sliding Banners</li>
                  <li class="mb-2">10 Stock Images</li>
                  <li class="mb-2">10 Banner Designs</li>
                  <li class="mb-2">Special Hoover Effects</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Content Management System (WordPress or Custom)</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Online Appointment Booking, Scheduling and Online Ordering Integration (Optional)</li>
                  <li class="mb-2">Online Payment Integration (Optional)</li>
                  <li class="mb-2">Google Friendly Sitemap</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Industry specified Team of Award-Winning Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->

            <!-- premium plan -->
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Business Website</h4>
                <h2 class="mb-3">$2299</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">15 to 20 Pages Website</li>
                  <li class="mb-2">Custom Made, Interactive, Dynamic & High-End Design</li>
                  <li class="mb-2">Custom WP (or) Custom PHP Development</li>
                  <li class="mb-2">1 jQuery Slider Banner</li>
                  <li class="mb-2">6 Custom Made Banner Designs</li>
                  <li class="mb-2">12 Stock Images</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hoover Effects</li>
                  <li class="mb-2">Content Management System (CMS)</li>
                  <li class="mb-2">Online Appointment/Scheduling/Online Ordering Integration (Optional)</li>
                  <li class="mb-2">Online Payment Integration (Optional)</li>
                  <li class="mb-2">Multi Lingual (Optional)</li>
                  <li class="mb-2">Custom Dynamic Forms (Optional)</li>
                  <li class="mb-2">Signup Area (For Newsletters, Offers etc.)</li>
                  <li class="mb-2">Search Bar</li>
                  <li class="mb-2">Live Feeds of Social Networks integration (Optional)</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">FREE 1 Year Domain Name</li>
                  <li class="mb-2">FREE 1 Year Hosting</li>
                  <li class="mb-2">5 Email Addresses</li>
                  <li class="mb-2">Free Google Friendly Sitemap</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Industry Specified Team of Expert Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Dedicated Accounts Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">100% Unique Design Guarantee</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
            <!-- premium plan -->
          </div>
        </div>
        <!-- website packages -->

        <!-- complete bundle packages -->
        <div class="container" data-section="completeBusinessBranding">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>SEO</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">10 Keywords</li>
                  <li class="mb-2">Guaranteed Ranking on Google</li>
                  <li class="mb-2">Off-site Optimization</li>
                  <li class="mb-2">Link Building</li>
                  <li class="mb-2">Social Bookmarking</li>
                  <li class="mb-2">Basic Analytical Report</li>
                  <li class="mb-2">In-depth Site Analysis</li>
                  <li class="mb-2">Content Duplicity Check</li>
                  <li class="mb-2">Initial Backlinks analysis</li>
                  <li class="mb-2">Google Penalty Check</li>
                  <li class="mb-2">Mobile Usability Check</li>
                  <li class="mb-2">Competition Analysis</li>
                  <li class="mb-2">Keyword Research</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Stationary Design</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">Letterhead Design</li>
                  <li class="mb-2">Business Card Design</li>
                  <li class="mb-2">Envelope Design</li>
                  <li class="mb-2">Email Signature Design</li>
                  <li class="mb-2">Electronic Letterhead</li>
                  <li class="mb-2">Invoice Design</li>
                  <li class="mb-2">2 Sided Flyer Design OR Bi-Fold Brochure Design</li>
                  <li class="mb-2">Company Profile Design</li>
                  <li class="mb-2">T-Shirt Design</li>
                  <li class="mb-2">Signage Design</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>WEBSITE</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">Unlimited Pages 100% Custom Design</li>
                  <li class="mb-2">Custom Made, Interactive, Dynamic & High-End Design</li>
                  <li class="mb-2">Customized WordPress & PHP Development</li>
                  <li class="mb-2">Interactive Sliding Banners</li>
                  <li class="mb-2">Up to 15 Custom Made Banner Designs</li>
                  <li class="mb-2">15 Stock Images</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hover Effects</li>
                  <li class="mb-2">Content Management System</li>
                  <li class="mb-2">Online Appointment /Booking /Scheduling /Online Ordering Integration</li>
                  <li class="mb-2">Online Payment Integration</li>
                  <li class="mb-2">Multi Lingual</li>
                  <li class="mb-2">Custom Dynamic Forms</li>
                  <li class="mb-2">Signup Area (For Newsletters, Offers etc.)</li>
                  <li class="mb-2">Search Bar</li>
                  <li class="mb-2">Live Feeds of Social Networks integration</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">FREE 12 Months Domain Name</li>
                  <li class="mb-2">FREE 12 Month Hosting</li>
                  <li class="mb-2">Up to 5 Professional Email ID’s</li>
                  <li class="mb-2">Google Friendly Sitemap</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Complete W3C Certified HTML</li>
                  <li class="mb-2">Industry specified Team of Award-Winning Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                </ul>
              </div>
            </div>


            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Logo Design</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">Unlimited Logo Design Idea(s)</li>
                  <li class="mb-2">By 6 Award Winning Designer(s)</li>
                  <li class="mb-2">Free Icon Design</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">2 to 3 Business Days TAT</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Social Media Page Design</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">Facebook Icon Image & Banner Design</li>
                  <li class="mb-2">Twitter Icon Image & Banner Design</li>
                  <li class="mb-2">Google+ Icon Image & Banner Design</li>
                  <li class="mb-2">YouTube Icon Image & Banner Design</li>
                  <li class="mb-2">LinkedIn Icon Image & Banner Design</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Video Animation</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">60 Seconds 2D Video Animation</li>
                  <li class="mb-2">Script Writing</li>
                  <li class="mb-2">Story Board</li>
                  <li class="mb-2">Voice Over</li>
                  <li class="mb-2">Animation with Sound Effect</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Value Added Services</h4>
                <ul class="list-unstyled list-ticked">
                  <li class="mb-2">Logo Design Final Files (.AI, .PSD, .EPS, .PNG, .JPG, .PDF, .TIFF)</li>
                  <li class="mb-2">Website Design Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">100% Money Back Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                  <li class="mb-2">Professional Content/Copywriting</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Additional Professional Email ID</li>
                </ul>
              </div>
            </div>

            <div class="col-12">
              <div class="text-center">
                <h4 class="mb-3">Talk to our consultant now to get a quote!</h4>
                <a href="tel:+12812153298" class="btn btn-call-animate">Call Us Now</a>
              </div>
            </div>
          </div>
        </div>
        <!-- complete bundle packages -->

        <!-- ecommerce packages -->
        <div class="container" data-section="eCommerceLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Basic Website</h4>
                <h2 class="mb-3">$399</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">Theme Based Design</li>
                  <li class="mb-2">2 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">3 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Hover Effects</li>
                  <li class="mb-2">Up to 10 Products</li>
                  <li class="mb-2">Up to 3 Categories</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Startup Website</h4>
                <h2 class="mb-3">$599</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">High-end Theme Based Design</li>
                  <li class="mb-2">5 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">5 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Hover Effects</li>
                  <li class="mb-2">Up to 25 Products</li>
                  <li class="mb-2">Up to 5 Categories</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Social Media Pages Integration</li>
                  <li class="mb-2">Sitemap</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Professional</h4>
                <h2 class="mb-3">$1199</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">Customized Theme Based Design</li>
                  <li class="mb-2">7 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">7 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Hover Effects</li>
                  <li class="mb-2">Up to 100 Products</li>
                  <li class="mb-2">Up to 10 Categories</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Social Media Pages Integration</li>
                  <li class="mb-2">Sitemap</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Elite </h4>
                <h2 class="mb-3">$1499</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">Customized Tailor-Made Design</li>
                  <li class="mb-2">Professional, Modern, Unique Design</li>
                  <li class="mb-2">10 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">10 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hover Effects</li>
                  <li class="mb-2">Up to 500 Products</li>
                  <li class="mb-2">Up to 25 Categories</li>
                  <li class="mb-2">Product Reviews & Ratings</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Social Media Pages Integration</li>
                  <li class="mb-2">Blog page (If required)</li>
                  <li class="mb-2">Sitemap</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Identity</h4>
                <h2 class="mb-3">$2399</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">Customized Tailor-Made Design</li>
                  <li class="mb-2">Professional, Modern, Interactive, Dynamic, Unique Design</li>
                  <li class="mb-2">User-friendly Navigation</li>
                  <li class="mb-2">20 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">20 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hover Effects</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Unlimited Products</li>
                  <li class="mb-2">FREE 1 Year Domain </li>
                  <li class="mb-2">FREE 1 Year Hosting</li>
                  <li class="mb-2">Unlimited Categories</li>
                  <li class="mb-2">Product Reviews & Ratings</li>
                  <li class="mb-2">Product Summary Reports (Out of stock / Most Sold / Lowest sale etc) By Date</li>
                  <li class="mb-2">Product Rating</li>
                  <li class="mb-2">Product Detail with Similar Product Range</li>
                  <li class="mb-2">Product Comparison</li>
                  <li class="mb-2">Discounted Products Showcase</li>
                  <li class="mb-2">New Arrival Products Showcase</li>
                  <li class="mb-2">Discount Coupons</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Bulk Product Upload From Excel Sheet</li>
                  <li class="mb-2">Export order into excel sheet</li>
                  <li class="mb-2">Social Media Pages Integration</li>
                  <li class="mb-2">Facebook Shop Setup</li>
                  <li class="mb-2">Blog page (If required)</li>
                  <li class="mb-2">Sitemap</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>eCommerce Corporate</h4>
                <h2 class="mb-3">$2999</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">E-Commerce Website Design and Development</li>
                  <li class="mb-2">Customized Tailor-Made Design</li>
                  <li class="mb-2">Professional, Modern, Interactive, Dynamic, Unique Design</li>
                  <li class="mb-2">User-friendly Navigation</li>
                  <li class="mb-2">20 Banner Designs</li>
                  <li class="mb-2">Sliding Banner</li>
                  <li class="mb-2">20 Stock Photos</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Special Hover Effects</li>
                  <li class="mb-2">Content/Inventory Management System</li>
                  <li class="mb-2">Mobile Responsive</li>
                  <li class="mb-2">Unlimited Products</li>
                  <li class="mb-2">Unlimited Categories</li>
                  <li class="mb-2">FREE 3 Year Domain </li>
                  <li class="mb-2">FREE 3 Year Hosting</li>
                  <li class="mb-2">Product Reviews & Ratings</li>
                  <li class="mb-2">Product Summary Reports (Out of stock / Most Sold / Lowest sale etc) By Date</li>
                  <li class="mb-2">Product Rating</li>
                  <li class="mb-2">Product Detail with Similar Product Range</li>
                  <li class="mb-2">Product Comparison</li>
                  <li class="mb-2">Discounted Products Showcase</li>
                  <li class="mb-2">New Arrival Products Showcase</li>
                  <li class="mb-2">Discount Coupons</li>
                  <li class="mb-2">Easy Product Search Bar</li>
                  <li class="mb-2">Shopping Cart Integration</li>
                  <li class="mb-2">Payment Module Integration</li>
                  <li class="mb-2">Direct Checkout</li>
                  <li class="mb-2">Sign up Checkout</li>
                  <li class="mb-2">Wishlist</li>
                  <li class="mb-2">Bulk Product Upload from Excel Sheet</li>
                  <li class="mb-2">Export order into excel sheet</li>
                  <li class="mb-2">Social Media Pages Integration</li>
                  <li class="mb-2">Facebook Shop Setup</li>
                  <li class="mb-2">Blog page (If required)</li>
                  <li class="mb-2">Sitemap</li>
                  <li class="mb-2">Complete W3C Validation</li>
                  <li class="mb-2">Dedicated Team of Designers and Developers</li>
                  <li class="mb-2">Complete Deployment</li>
                  <li class="mb-2 fw-bold no-tick">Value Added Services</li>
                  <li class="mb-2">Complete Source Files</li>
                  <li class="mb-2">Dedicated Project Manager</li>
                  <li class="mb-2">100% Ownership Rights</li>
                  <li class="mb-2">100% Satisfaction Guarantee</li>
                  <li class="mb-2">*NO MONTHLY OR ANY HIDDEN FEE*</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
          <!-- ecommerce packages -->
        </div>
        <!-- ecommerce packages -->

        <!-- social media packages -->
        <div class="container" data-section="socialMediaLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Startup Package </h4>
                <h2 class="mb-3">$300<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">3 postings per week (per network) Facebook + Twitter + Instagram + Google+</li>
                  <li class="mb-2">Content Creation</li>
                  <li class="mb-2">Business Page Optimization</li>
                  <li class="mb-2">Social Media Strategy (Overview)</li>
                  <li class="mb-2">Facebook Likes Campaign</li>
                  <li class="mb-2">Monthly Progress report</li>
                  <li class="mb-2">Copy Writing</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Scaling Package</h4>
                <h2 class="mb-3">$649<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Copywriting & Visual designs</li>
                  <li class="mb-2">Business Page Optimization</li>
                  <li class="mb-2">Ad Campaign Management</li>
                  <li class="mb-2">Spam monitoring</li>
                  <li class="mb-2">Monthly Progress report</li>
                  <li class="mb-2">5 postings per week Facebook + Twitter + Instagram + Google+</li>
                  <li class="mb-2">Reputation Management</li>
                  <li class="mb-2">Social Account Setup</li>
                  <li class="mb-2">Content Creation</li>
                  <li class="mb-2">Social Media Hearing</li>
                  <li class="mb-2">Query and comments reply</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Venture Package</h4>
                <h2 class="mb-3">$1099<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Copywriting & Visual designs</li>
                  <li class="mb-2">Business Page Optimization</li>
                  <li class="mb-2">Ad Campaign Management</li>
                  <li class="mb-2">Spam monitoring</li>
                  <li class="mb-2">6 postings per week Facebook + Twitter + Instagram + Google+</li>
                  <li class="mb-2">Reputation Management</li>
                  <li class="mb-2">Social Account Setup</li>
                  <li class="mb-2">Content Creation</li>
                  <li class="mb-2">Social Media Hearing</li>
                  <li class="mb-2">Query and comments reply</li>
                  <li class="mb-2">Monthly Progress report</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
          <!-- ecommerce packages -->
        </div>
        <!-- social media packages -->

        <!-- search engine optimization packages -->
        <div class="container" data-section="seoLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>SEO Basic</h4>
                <h2 class="mb-3">$299<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Upto 5 Keywords</li>
                  <li class="mb-2">RESEARCH AND ANALYSIS</li>
                  <li class="mb-2">Website Analysis</li>
                  <li class="mb-2">1 Competitor Analysis</li>
                  <li class="mb-2">Backlink Analysis</li>
                  <li class="mb-2">Google Webmaster Code Creation</li>
                  <li class="mb-2">Google Analytics Code Creation</li>
                  <li class="mb-2">keyword Ranking & Analysis</li>
                  <li class="mb-2">Important HTML Tags (H1, H2 , H3 )</li>
                  <li class="mb-2">Link Optimization</li>
                  <li class="mb-2">ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">02 ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">Alt Tag & Image Optimization</li>
                  <li class="mb-2">Content Optimization</li>
                  <li class="mb-2">*Canonical Error Resolution</li>
                  <li class="mb-2">*Page Load Optimization</li>
                  <li class="mb-2">SITEWIDE OPTIMIZATION</li>
                  <li class="mb-2">Broken Link check</li>
                  <li class="mb-2">Mobile Friendly Check</li>
                  <li class="mb-2">Outbound Link Quality assessment</li>
                  <li class="mb-2">*Crawl Error Resolution</li>
                  <li class="mb-2">OFF PAGE OPTIMIZATION</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Google Local Listing</li>
                  <li class="mb-2">Classified Submission</li>
                  <li class="mb-2">2 Business Listing</li>
                  <li class="mb-2">REPORTS & ANALYTICS</li>
                  <li class="mb-2">Google Analytics</li>
                  <li class="mb-2">Keyword Ranking</li>
                  <li class="mb-2">Monthly Progress</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>SEO Standard</h4>
                <h2 class="mb-3">$499<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Link Optimization</li>
                  <li class="mb-2">ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">08 ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">Alt Tag & Image Optimization</li>
                  <li class="mb-2">Content Optimization</li>
                  <li class="mb-2">*Canonical Error Resolution</li>
                  <li class="mb-2">*Page Load Optimization</li>
                  <li class="mb-2">SITEWIDE OPTIMIZATION</li>
                  <li class="mb-2">Broken Link check</li>
                  <li class="mb-2">Mobile Friendly Check</li>
                  <li class="mb-2">Outbound Link Quality assessment</li>
                  <li class="mb-2">*Crawl Error Resolution</li>
                  <li class="mb-2">OFF PAGE OPTIMIZATION</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Google Local Listing</li>
                  <li class="mb-2">Classified Submission</li>
                  <li class="mb-2">Social Bookmarking</li>
                  <li class="mb-2">4 Business Listing</li>
                  <li class="mb-2">2 Image / Infographic Submission</li>
                  <li class="mb-2">1 Content Marketing</li>
                  <li class="mb-2">Spammy / low-quality backlinks removal</li>
                  <li class="mb-2">REPORTS & ANALYTICS</li>
                  <li class="mb-2">Google Analytics</li>
                  <li class="mb-2">Keyword Ranking</li>
                  <li class="mb-2">Monthly Progress</li>
                  <li class="mb-2">SOCIAL MEDIA OPTIMIZATION</li>
                  <li class="mb-2">1 Post Monthly (Facebook, Twitter, Instagram)</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>SEO Advanced</h4>
                <h2 class="mb-3">$749<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Upto 30 Keywords</li>
                  <li class="mb-2">RESEARCH AND ANALYSIS</li>
                  <li class="mb-2">Website Analysis</li>
                  <li class="mb-2">3 Competitor Analysis</li>
                  <li class="mb-2">Backlink Analysis</li>
                  <li class="mb-2">Google Webmaster Code Creation</li>
                  <li class="mb-2">Google Analytics Code Creation</li>
                  <li class="mb-2">keyword Ranking & Analysis</li>
                  <li class="mb-2">Duplicate Content Check</li>
                  <li class="mb-2">ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">15 ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">Alt Tag & Image Optimization</li>
                  <li class="mb-2">Anchor & Hyperlink Optimization</li>
                  <li class="mb-2">Content Optimization</li>
                  <li class="mb-2">*Canonical Error Resolution</li>
                  <li class="mb-2">*Structured Data Integration</li>
                  <li class="mb-2">SEO Friendly URL Rewriting</li>
                  <li class="mb-2">*Page Load Optimization</li>
                  <li class="mb-2">SITEWIDE OPTIMIZATION</li>
                  <li class="mb-2">Broken Link check</li>
                  <li class="mb-2">Mobile Friendly Check</li>
                  <li class="mb-2">Outbound Link Quality assessment</li>
                  <li class="mb-2">Google Analytic Setup</li>
                  <li class="mb-2">Google Webmaster Tool Setup</li>
                  <li class="mb-2">*Crawl Error Resolution</li>
                  <li class="mb-2">*Internal Link Structuring</li>
                  <li class="mb-2">OFF PAGE OPTIMIZATION</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Google Local Listing</li>
                  <li class="mb-2">Classified Submission</li>
                  <li class="mb-2">Social Bookmarking</li>
                  <li class="mb-2">6 Business Listing</li>
                  <li class="mb-2">4 Blog Posting</li>
                  <li class="mb-2">4 Q & A / Blog Commenting</li>
                  <li class="mb-2">4 Image / Infographic Submission</li>
                  <li class="mb-2">2 Content Marketing</li>
                  <li class="mb-2">Spammy / low-quality backlinks removal</li>
                  <li class="mb-2">REPORTS & ANALYTICS</li>
                  <li class="mb-2">Google Analytics</li>
                  <li class="mb-2">Keyword Ranking</li>
                  <li class="mb-2">Monthly Progress</li>
                  <li class="mb-2">SOCIAL MEDIA OPTIMIZATION</li>
                  <li class="mb-2">1 Post Monthly (Facebook, Twitter, Instagram)</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>SEO Elite</h4>
                <h2 class="mb-3">$749<sub>Monthly</sub></h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Upto 50 Keywords</li>
                  <li class="mb-2">RESEARCH AND ANALYSIS</li>
                  <li class="mb-2">Website Analysis</li>
                  <li class="mb-2">5 Competitor Analysis</li>
                  <li class="mb-2">Backlink Analysis</li>
                  <li class="mb-2">Google Webmaster Code Creation</li>
                  <li class="mb-2">Google Analytics Code Creation</li>
                  <li class="mb-2">keyword Ranking & Analysis</li>
                  <li class="mb-2">Duplicate Content Check</li>
                  <li class="mb-2">ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">30 ON PAGE OPTIMIZATION</li>
                  <li class="mb-2">Alt Tag & Image Optimization</li>
                  <li class="mb-2">Anchor & Hyperlink Optimization</li>
                  <li class="mb-2">Content Optimization</li>
                  <li class="mb-2">*Canonical Error Resolution</li>
                  <li class="mb-2">*Structured Data Integration</li>
                  <li class="mb-2">SEO Friendly URL Rewriting</li>
                  <li class="mb-2">*Page Load Optimization</li>
                  <li class="mb-2">SITEWIDE OPTIMIZATION</li>
                  <li class="mb-2">Broken Link check</li>
                  <li class="mb-2">Mobile Friendly Check</li>
                  <li class="mb-2">Outbound Link Quality assessment</li>
                  <li class="mb-2">Google Analytic Setup</li>
                  <li class="mb-2">Google Webmaster Tool Setup</li>
                  <li class="mb-2">*Crawl Error Resolution</li>
                  <li class="mb-2">*Internal Link Structuring</li>
                  <li class="mb-2">OFF PAGE OPTIMIZATION</li>
                  <li class="mb-2">Search Engine Submission</li>
                  <li class="mb-2">Google Local Listing</li>
                  <li class="mb-2">Classified Submission</li>
                  <li class="mb-2">Social Bookmarking</li>
                  <li class="mb-2">8 Business Listing</li>
                  <li class="mb-2">6 Blog Posting</li>
                  <li class="mb-2">6 Q & A / Blog Commenting</li>
                  <li class="mb-2">2 Press Release Writing & Submission</li>
                  <li class="mb-2">8 Image / Infographic Submission</li>
                  <li class="mb-2">3 Content Marketing</li>
                  <li class="mb-2">Spammy / low-quality backlinks removal</li>
                  <li class="mb-2">REPORTS & ANALYTICS</li>
                  <li class="mb-2">Google Analytics</li>
                  <li class="mb-2">Keyword Ranking</li>
                  <li class="mb-2">Monthly Progress</li>
                  <li class="mb-2">SOCIAL MEDIA OPTIMIZATION</li>
                  <li class="mb-2">Page Creation (Facebook, Twitter, Instagram)</li>
                  <li class="mb-2">1 Post Every Week (Facebook, Twitter, Instagram)</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- search engine optimization packages -->

        <!-- video packages -->
        <div class="container" data-section="videoAnimationLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>MOTION GRAPHIC</h4>
                <h2 class="mb-3">$399</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom Designed Artwork</li>
                  <li class="mb-2">Unlimited Storyboard Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">2-3 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>2D ANIMATION</h4>
                <h2 class="mb-3">$799</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom Designed Characters</li>
                  <li class="mb-2">Custom Designed Artwork</li>
                  <li class="mb-2">Unlimited Storyboard Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">2-3 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>ISOMETRIC ANIMATION</h4>
                <h2 class="mb-3">$999</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom Isometric Artwork</li>
                  <li class="mb-2">Custom Designed 2D Characters</li>
                  <li class="mb-2">Unlimited Storyboard Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">2-3 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>3D ANIMATION</h4>
                <h2 class="mb-3">$1799</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom 3D Designed Characters</li>
                  <li class="mb-2">Custom 3D Designed Artwork</li>
                  <li class="mb-2">Unlimited Storyboard Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">6-8 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>WHITEBOARD ANIMATION</h4>
                <h2 class="mb-3">$899</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom Designed Sketches</li>
                  <li class="mb-2">Custom Illustrated Characters</li>
                  <li class="mb-2">Unlimited Storyboard Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">4-5 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>TYPOGRAPHY</h4>
                <h2 class="mb-3">$199</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">60 Seconds Video Duration</li>
                  <li class="mb-2">Custom Text Designs</li>
                  <li class="mb-2">Custom Text Animation</li>
                  <li class="mb-2">Unlimited Revisions</li>
                  <li class="mb-2">Professional Voice-Over</li>
                  <li class="mb-2">Background Music</li>
                  <li class="mb-2">Exotic Animations</li>
                  <li class="mb-2">HD Video Production</li>
                  <li class="mb-2">1-2 Weeks Delivery Time</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- video packages -->

        <!-- game development packages -->
        <div class="container" data-section="gameDevelopmentLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Mini Game</h4>
                <h2 class="mb-3">$3900</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Development Platforms iOS/Android</li>
                  <li class="mb-2">Game Graphics</li>
                  <li class="mb-2">User Interface and User Experience Design</li>
                  <li class="mb-2">Animation System (Character Animation costs per second, like 1 sec rate is $10 and 30 sec @ $8 per sec. Facial expressions and lipsync cost is also in per sec.)</li>
                  <li class="mb-2">Environment 2D</li>
                  <li class="mb-2">Sounds</li>
                  <li class="mb-2">Special Effects</li>
                  <li class="mb-2">Offline One Player Game</li>
                  <li class="mb-2">Advertisement</li>
                  <li class="mb-2">Google Analytics/Firebase Tracking</li>
                  <li class="mb-2">Sign In</li>
                  <li class="mb-2">Friends</li>
                  <li class="mb-2">Achievements</li>
                  <li class="mb-2">Leaderboards</li>
                  <li class="mb-2">Testing</li>
                  <li class="mb-2">Social Sharing</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Simple 2D Game</h4>
                <h2 class="mb-3">$6999</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Development Platforms iOS/Android</li>
                  <li class="mb-2">Game Graphics</li>
                  <li class="mb-2">User Interface and User Experience Design</li>
                  <li class="mb-2">Animation System (Character Animation costs per second, like 1 sec rate is $10 and 30 sec @ $8 per sec. Facial expressions and lipsync cost is also in per sec.)</li>
                  <li class="mb-2">Environment 2D</li>
                  <li class="mb-2">Sounds</li>
                  <li class="mb-2">Special Effects</li>
                  <li class="mb-2">Multiplayer Games</li>
                  <li class="mb-2">Offline One Player Game</li>
                  <li class="mb-2">In-App Purchasing</li>
                  <li class="mb-2">Advertisement</li>
                  <li class="mb-2">Camera and Gallery</li>
                  <li class="mb-2">Local and Push Notifications</li>
                  <li class="mb-2">Google Analytics/Firebase Tracking</li>
                  <li class="mb-2">Sign In</li>
                  <li class="mb-2">Friends</li>
                  <li class="mb-2">Game Daily Rewards</li>
                  <li class="mb-2">Achievements</li>
                  <li class="mb-2">Leaderboards</li>
                  <li class="mb-2">Quests And Events</li>
                  <li class="mb-2">Testing</li>
                  <li class="mb-2">Social Sharing</li>
                  <li class="mb-2">Game Services</li>
                  <li class="mb-2">1 Revision/Updates</li>
                  <li class="mb-2">Anything of Your Choice 5 Add-ons</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Multi- Level 2D Game</h4>
                <h2 class="mb-3">$9999</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">Development Platforms iOS/Android</li>
                  <li class="mb-2">Game Graphics</li>
                  <li class="mb-2">User Interface and User Experience Design</li>
                  <li class="mb-2">Animation System (Character Animation costs per second, like 1 sec rate is $10 and 30 sec @ $8 per sec. Facial expressions and lipsync cost is also in per sec.)</li>
                  <li class="mb-2">Environment 2D</li>
                  <li class="mb-2">Sounds</li>
                  <li class="mb-2">Special Effects</li>
                  <li class="mb-2">Multiplayer Games</li>
                  <li class="mb-2">Offline One Player Game</li>
                  <li class="mb-2">In-App Purchasing</li>
                  <li class="mb-2">Advertisement</li>
                  <li class="mb-2">Real-time Multiplayer</li>
                  <li class="mb-2">Camera and Gallery</li>
                  <li class="mb-2">Local and Push Notifications</li>
                  <li class="mb-2">Google Analytics/Firebase Tracking</li>
                  <li class="mb-2">Sign In</li>
                  <li class="mb-2">Friends</li>
                  <li class="mb-2">Saved Game</li>
                  <li class="mb-2">Game Daily Rewards</li>
                  <li class="mb-2">Achievements</li>
                  <li class="mb-2">Leaderboards</li>
                  <li class="mb-2">Quests And Events</li>
                  <li class="mb-2">Testing</li>
                  <li class="mb-2">Social Sharing</li>
                  <li class="mb-2">Game Services</li>
                  <li class="mb-2">2 Revision/Updates</li>
                  <li class="mb-2">Anything of Your Choice 10 Add-ons</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- game development packages -->

        <!-- video packages -->
        <div class="container" data-section="mobileAppsLogos">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Basic</h4>
                <h2 class="mb-3">$2700</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">50% Upfront to get started with the work immediately</li>
                  <li class="mb-2">No. of Features Up to 7</li>
                  <li class="mb-2">Wireframing</li>
                  <li class="mb-2">Intuitive UI UX (Custom App Design)</li>
                  <li class="mb-2">Social Media Integration</li>
                  <li class="mb-2">App Testing</li>
                  <li class="mb-2">Publishing on App Store</li>
                  <li class="mb-2">Paid bug support ($350/m)</li>
                  <li class="mb-2">Native iOS OR Android app</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Standard</h4>
                <h2 class="mb-3">$5500</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">50% Upfront to get started with the work immediately</li>
                  <li class="mb-2">No. of Features Up to 10</li>
                  <li class="mb-2">Wireframing</li>
                  <li class="mb-2">Intuitive UI UX (Custom App Design)</li>
                  <li class="mb-2">Social Media Integration</li>
                  <li class="mb-2">App Testing</li>
                  <li class="mb-2">Ads Network Integration</li>
                  <li class="mb-2">Firebase Integration</li>
                  <li class="mb-2">In-App Purchase</li>
                  <li class="mb-2">Publishing on App Store</li>
                  <li class="mb-2">1 Month free bug support</li>
                  <li class="mb-2">Native iOS OR Android app</li>
                  <li class="mb-2">Cross-Platform (Hybrid) On Demand</li>
                  <li class="mb-2">Push Notifications</li>
                  <li class="mb-2">Messaging API Integration (Live Chat)</li>
                  <li class="mb-2">Google Maps Integration</li>
                  <li class="mb-2">Web APIs and Online Database</li>
                  <li class="mb-2">CrashAnalytics Integration</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="website-package-wrapper">
                <h4>Business</h4>
                <h2 class="mb-3">$10000</h2>
                <ul class="list-unstyled list-ticked mb-4 mb-lg-5">
                  <li class="mb-2">25% Upfront to get started with the work immediately</li>
                  <li class="mb-2">No. of Features Up to 25</li>
                  <li class="mb-2">Wireframing</li>
                  <li class="mb-2">Intuitive UI UX (Custom App Design)</li>
                  <li class="mb-2">Social Media Integration</li>
                  <li class="mb-2">App Testing</li>
                  <li class="mb-2">Ads Network Integration</li>
                  <li class="mb-2">Firebase Integration</li>
                  <li class="mb-2">In-App Purchase</li>
                  <li class="mb-2">Publishing on App Store</li>
                  <li class="mb-2">App Store Optimization</li>
                  <li class="mb-2">3 Month free bug support</li>
                  <li class="mb-2">Native iOS OR Android app</li>
                  <li class="mb-2">Cross-Platform (Hybrid) On Demand</li>
                  <li class="mb-2">Push Notifications</li>
                  <li class="mb-2">Messaging API Integration (Live Chat)</li>
                  <li class="mb-2">Regular App Updates Yearly 1 Update</li>
                  <li class="mb-2">Google Maps Integration</li>
                  <li class="mb-2">Admin Panel</li>
                  <li class="mb-2">Data Import/Export</li>
                  <li class="mb-2">Web APIs and Online Database</li>
                  <li class="mb-2">Picture Gallery/Product Display/Showcase Services On Demand</li>
                  <li class="mb-2">Product Categories/Sub Categories</li>
                  <li class="mb-2">CrashAnalytics Integration</li>
                  <li class="mb-2">Audio/Video Streaming</li>
                  <li class="mb-2">Payment Gateways Integration</li>
                  <li class="mb-2">Shopping Cart</li>
                  <li class="mb-2">3rd Party APIs Integrations</li>
                </ul>
                <button class="btn btn-outline-dark bg-white rounded-5 w-100 py-lg-3 fw-medium" data-bs-toggle="modal" data-bs-target="#get-a-quote-modal">
                  Get Started
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- video packages -->


      </section>

      <section class="client-testimonials-section py-5">
        <div class="container py-lg-5">
          <div class="row mb-5 text-center text-md-start">
            <div class="col-12 col-md-7">
              <h2 class="pe-lg-5 me-xl-5">
                What our clients have to say about us
              </h2>
            </div>
            <div class="col-12 col-md-5">
              <p class="fs-5 text-dark">
                Trust is earned though working hard and going beyond the
                limits. and our clients tell you why we can help you out.
              </p>
              <ul class="client-testimonials-nav d-flex flex-wrap justify-content-center justify-content-md-start gap-2 list-unstyled">
                <li>
                  <button class="btn btn-prev rounded-5">
                    <svg width="47" height="23" viewBox="0 0 47 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1.38319 10.3827C0.797401 10.9685 0.797401 11.9182 1.38319 12.504L10.9291 22.05C11.5149 22.6357 12.4647 22.6357 13.0504 22.05C13.6362 21.4642 13.6362 20.5144 13.0504 19.9286L4.56517 11.4434L13.0504 2.95808C13.6362 2.37229 13.6362 1.42254 13.0504 0.836758C12.4647 0.250971 11.5149 0.250971 10.9291 0.836758L1.38319 10.3827ZM46.4438 9.94336H2.44385V12.9434H46.4438V9.94336Z" fill="currentColor" />
                    </svg>
                  </button>
                </li>
                <li>
                  <button class="btn btn-next rounded-5">
                    <svg width="47" height="23" viewBox="0 0 47 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M45.6173 12.6173C46.2031 12.0315 46.2031 11.0818 45.6173 10.496L36.0714 0.950039C35.4856 0.364252 34.5358 0.364252 33.95 0.950039C33.3643 1.53583 33.3643 2.48557 33.95 3.07136L42.4353 11.5566L33.95 20.0419C33.3643 20.6277 33.3643 21.5775 33.95 22.1632C34.5358 22.749 35.4856 22.749 36.0714 22.1632L45.6173 12.6173ZM0.556641 13.0566L44.5566 13.0566V10.0566L0.556641 10.0566L0.556641 13.0566Z" fill="currentColor" />
                    </svg>
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <div class="client-testimonials-carousel swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <p class="mb-4 text-inherit">
                    Our collaboration with the Meta Mavericks team was a smooth and highly rewarding journey. Our dedicated Project Manager Ray was instrumental in making the entire process effortless and transparent. Constant updates ensured we were always in the loop and well informed at every stage. Our gratitude goes to Claire and the entire Meta Mavericks team for not only creating a fantastic e-commerce site but also for their strategic guidance that is integral to our growth and success.
                  </p>
                  <div class="testimonial-footer d-flex align-items-center gap-3">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed=Danielle%20Grimes" alt="avatar" width="70" height="70" class="img-fluid rounded-circle" />
                    <div>
                      <h5 class="mb-0 pb-0 text-inherit">Danielle Grimes</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <p class="mb-4 text-inherit">
                    The Meta Mavericks team I interacted with was consistently approachable, polite, and ready to assist. Any questions or issues I had were addressed promptly. I would not hesitate to suggest Meta Mavericks to anyone planning to build a website. The feedback from those who have visited our website has been extremely positive.
                  </p>
                  <div class="testimonial-footer d-flex align-items-center gap-3">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed=Anne%20McMahon " alt="avatar" width="70" height="70" class="img-fluid rounded-circle" />
                    <div>
                      <h5 class="mb-0 pb-0 text-inherit">Anne McMahon</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <p class="mb-4 text-inherit">
                    I wholeheartedly endorse Meta Mavericks. Collaborating with their team of highly competent professionals has been a joy. We recently revamped our website, which included client account forms and payments. I provided Killian with detailed changes, and he took care of the rest. Their technical expertise is commendable. They fulfilled all tasks within the agreed deadlines and were highly responsive throughout the process. I look forward to working with Meta Mavericks again.
                  </p>
                  <div class="testimonial-footer d-flex align-items-center gap-3">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed=Karl%20Scully" alt="avatar" width="70" height="70" class="img-fluid rounded-circle" />
                    <div>
                      <h5 class="mb-0 pb-0 text-inherit">Karl Scully</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <p class="mb-4 text-inherit">
                    Working with Meta Mavericks was a great experience, their team was a pleasure to work with and always delivered as per the agreed timelines. I'm extremely satisfied with their work and the creative ideas they contributed to the website development. Their post-launch support is also commendable for its fast response times. I would undoubtedly recommend them.
                  </p>
                  <div class="testimonial-footer d-flex align-items-center gap-3">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed=Maven%20Brown" alt="avatar" width="70" height="70" class="img-fluid rounded-circle" />
                    <div>
                      <h5 class="mb-0 pb-0 text-inherit">Maven Brown</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="testimonial-wrap">
                  <p class="mb-4 text-inherit">
                    We've been partnering with Meta Mavericks for quite some time now, and I frequently interact with their entire team. For a small business like ours, having a consistent relationship with our IT partners is crucial. I appreciate being able to freely communicate with anyone on their team, knowing they are familiar with our account and projects. Meta Mavericks has been exceptional in guiding us towards online business growth, and I eagerly anticipate continuing this growth journey with them.
                  </p>
                  <div class="testimonial-footer d-flex align-items-center gap-3">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed=Richard%20White" alt="avatar" width="70" height="70" class="img-fluid rounded-circle" />
                    <div>
                      <h5 class="mb-0 pb-0 text-inherit">Richard White</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="cta-section-lp">
        <div class="container">
          <div class="row text-center text-md-start">
            <div class="col-md-6">
              <h2>Need assistance?<br />We're here for you!</h2>
              <p class="text-dark mb-4 mb-lg-5">
                Should you require further information or need assistance with
                the services we offer, feel free to get in touch with us by
                filling out the form attached below!
              </p>
              <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 mb-4">
                <div class="col-auto">
                  <a href="tel:12812153298" class="border border-2 rounded-4 border-dark py-2 px-4 d-inline-block w-100">
                    <small>Just a call away</small><br />
                    <strong>Call Now</strong>
                  </a>
                </div>
                <div class="col-auto">
                  <a href="mailto:info@themetamavericks.com" class="border border-2 rounded-4 border-dark py-2 px-4 d-inline-block w-100">
                    <small>Merely a click away</small><br />
                    <strong>Email Now</strong>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!--Site Footer Start-->
    <footer class="site-footer">
      <div class="site-footer__shape-1 zoominout">
        <img src="assets/images/shapes/site-footer-shape-1.png" alt="" />
      </div>
      <div class="site-footer__shape-2 zoominout">
        <img src="assets/images/shapes/site-footer-shape-2.png" alt="" />
      </div>
      <div class="site-footer__top">
        <div class="site-footer__shape-3 float-bob-x">
          <img src="assets/images/shapes/site-footer-shape-3.png" alt="" />
        </div>
        <div class="site-footer__shape-4 float-bob-y">
          <img src="assets/images/shapes/site-footer-shape-4.png" alt="" />
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
              <div class="footer-widget__column footer-widget__about">
                <div class="footer-widget__logo-box">
                  <div class="footer-widget__logo">
                    <a href="#"><img src="assets/images/whiteTheMeta.png" alt="" /></a>
                    <!-- <h6 style="color: #fff; font-size: 28px; font-weight: 600;">The Meta Mavericks</h6> -->
                  </div>
                </div>
                <p class="footer-widget__text">
                  Do you know how to kick start your business for the modern
                  world? Get in touch with The Meta Mavericks for the
                  unconventional transformation that your business and
                  customers demand. Together we can set the bar high!
                </p>
                <ul class="footer-widget__social-box list-unstyled">
                  <li>
                    <a href="javascript:;"><i class="fab fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="javascript:;"><i class="fab fa-instagram"></i></a>
                  </li>
                  <li>
                    <a href="javascript:;"><i class="fab fa-twitter"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
              <div class="footer-widget__quick-links">
                <h4 class="footer-widget__title">Quick Links</h4>
                <ul class="footer-widget__quick-links-list list-unstyled">
                  <li><a href="contact">Contact</a></li>
                  <li><a href="about">About us</a></li>
                  <li><a href="digital-commerce">Digital Commerce</a></li>
                  <li>
                    <a href="e-commerce-development">Ecommerce Development</a>
                  </li>
                  <li><a href="app-development">APP Development</a></li>
                  <li>
                    <a href="game-app-development">Game App Development</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
              <div class="footer-widget__get-in-touch">
                <h4 class="footer-widget__title">Get In Touch</h4>
                <p class="footer-widget__get-in-touch-text">
                  5380 OLD BULLARD RD STE 223, TYLER, TX 75703, United States
                </p>
                <div class="footer-widget__email-box">
                  <a href="mailto:info@themetamavericks.com">info@themetamavericks.com</a>
                  <!--<a href="mailto:help@themetamavericks.com">help@themetamavericks.com</a>-->
                </div>
                <div class="footer-widget__contact">
                  <div class="icon">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="text">
                    <a href="tel:(281) 215-3298">(281) 215-3298</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
              <div class="footer-widget__newsletter">
                <h4 class="footer-widget__title">Newsletter</h4>
                <p class="footer-widget__newsletter-text">
                  Subscribe our Newletter & get updates in inbox.
                </p>
                <form class="footer-widget__subscribe-box" action="https://themetamavericks.com/webpages/bannerFormController.php" method="post">
                  <div class="footer-widget__subscribe-input-box">
                    <input type="email" placeholder="Email address" name="Email" />
                    <input class="btmmain" type="Submit" value="Submit" />
                    <input class="" type="hidden" name="ctry" value="" />
                    <!--<input type="hidden" name="pc" value="">-->
                    <input type="hidden" name="cip" value="" />
                    <input type="hidden" name="hiddencapcha" value="" />
                    <input type="hidden" id="location" name="locationURL" value="http://themetamavericks.com/" />
                    <input type="hidden" id="formtype" name="formtype" value="1" />
                  </div>
                </form>
                <div class="footer-widget__bottom-text">
                  <p>Get every week update from airvice</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="site-footer__bottom">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="site-footer__bottom-inner">
                <div class="site-footer__bottom-text">
                  <p>Copyright © 2023 All Rights Reserved</p>
                </div>
                <ul class="site-footer__bottom-menu list-unstyled">
                  <!-- <li>
                                        <a href="javascript:;">Privacy & Terms</a>
                                    </li> -->
                  <li>
                    <a href="contact">Contact Us</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="get-a-quote-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content p-4 p-lg-5">
          <button type="button" class="btn btn-modal-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="img-wrap mb-4 mb-md-0">
                <img src="assets/images/design-and-development/89562390856237845.jpg" class="img-fluid">
              </div>
            </div>
            <div class="col-md-6">
              <form action="{{ route('contact-form') }}" method="POST" id="contact-form-modal">
                @csrf
                <h3 class="text-center mb-4">Get Expert Consultation</h3>
                <div class="form-group mb-3">
                  <i class="far fa-user"></i>
                  <input type="text" class="form-control" placeholder="Your Name" name="name">
                </div>
                <div class="form-group mb-3">
                  <i class="far fa-envelope"></i>
                  <input type="email" class="form-control" placeholder="Your Email Address" name="email">
                </div>
                <div class="form-group mb-3">
                  <i class="fas fa-phone-alt"></i>
                  <input type="tel" class="form-control" placeholder="Your Phone Number (Optional)" name="phone">
                </div>
                <div class="form-group mb-3">
                  <i class="fas fa-pencil-alt"></i>
                  <textarea class="form-control" placeholder="Your Message" rows="5" name="message"></textarea>
                </div>
                <div class="form-group mb-3">
                  <button type="submit" class="btn btn-primary w-100 " id="contact-form-btn-modal">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <div class="elfsight-app-fcd96053-c8eb-4bed-b21b-3de80407f986" data-elfsight-app-lazy></div>

    <!--Site Footer End-->
  </div>
  <!-- /.page-wrapper -->

  <x-footer-scripts />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  {{-- sweet alert cdn --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>

  <script>
    var swiper = new Swiper(".swiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
          autoHeight: true,
        },
        1024: {
          slidesPerView: "auto",
          spaceBetween: 20,
        },
      },
    });

    $(".client-testimonials-nav .btn-prev").on("click", function() {
      swiper.slidePrev();
    });
    $(".client-testimonials-nav .btn-next").on("click", function() {
      swiper.slideNext();
    });
  </script>

  <script type="text/javascript">
    $("[data-targetit]").on("click", function() {
      $(this).siblings().removeClass("current");
      $(this).addClass("current");
      var target = $(this).data("targetit");
      $("." + target)
        .siblings('[class^="tabs"]')
        .removeClass("current");
      $("." + target).addClass("current");
      $(".slick-slider").slick("setPosition", 0);
    });
  </script>

  <script>
    // jQuery(".comprehensive-packages-nav .btn").click(function (e) {
    //   e.preventDefault();
    //   jQuery(".comprehensive-packages-nav .btn").removeClass("active");
    //   jQuery(".comprehensive-packages-nav .btn").addClass("bg-white");
    //   jQuery(this).addClass("active");
    //   jQuery(this).removeClass("bg-white");
    // });
  </script>

  <script>
    $("[data-section-toggle-scope]")
      .find("[data-section-toggle]")
      .on("click", function(e) {
        e.preventDefault();

        if ($(this).hasClass("active")) {
          return;
        }

        var target = $(this).data("section-toggle");
        var scope = $(this).closest("[data-section-toggle-scope]");
        scope.find("[data-section]").hide();
        scope.find("[data-section=" + target + "]").fadeIn();
        scope.find("[data-section-toggle]").removeClass("active");
        scope.find("[data-section-toggle]").addClass("bg-white");

        $(this).addClass("active");
        $(this).removeClass("bg-white");
      });

    $("[data-section-toggle-scope]").each(function() {
      var scope = $(this);
      scope.find("[data-section]:not(.active)").hide();
      // scope.find("[data-section]:first").show();
    });
  </script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = "https://embed.tawk.to/6567442426949f791135f5a0/1hgdm4c99";
      s1.charset = "UTF-8";
      s1.setAttribute("crossorigin", "*");
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
</body>
</html>
