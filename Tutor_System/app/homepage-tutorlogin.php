<?php

session_start();
$tutor_id = $_SESSION['login_id'];
// echo $tutee_id;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *Must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Tutor Labs</title>

    <!-- Favicon -->
    <link rel="icon" href="/img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> +65 6405 1202</a>
                <a href="#"><span>Email:</span> info@Tutor_Labs.com</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="cleverNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="index.html"><b>Tutor Labs</a></b>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                
                                </li>
                                <li><a href="courses.html">Subjects</a></li>
                                <li><a href="instructors.php">Instructors</a></li>
                                
                                <li><a href="contact.html">Contact</a></li>
                            </ul>

                            <!-- Search Button -->
                            <div class="search-area">
                                <form action="#" method="post">
                                    <input type="search" name="search" id="search" placeholder="Search">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>

                            <!-- Register / Login -->
                            <div class="login-state d-flex align-items-center">
                                <div class="user-name mr-30">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$tutor_id?></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                            <a class="dropdown-item" href="#">Profile</a>
                                            <a class="dropdown-item" href="#">Account Info</a>
                                            <a class="dropdown-item" href="homepage-tutorlogin.php">Tutee Requests</a>
                                            <a class="dropdown-item" href="homepage-general.php">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="userthumb">
                                    <img src="img/bg-img/t1.png" alt="">
                                </div>
                            </div>

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area bg-img bg-overlay-2by5" style="background-image: url(img/bg-img/bg1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Hero Content -->
                    <div class="hero-content text-center">
                        <h2>Learning Made Simple</h2>
                        <a href="instructors.php" class="btn clever-btn">Find Tutors</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Request Table##### -->
    </style>
</head>
<br><br>
<body>
    <div id="main-container" class="container">
    <div class="section-heading">
        <h1 class="display-4"><h1><b>Tutee Requests</h1></b><br>
        <table id="bookingsTable" class='table table-striped' border='1'>
            <thead class='thead-dark'>
                <tr>
                    <th>Booking ID</th>
                    <th>Tutee ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    
                </tr>
                <!-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> -->
            </thead>
        </table>
        <br>
        <h3 id="errors"></h3>
    </div>
    <html>
    <script>
        

            $(async() => {           
                var serviceURL = "http://127.0.0.1:5002/booking/tutee/Jose@gmail.com";
        
                try {
                    const response =
                    await fetch(
                    serviceURL, { method: 'GET' }
                    );
                    const data = await response.json();
                    var bookings = data.Bookings;
                    console.log(bookings);
                    // console.log(!tutors);
                    // console.log(tutors.length);

        
                    if (!bookings || !bookings.length) {
                        showError('No Bookings.')
                    } else {
                        var rows = "";
                        // console.log(tutors);
                        for (const booking of bookings) {
                            // console.log(tutor);
                            eachRow = 
                                "<td>" + booking.booking_id + "</td>" +
                                "<td>" + booking.tutee_id + "</td>" +
                                "<td>" + booking.subject + "</td>" +
                                "<td>" + booking.status + "</td>";
                            // console.log(eachRow);
                            rows += "<tr>" + eachRow + "</tr>";
                            console.log(rows);
                        }
                        // console.log(book);
                        $('#bookingsTable').append(rows);
                    }
                } catch (error) {
                // Errors when calling the service; such as network error, 
                // service offline, etc
                // showError
                // ('There is a problem retrieving the book data, please try again later.<br />'+error);
                }
            });
        // });
    </script></div>
    </html>
    <br><br><br><hr>

    <!-- ##### Form Start ##### -->
    <div id="main-container" class="container">
    <div class="section-heading">
        <h2 class="display-4"><b><h1>Confirm Requests</h1></b><br>
        <form id="form"><h2>
            Booking ID<br></h2>
            <input type = "text" id = "booking_id"><br>
          
            
            <button type = "submit" id="submitBtnaccept" class="btn btn-primary" value="accept">Accept</button>&nbsp;&nbsp;
            <button type = "submit" id="submitBtnreject" class="btn btn-primary" value="reject">Reject</button>
        </form>
        
        <h3 id="errors"></h3>
    </div>
        </div>
    <html>
    <script>
        function showError(message) {

        $('#errors')
            .text(message);
        }

        $("#form").submit(async (event) => {   
            event.preventDefault(); 
            
            var booking_id = $("#booking_id").val();
            var status = "accept"

            var updateStatus = {
                booking_id: booking_id, 
                status: status
            };

            var serviceURL = "http://127.0.0.1:5001/tutor/accept";

            try {
                const response =
                    await fetch(
                        serviceURL, { 
                            method: 'POST',
                            headers: {"Content-Type": "application/json"},
                            mode: 'cors',
                            body: JSON.stringify(updateStatus)
                            });

                const request = await response.json();
    
                if (request.message) {
                    showError(request.message);
                } else {
                    showError("Your request has been updated!");
                }
            } catch (error) {
                showError
                ('There is a problem retrieving the tutor data, please try again later');
            }
        });
    </script>
    <!-- ##### Form End ##### -->
    </html>
 

    <!-- ##### Cool Facts Area Start ##### -->
    <section class="cool-facts-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <div class="icon">
                            <img src="img/core-img/docs.png" alt="">
                        </div>
                        <h2><span class="counter">1912</span></h2>
                        <h5>Success Stories</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <div class="icon">
                            <img src="img/core-img/star.png" alt="">
                        </div>
                        <h2><span class="counter">123</span></h2>
                        <h5>Dedicated Tutors</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <div class="icon">
                            <img src="img/core-img/events.png" alt="">
                        </div>
                        <h2><span class="counter">89</span></h2>
                        <h5>New Registrations</h5>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
                        <div class="icon">
                            <img src="img/core-img/earth.png" alt="">
                        </div>
                        <h2><span class="counter">56</span></h2>
                        <h5>Available Subjects</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Top Footer Area -->
        <div class="top-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Footer Logo -->
                        <div class="footer-logo">
                            <a href="index.html"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span>Phone:</span> +44 300 303 0266</a>
                <a href="#"><span>Email:</span> info@clever.com</a>
            </div>
            <!-- Follow Us -->
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>