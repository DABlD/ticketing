<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@TTEND</title>
    <meta charset="utf-8">

    <meta name="robots" content="index, follow" > 
    <meta name="keywords" content="HTML5 Template" > 
    <meta name="description" content="Elementy - Responsive HTML5 Template" > 
    <meta name="author" content="ABCgomel">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#2a2b2f">
    
    <!-- FAVICONS -->
    <link rel="shortcut icon" href="welcome/images/favicon.png">
    <link rel="apple-touch-icon" href="welcome/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="welcome/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="welcome/images/apple-touch-icon-114x114.png">
    <link rel="icon" sizes="192x192" href="welcome/images/icon-192x192.png">
    
    <!-- styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,300%7COpen+Sans:400,300,700" rel="stylesheet" type="text/css">
    <link href="welcome/css/settings.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="welcome/css/hermes-custom.min.css">
    <link rel="stylesheet" href="welcome/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="welcome/css/icon-fonts.min.css" > 
    <link rel="stylesheet" href="welcome/css/styles.min.css" >
    <link rel="stylesheet" href="welcome/css/animate.min.css">
    
  </head>
  <body>
  
    <div id="loader-overflow">
      <div id="loader3" class="loader-cont">Please enable JS</div>
    </div>  

    <div id="wrap" class="boxed ">
      <div class="grey-bg">
        
        <!-- HEADER 1 FONT WHITE TRANSPARENT -->
        <div class="header-black-bg"></div> <!-- NEED FOR TRANSPARENT HEADER ON MOBILE -->
        <header id="nav" class="header header-1 header-black">
          <div class="header-wrapper">
          <div class="container-m-30 clearfix">
            <div class="logo-row">
            
            <!-- LOGO --> 
            <div class="logo-container-2">
                <div class="logo-2">
                  <a href="index.html" class="clearfix">
                    <img src="{{ asset('images/logo.png') }}" class="logo-img" alt="Logo">
                  </a>
                </div>
              </div>
            <!-- BUTTON --> 
            <div class="menu-btn-respons-container">
              <button id="menu-btn" type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
                <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
              </button>
            </div>
           </div>
          </div>

          <!-- MAIN MENU CONTAINER -->
          <div class="main-menu-container">
            
              <div class="container-m-30 clearfix"> 
              
              <!-- MAIN MENU -->
              <div id="main-menu">
                <div class="navbar navbar-default" role="navigation">

                  <!-- MAIN MENU LIST -->
                  <nav class="collapse collapsing navbar-collapse right-1024">
                    <ul id="nav-onepage" class="nav navbar-nav">
                      
                      <!-- MENU ITEM -->
                      <li class="current">
                        <a href="#index-link"><div class="main-menu-title">Home</div></a>
                      </li>
                      
                      <!-- MENU ITEM -->
                      <li>
                        <a href="#about-us-link"><div class="main-menu-title">About Us</div></a>
                      </li>
                      
                      <!-- MENU ITEM -->
                      <li>
                        <a href="#services-link"><div class="main-menu-title">Services</div></a>
                      </li>
                      
                      <!-- MENU ITEM -->
                      <li>
                        <a href="#portfolio-link"><div class="main-menu-title">Portfolio</div></a>
                      </li>
                      
                      <!-- MENU ITEM -->
                      <li>
                        <a href="#contact-link"><div class="main-menu-title">Contact</div></a>
                      </li>

                    </ul>
              
                  </nav>
 
                </div>
              </div>
              <!-- END main-menu -->
            
              </div>
              <!-- END container-m-30 -->
            
          </div>
          <!-- END main-menu-container -->
          
          </div>
          <!-- END header-wrapper -->
          
        </header>
       
        <!-- SLIDER Revo 2 -->
        <div id="index-link" class="relative" style="overflow:hidden;">

            <div class="rev_slider_wrapper fullscreen-container" id="rev_slider_280_1_wrapper" style="background-color:#fff;padding:0px;">
            
                <!-- START REVOLUTION SLIDER fullscreen mode -->
                <div id="rev_slider_202_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.1.1RC">
                    <ul>
                        <!-- SLIDE  -->
                        @foreach($data as $event)
                          @php
                            $images = json_decode($event->images);
                          @endphp
                          <li data-index="rs-{{ $event->id }}" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-saveperformance="off">
                              <!-- MAIN IMAGE -->
                              <img src="{{ isset($images[0]) ? "uploads/$event->id/$images[0]" : "images/no-image.png" }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                              <!-- LAYERS -->

                              <!-- LAYER NR. 1 -->
                              <div class="tp-caption font-poppins font-white tp-resizeme rs-parallaxlevel-6" id="slide-898-layer-1" style="z-index: 8; white-space: nowrap;"
                              data-fontsize="['90','70','62','52']" 
                              data-fontweight="600" 
                              data-height="none" 
                              data-lineheight="['102','82','74','64']"
                              data-splitin="none" 
                              data-splitout="none"
                              
                              data-frames='[{
                                    "from":"y:[100%];z:0;",
                                    "speed":600,
                                    "to":"o:1;",
                                    "delay":900,
                                    "ease":"easeOutBack"
                                  }]'
                              
                              data-whitespace="nowrap" 
                              data-width="none" 
                              data-x="['left','left','left','left']" 
                              data-y="['center','center','center','center']" 
                              >
                                <p style="text-shadow: 3px 3px black;">{{ $event->name }}</p>
                              </div> 

                              {{-- <!-- LAYER NR. 2 -->
                              <div class="tp-caption font-poppins font-white tp-resizeme rs-parallaxlevel-6" id="slide-898-layer-2" style="z-index: 8; white-space: nowrap;"
                              data-fontsize="['24','24','24','20']" 
                              data-fontweight="300" 
                              data-height="none" 
                              data-lineheight="['40','40','40','40']" 
                              data-responsive_offset="on" 
                              data-splitin="none" 
                              data-splitout="none"
                              
                              data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1450,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"nothing"}]'
                              
                              data-whitespace="nowrap" 
                              data-width="none" 
                              data-x="['left','left','left','left']" 
                              data-hoffset="['40','40','40','20']" 
                              data-y="['center','center','center','center']" 
                              data-voffset="['90','80','70',50']">
                                on startups, creatives and small businesses
                              </div>            --}}                 
                          </li>
                        @endforeach
                        
                        {{-- <li data-index="rs-673" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="welcome/images/traincover-180x110.jpg" data-rotate="0" data-saveperformance="off" data-title="CREATIVE STUDIO" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="welcome/images/traincover.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- BACKGROUND VIDEO LAYER -->
                            <div class="rs-background-video-layer" data-forcerewind="on" data-volume="mute" data-videowidth="100%" data-videoheight="100%" data-videomp4="welcome/video/Broadway.mp4" data-videopreload="preload" data-videoloop="loop" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true"></div>

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme rs-parallaxlevel-9" id="slide-696-layer-1" 
                            data-x="['center','center','center','center']" 
                            data-hoffset="['0','0','0','0']" 
                            data-y="['middle','middle','middle','middle']" 
                            data-voffset="['0','0','0','0']" 
                            data-width="none" 
                            data-height="none" 
                            data-whitespace="nowrap" 
                            
                            data-type="image" 
                            data-responsive_offset="on" 

                            data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1850,"ease":"Power4.easeOut"},{"delay":"wait","speed":500,"to":"rZ:0deg;sX:0.7;sY:0.7;opacity:0;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Back.easeIn"}]'
                            data-textAlign="['left','left','left','left']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"

                            style="z-index: 7;">
                                <div class="rs-looped rs-pulse" data-easing="Power1.easeInOut" data-speed="3" data-zoomstart="0.98" data-zoomend="1"><img src="welcome/images/dummy.png" alt="creative studio" width="1400" height="1200" data-ww="['700px','700px','700px','350']" data-hh="['600px','600px','600px','300']" data-lazyload="welcome/images/creativestudio.png" data-no-retina>
                                </div>
                            </div>
                        </li> --}}
                    
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                </div>
            </div>
            <!-- END REVOLUTION SLIDER -->

          <!-- SCROLL ICON -->
          <div class="local-scroll-cont font-white">
            <a href="#about" class="scroll-down smooth-scroll">
              <div class="icon icon-arrows-down"></div>
            </a>  
          </div>
          
        </div>
  
        <!-- FEATURES 16 TABS 2 -->
        <div class="page-section">
          <div class="bg-yellow mb-100">
            <div class="container">
              
              <!-- TABS NAV -->
              <div class="row">
                <div class="col-md-12">
                  
                  <br>

                  <h1><b>
                    ABOUT US
                  </b></h1>

                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vehicula nulla sem, at tempus dui convallis vitae, Phasellus sollicitudin turpis mauris, posuere ultrices purus tristique sed.
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  
                  <h2>
                    Hassle free, Real time Registration Platform
                  </h2>

                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vehicula nulla sem, at tempus dui convallis vitae, Phasellus sollicitudin turpis mauris, posuere ultrices purus tristique sed.


                  <h2>
                    Pre register ahead and create your digital Pass
                  </h2>

                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vehicula nulla sem, at tempus dui convallis vitae, Phasellus sollicitudin turpis mauris, posuere ultrices purus tristique sed.
                </div>


                <!-- IMAGES -->
                <div class="col-md-6 fes9-img-cont clearfix">
                  <div class="fes16-img-center clearfix" style="width: 500px !important;">
                    <img src="{{ asset('images/about-us2.png') }}" alt="img" class="wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1s">
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>

        <!-- FEATURES 17 OUR SERVICES 2 -->
        <div id="services-link" class="page-section pt-160-b-120-cont">
          <div class="container">

            <div class="row">
              <div class="col-md-12">
                
                <br>

                <h1><b>
                  OUR SERVICES
                </b></h1>

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vehicula nulla sem, at tempus dui convallis vitae, Phasellus sollicitudin turpis mauris, posuere ultrices purus tristique sed.
              </div>
            </div>



            <div class="row">

              <!-- IMAGES -->
              <div class="col-md-6 fes9-img-cont clearfix">
                <div class="fes16-img-center clearfix">
                  <img src="{{ asset('images/login.png') }}" alt="img" class="wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1s">
                </div>
              </div>

              <div class="col-md-6">
                
                <h2>
                  Event registration made easy, Digitally designed to systematically facilitate and digitally organize your events.
                </h2>

                <div class="row">

                  <!-- IMAGES -->
                  <div class="col-md-6 fes9-img-cont clearfix">
                    <div class="fes16-img-center clearfix" style="width: 180px; height: 200px !important;">
                      <img src="{{ asset('images/image1.png') }}" alt="img" class="wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1s">
                    </div>
                  </div>

                  <!-- IMAGES -->
                  <div class="col-md-6 fes9-img-cont clearfix">
                    <div class="fes16-img-center clearfix" style="width: 180px; height: 200px !important;">
                      <img src="{{ asset('images/image2.png') }}" alt="img" class="wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1s">
                    </div>
                  </div>
                </div>

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vehicula nulla sem, at tempus dui convallis vitae, Phasellus sollicitudin turpis mauris, posuere ultrices purus tristique sed.
              </div>
            </div>

          </div>
        </div>
        
        <!-- PORTFOLIO SECTION (3 COLS, WIDE) -->
        <div id="portfolio-link" class="page-section">
          <div class="relative">
          
            <div class="container">
              <div class="pt-80-b-30-cont">
              
                <!-- TITLE -->
                <div class="mb-10">
                  <h2 class="section-title2 font-light">Recent Works</h2>
                </div>
   
                <!-- PORTFOLIO FILTER -->                    
                <div class="pl-xxs-10">
                
                  <ul class="port-filter font-poppins">
                    <li>
                      <a href="#" class="filter active" data-filter="*">All Projects</a>
                    </li>
                    <li>
                      <a href="#" class="filter" data-filter=".development">Development</a>
                    </li>
                    <li>
                      <a href="#" class="filter" data-filter=".design">Design</a>
                    </li>
                    <li>
                      <a href="#" class="filter" data-filter=".photography">Photography</a>
                    </li>
                  </ul>
                  
                </div>
                
              </div>
            </div>
            
            <!-- ITEMS GRID -->
            <ul class="port-grid port-grid-3 clearfix" id="items-grid">
              
              <!-- Item -->
              <li class="port-item mix design">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-1-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Minimalism</h3>
                      <span>design</span>
                    </div>
                  </div>
                </a>
              </li>
                                           
              <!-- Item -->
              <li class="port-item mix photography">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-2-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Iceland Beach</h3>
                      <span>photography</span>
                    </div>
                  </div>
                </a>
              </li>
                       
              <!-- Item -->
              <li class="port-item mix photography">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-3-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Metal Bridge</h3>
                      <span>photography</span>
                    </div>
                  </div>
                </a>
              </li>
                             
              <!-- Item -->
              <li class="port-item mix photography">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-6-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Black White Surfer</h3>
                      <span>photography</span>
                    </div>
                  </div>
                </a>
              </li>
              
              <!-- Item -->
              <li class="port-item mix development">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-4-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Minimalist Watches</h3>
                      <span>development</span>
                    </div>
                  </div>
                </a>
              </li>
 
              <!-- Item -->
              <li class="port-item mix photography">
                <a href="portfolio-single1.html">
                  <div class="port-img-overlay">
                    <img class="port-main-img" src="welcome/images/projects-5-3col.jpg" alt="img" >
                  </div>
                  <div class="port-overlay-cont">
                    <div class="port-title-cont2">
                      <h3>Swimming Pool</h3>
                      <span>photography</span>
                    </div>
                  </div>
                </a>
              </li>

            </ul>
          
          </div>
        </div>
        
        <!-- VIEW MORE PROJECTS  -->
        <div class="port-view-more-cont">
          <a class="port-view-more" href="portfolio-masonry-4col.html">View All Projects</a>
        </div>
        <!-- END PORTFOLIO SECTION -->
        
        <!-- COUNTERS 2 -->
        <div id="counter-1" class="page-section p-80-cont bg-gray">
          <div class="container">
        
            <div  class="row text-center">
                            
              <!-- Item -->
              <div class="col-xs-6 col-sm-3 border-none">
                <div class="count-number">
                  75
                </div>
                <div class="count-descr">
                  <span class="count-title">Awards Winning</span>
                </div>
              </div>
              
              <!-- Item -->
              <div class="col-xs-6 col-sm-3 border-none">
                <div class="count-number">
                 450
                </div>
                <div class="count-descr">
                  <span class="count-title">Happy Clients</span>
                </div>
              </div>
              
              <!-- Item -->
              <div class="col-xs-6 col-sm-3 border-none">
                <div class="count-number">
                  151
                </div>
                <div class="count-descr">
                  <span class="count-title">Projects Done</span>
                </div>
              </div>
              
              <!-- Item -->
              <div class="col-xs-6 col-sm-3 border-none">
                <div class="count-number">
                 768
                </div>
                <div class="count-descr">
                  <span class="count-title">Hours Of Code</span>
                </div>
              </div>  
              
            </div>
          </div>
        </div>
  
        <!-- CONTACT INFO SECTION 1  -->
        <div id="contact-link" class="page-section p-100-cont">
          <div class="container">
            <div class="row">
            
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-map"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Address</h3>
                    <p>790 Folsom Ave, San Francisco</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-mail"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Email</h3>
                    <p><a href="mailto:info@elementy.com">info@elementy.com</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="cis-cont">
                  <div class="cis-icon">
                    <div class="icon icon-basic-smartphone"></div>
                  </div>
                  <div class="cis-text">
                    <h3>Call Us</h3>
                    <p>1-800-312-212, 1-800-311-101</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>        
        </div> 

          <!-- GOOGLE MAP & CONTACT FORM -->
          <div class="page-section bg-gray">
            <div class="container-fluid">
              <div class="row">
              
                <div class="col-md-6">
                  <div class="row row-sm-fix">
                    <!-- <div data-address="580 California Street, San Francisco, CA" id="google-map"></div> -->
                
                    <!-- *This is an example of using latitude and longitude if you need to use them instead of an address. Read more in the documentation.* -->
                    <div data-latitude="37.792888" data-longitude="-122.404041" id="google-map"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="contact-form-cont">
                    <!-- TITLE -->
                    <div class="mb-40">
                      <h3 >Leave a Message</h3>
                    </div>
                                  
                    <!-- CONTACT FORM -->
                    <div class="relative" >
                      <form id="contact-form" action="php/contact-form.php" method="POST">
                      
                        <div class="row">
                          <div class="col-md-12 mb-30">
                            <!-- <label>Your name *</label> -->
                            <input type="text" value="" data-msg-required="Please enter your name" maxlength="100" class="form-control" name="name" id="name" placeholder="Name" required>
                          </div>
                        </div>
                        
                        <div class="row">    
                          <div class="col-md-12 mb-30">
                            <!-- <label>Your email address *</label> -->
                            <input type="email" value="" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" maxlength="100" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>
                        </div>
                    
                        <div class="row">
                          <div class="col-md-12 mb-40">
                            <!-- <label>Message *</label> -->
                            <textarea maxlength="5000" data-msg-required="Please enter your message" rows="3" class="form-control" name="message" id="message" placeholder="Message" required></textarea>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12 text-xxs-center">
                            <input type="submit" value="SEND MESSAGE" class="button medium rounded gray font-open-sans" data-loading-text="Loading...">
                          </div>
                        </div>
                        
                      </form> 
                      <div class="alert alert-success hidden animated pulse" id="contactSuccess">
                        Thanks, your message has been sent to us.
                      </div>
                    
                      <div class="alert alert-danger hidden animated shake" id="contactError">
                        <strong>Error!</strong> There was an error sending your message.
                      </div>
                    </div>
                  
                  </div>
                </div>
                  
              </div>
            </div>
          </div>
                
        <!-- FOOTER 1 only social links -->
        <footer id="footer1" class="page-section text-center p-100-cont">
          <div class="container">
                    
            <!-- Social Links -->
            <div class="footer-soc-a">
              <a href="https://1.envato.market/a1gQR" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
              <a href="https://1.envato.market/a1gQR" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
              <a href="https://www.behance.net/abcgomel" title="Behance" target="_blank"><i class="fa fa-behance"></i></a>
              <a href="https://1.envato.market/a1gQR" title="LinkedIn+" target="_blank"><i class="fa fa-linkedin"></i></a>
              <a href="https://dribbble.com/abcgomel" title="Dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>
            </div>
                    
          </div>
        </footer>
        
        <!-- BACK TO TOP -->
        <p id="back-top">
          <a href="#top" title="Back to Top"><span class="icon icon-arrows-up"></span></a>
        </p>
        
      </div><!-- End BG --> 
    </div><!-- End wrap --> 
      
