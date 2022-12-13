<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Nikan</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('img/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="{{ asset('img/loading.gif') }}" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="#"><img src="{{ asset('img/logo.png') }}"
                                            style="width:100%;z-index:-9999" alt="#" /></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    {{-- <li class="nav-item active">
                                 <a class="nav-link" href="index.html">Home</a>
                              </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#room">Our room</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#liqour">Liqour</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contact">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#faqs">FAQs</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <!-- banner -->
    <section class="banner_main">
        <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="{{ asset('/storage/' . $carousel_first->image) }}" alt="First slide">
                    <div class="container">
                    </div>
                </div>
                @foreach ($carousel as $data)
                    <div class="carousel-item">
                        <img class="third-slide" src="{{ asset('/storage/' . $data->image) }}" alt="Third slide">
                    </div>
                @endforeach

            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="booking_ocline">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        @if (session('date_error'))
                            <div class="alert alert-danger border-left-danger alert-dismissible fade show"
                                role="alert">
                                {{ session('date_error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="book_room">
                            <h1>Book Now</h1>
                            <form class="book_now" method="get" action="{{ route('book_now') }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>Arrival</span>
                                        <img class="date_cua" src="{{ asset('img/date.png') }}">
                                        <input type="text" name="dates" class="online_book" />
                                    </div>
                                    <div class="col-md-12">
                                        <button class="book_btn">Book Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->
    <!-- about -->
    <div class="about" id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="titlepage">
                        <h2>About Us</h2>
                        <p>{{ $about->about }}</p>
                        {{-- <a class="read_more" href="Javascript:void(0)"> Read More</a> --}}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_img">
                        <figure><img src="{{ asset('/storage/' . $about->image) }}" alt="#" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    <!-- our_room -->
    <div class="our_room" id="room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Room</h2>
                        <p>Lorem Ipsum available, but the majority have suffered </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($room as $data)
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset('/storage/' . $data->image) }}" alt="#"
                                        style="width:100%;height:250px;" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $data->title }}</h3>
                                <p>{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- <div class="our_room" id="meals">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Meals</h2>
                        <p>Heaven Defying Meals</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($meals as $data)
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset('/storage/' . $data->image) }}" alt="#"
                                        style="width:100%;height:250px;" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $data->title }}</h3>
                                <p>{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}

    <div class="our_room" id="liqour">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Liqour</h2>
                        <p>Heaven Defying Liqour</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($liqour as $data)
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset('/storage/' . $data->image) }}" alt="#"
                                        style="width:100%;height:250px;" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $data->title }}</h3>
                                <p>{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end our_room -->
    <!-- gallery -->
    <div class="gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>gallery</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($gallery as $data)
                    <div class="col-md-3 col-sm-6">
                        <div class="gallery_img">
                            <figure><img src="{{ asset('/storage/' . $data->image) }}" alt="#"
                                    style="width:100%;height:250px;" /></figure>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success border-left-success alert-dismissible fade show"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form id="request" class="main_form" action="{{ route('contact_us_process') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="text" required name="name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="email" required name="email">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="number" required
                                    name="number">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="text" required name="message">Message</textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.324663935904!2d124.50814381478318!3d8.564747093843758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff7bad14f4b7f%3A0x70f3fc828a71eaf!2sNikan%20Resort!5e0!3m2!1sen!2sph!4v1670418966530!5m2!1sen!2sph"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact" id="faqs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>FAQs</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>What Makes Nikan Resort Unique?</p>

                    <ul>
                        <li style="margin-left:20px;">● Nikan Resort is an exclusive resort. There is no limit to the
                            number of people who can
                            stay, and we have plenty of space for any gatherings. Most resorts that are located in El
                            Salvador are small, but we made ours big for its uniqueness among others.</li>
                    </ul>
                    <br />
                    <p>Do you have overnight stay?</p>

                    <ul>
                        <li style="margin-left:20px;">● NO</li>
                    </ul>
                    <br />
                    <p>How much is the rent of your Kubo?</p>

                    <ul>
                        <li style="margin-left:20px;">● We have a so called Bahay Kubo, there’s two types of it. First,
                            we have it with electric
                            fan (500.00 pesos) and the other one with aircon (1000.00 pesos). If you rented it, you can
                            use it until check out.</li>
                    </ul>
                    <br />
                    <p>What services do you offer for your guests?</p>

                    <ul>
                        <li style="margin-left:20px;">
                            ● As of now we dont any services yet but we sell liquor at our resort to the guests.
                        </li>
                    </ul>
                    <br />
                    <p>What is the time limit or the check in and out of the guest in your resort?</p>

                    <ul>
                        <li style="margin-left:20px;">● If they have reservation, they can use the whole resort from
                            9am (check in time) to 6pm
                            (check out time) but if they want to extend time, we can extend it up until 8pm but
                            additional 500.00 pesos per hour.</li>
                    </ul>
                    <br />
                    <p>Rate of you resort.</p>
                    <ul>
                        <li style="margin-left:20px;">● 6,000 pesos exclusive for the day and they can use the function
                            hall, swimming pools,
                            cottages. They can also invite other services they have from the outside such as catering,
                            live band, etc., no charges already for them.</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <br />
    <!-- end contact -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-4">
                        <h3>Contact US</h3>
                        <ul class="conta">
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> Upper Binale, Doyugan El Salvador
                                City, El Salvador, Philippines</li>
                            <li><i class="fa fa-mobile" aria-hidden="true"></i> 0955 097 8103</li>
                            <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#">
                                    nikanmagdale.official@gmail.com</a></li>
                        </ul>
                    </div>
                    {{-- <div class="col-md-4">
                        <h3>Menu Link</h3>
                        <ul class="link_menu">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="about.html"> about</a></li>
                            <li><a href="room.html">Our Room</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div> --}}
                    {{-- <div class="col-md-4">
                     <h3>News letter</h3>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div> --}}
                </div>
            </div>
            {{-- <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        
                        <p>
                        © 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a>
                        <br><br>
                        Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                        </p>

                     </div>
                  </div>
               </div>
            </div> --}}
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('input[name="dates"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
        });
    </script>
</body>

</html>
