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
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="#contact">Contact Us</a>
                                    </li> --}}
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

    <!-- about -->
    <div class="contact" id="book_now">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Book Now</h2>
                        <h3 style="text-align: left;color:blue;">Note: For booking a reservation, there is a down
                            payment of 500 pesos. The QR code for our G-Cash is shown below. </h3>
                        <h3 style="text-align: left;color:blue;">Note: Please attach a screenshot of your receipt as a
                            proof of payment.</h3>
                    </div>
                </div>
            </div>
            <form id="request" class="main_form" enctype="multipart/form-data" method="post"
                action="{{ route('reservation_process') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        @if (session('success'))
                            <div class="alert alert-success border-left-success alert-dismissible fade show"
                                role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <input type="hidden" value="{{ $date_from }}" name="date_from">
                        <input type="hidden" value="{{ $date_to }}" name="date_to">
                        <input class="contactus" placeholder="First Name" type="text" required name="first_name">
                    </div>
                    <div class="col-md-4">
                        <input class="contactus" placeholder="Middle Name" type="text" required
                            name="middle_name">
                    </div>
                    <div class="col-md-4">
                        <input class="contactus" placeholder="Last Name" type="text" required name="last_name">
                    </div>
                    <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="email" required name="email">
                    </div>
                    <div class="col-md-12">
                        <input class="contactus" placeholder="Phone Number" type="number" required name="number">
                    </div>
                    <div class="col-md-12">
                        <center>
                            <img src="{{ asset('/img/gcash.jpg') }}" class="img img-thumbnail"
                                style="height:500px;">
                        </center>
                        <br />
                    </div>
                    <div class="col-md-12">
                        <input type="file" class="contactus" required name="images" required>
                    </div>
                    <div class="col-md-12">
                        <p>
                            Note: A down payment of 500 pesos is non-refundable. Any circumstances may come unexpectedly
                            but we are sorry to say we have a policy for booking a reservation that has no return, no
                            exchange.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <br />
                        <input type="radio" name="agreement" id="agree" value="agree"
                            style="transform: scale(2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I Agree <br /><br />


                        <input type="radio" name="agreement" id="not_agree" value="not_agree"
                            style="transform: scale(2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I Do Not Agree

                    </div>
                    <div class="col-md-12">
                        <button class="send_btn float-right" style="display: none;" id="show_if_trigger" type="submit">Book Now</button>
                    </div>
                </div>
            </form>
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
                        <li style="margin-left:20px;">??? Nikan Resort is an exclusive resort. There is no limit to the
                            number of people who can
                            stay, and we have plenty of space for any gatherings. Most resorts that are located in El
                            Salvador are small, but we made ours big for its uniqueness among others.</li>
                    </ul>
                    <br />
                    <p>Do you have overnight stay?</p>

                    <ul>
                        <li style="margin-left:20px;">??? NO</li>
                    </ul>
                    <br />
                    <p>How much is the rent of your Kubo?</p>

                    <ul>
                        <li style="margin-left:20px;">??? We have a so called Bahay Kubo, there???s two types of it. First,
                            we have it with electric
                            fan (500.00 pesos) and the other one with aircon (1000.00 pesos). If you rented it, you can
                            use it until check out.</li>
                    </ul>
                    <br />
                    <p>What services do you offer for your guests?</p>

                    <ul>
                        <li style="margin-left:20px;">
                            ??? As of now we dont any services yet but we sell liquor at our resort to the guests.
                        </li>
                    </ul>
                    <br />
                    <p>What is the time limit or the check in and out of the guest in your resort?</p>

                    <ul>
                        <li style="margin-left:20px;">??? If they have reservation, they can use the whole resort from
                            9am (check in time) to 6pm
                            (check out time) but if they want to extend time, we can extend it up until 8pm but
                            additional 500.00 pesos per hour.</li>
                    </ul>
                    <br />
                    <p>Rate of you resort.</p>
                    <ul>
                        <li style="margin-left:20px;">??? 6,000 pesos exclusive for the day and they can use the function
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

                </div>
            </div>

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
        $('input[name="dates"]').daterangepicker();

        $("#agree").click(function() {
            $('#show_if_trigger').show();
        });

        $("#not_agree").click(function() {
            $('#show_if_trigger').hide();
        });
    </script>
</body>

</html>