<!-- JS begin -->

    <!-- jQuery  -->
    <script src="welcome/js/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="welcome/js/bootstrap.min.js"></script>   

    <!-- MAGNIFIC POPUP -->
    <script src="welcome/js/magnific-popup.min.js"></script>
    
    <!-- PORTFOLIO SCRIPTS -->
    <script src="welcome/js/isotope.min.js"></script>
    <script src="welcome/js/imagesloaded.min.js"></script>
    <script src="welcome/js/masonry.min.js"></script>
    
    <!-- COUNTER -->
    <script src="welcome/js/counto.min.js"></script>
    
    <!-- APPEAR -->    
    <script src="welcome/js/appear.min.js"></script>
    
    <!-- OWL CAROUSEL -->    
    <script src="welcome/js/owl.carousel.min.js"></script>
    
    <!-- ONE PAGE NAV -->
    <script src="welcome/js/jquery-nav.min.js"></script>
    <script>
      $(document).ready(function() {
        //ONE PAGE NAV  ---------------------------------------------------------------------------
          var top_offset = $('header').height() - 1;  // get height of fixed navbar

          $('#nav-onepage').onePageNav({
            currentClass: 'current',
            changeHash: false,
            scrollSpeed: 700,
            scrollOffset: top_offset,
            scrollThreshold: 0.5,
            filter: '',
            easing: 'swing',
            begin: function() {
              //I get fired when the animation is starting
            },
            end: function() {
              //I get fired when the animation is ending
            },
            scrollChange: function($currentListItem) {
              //I get fired when you enter a section and I pass the list item of the section
            }
          });
          
      });//END document.ready 
    </script>
    
    <!-- GOOLE MAP 
    !!! To setup Google Maps, please, see the documentation !!! --> 
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDzf6Gmc9u7rr2JHijOERAmC_j0gWYtR2c"></script>
    <script src="welcome/js/gmap3.min.js"></script>
    
    <!--[if lt IE 10]><script src="js/jquery.placeholder.js"></script><![endif]--> 
    
    <!-- FORMS VALIDATION -->
    <script src="welcome/js/validate.min.js"></script>
    <script src="welcome/js/form-validation.min.js"></script>
    
    <!-- MAIN SCRIPT -->
    <script src="welcome/js/main.js"></script>
    
    <!-- REVOSLIDER SCRIPTS  -->
    <script src="welcome/js/themepunch-tools.min.js" >
    </script>
    <script src="welcome/js/themepunch-revolution.min.js" >
    </script>
      
    <!-- SLIDER REVOLUTION INITIALIZATION  -->
    <script>
      jQuery(document).ready(function() {
          
        jQuery("#rev_slider_202_1").show().revolution({
          sliderType: "standard",
          jsFileLocation: "welcome/js/",
          sliderLayout: "fullscreen",
          dottedOverlay: "none",
          delay: 3800,
          navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "off",
            touch: {
                touchenabled: "on",
                swipe_threshold: 75,
                swipe_min_touches: 50,
                swipe_direction: "horizontal",
                drag_block_vertical: false
            },
            arrows: {
              style: "hermes",
              enable: true,
              hide_onmobile: true,
              hide_onleave: true,
              tmp: '<div class="tp-arr-allwrapper"> <div class="tp-arr-imgholder"></div>  <div class="tp-arr-titleholder"></div> </div>',
              left: {
                h_align: "left",
                v_align: "center",
                h_offset: 0,
                v_offset: 0
              },
              right: {
                h_align: "right",
                v_align: "center",
                h_offset: 0,
                v_offset: 0
              }
            },
          },
          responsiveLevels: [1240, 1024, 778, 480],
          visibilityLevels: [1240, 1024, 778, 480],
          gridwidth: [1240, 1024, 778, 480],
          gridheight: [868, 768, 960, 720],
          lazyType: "none",
           parallax: {
            type: "off",
            origo: "slidercenter",
            speed: 1000,
            levels: [0],
            type: "scroll",
            disable_onmobile: "on"
          },
          shadow: 0,
          spinner: "spinner2",
          /*stopLoop: "on",
          stopAfterLoops: 0,
          stopAtSlide: 1,*/
          shuffle: "off",
          autoHeight: "off",
          fullScreenAutoWidth: "off",
          fullScreenAlignForce: "off",
          fullScreenOffsetContainer: "",
          fullScreenOffset: "",
          disableProgressBar: "on",
          hideThumbsOnMobile: "off",
          hideSliderAtLimit: 0,
          hideCaptionAtLimit: 0,
          hideAllCaptionAtLilmit: 0,
          debugMode: false,
          fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
          }
        });
       
      }); /*ready*/
    </script>
<!-- JS end --> 
  
  </body>
</html>   