<?php

session_start();
$tutee_id = $_SESSION['login_id'];
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
    <link rel="icon" href="img/core-img/favicon.ico">

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
                                <li><a href="courses.html">Courses</a></li>
                                <li><a href="instructors.html">Instructors</a></li>
                                <li><a href="blog.html">Blog</a></li>
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
                                        <a class="dropdown-toggle" href="#" role="button" id="userName" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $tutee_id?></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userName">
                                            <a class="dropdown-item" href="#">Profile</a>
                                            <a class="dropdown-item" href="#">Account Info</a>
                                            <a class="dropdown-item" href="homepage.html">Logout</a>
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

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area">
        <!-- Breadcumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                
            </ol>
        </nav>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Instructors Video Start ##### -->
    <div class="instructors-video d-flex align-items-center justify-content-center bg-img" style="background-image: url(img/bg-img/bg4.jpg);">
        <h2>Learning is a Journey</h2>
        <!-- video btn -->
        <a href="https://www.youtube.com/watch?v=qC_T9ePzANg" class="video-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
    </div>
    <!-- ##### Instructors Video End ##### -->

    <!-- ##### Best Tutors Area Start ##### -->
    <section class="best-tutors-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>The Best Tutors in Town</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tutors-slide owl-carousel">

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/face.jpeg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                                <h5>Christopher Poskitt</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Chinese</p>
                                <p>Subject Rate: $50/h</p>
                                <p>Level: Primary</p>
                                <span>
                                <p>Christopher is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/Hong.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Ong Hong Seng</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Math</p>
                                <p>Subject Rate: $50/h</p>
                                <p>Level: Primary</p>
                                <span>
                                <p>Hong Seng is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/YS.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Yan Sheng</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Malay</p>
                                <p>Subject Rate: $35/h</p>
                                <p>Level: Secondary</p>
                                <span>
                                <p>Yan Sheng is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/Saran.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Saranpal Singh</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Chinese</p>
                                <p>Subject Rate: $35/h</p>
                                <p>Level: Pre-School</p>
                                <span>
                                <p>Saranpal is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Tutors Slide -->
                        <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/Yifan.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Zhou Yifan</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Tamil</p>
                                <p>Subject Rate: $35/h</p>
                                <p>Level: Secondary</p>
                                <span>
                                <p>Yifan is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                         <!-- Single Tutors Slide -->
                         <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/Maurice.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Maurice</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Science</p>
                                <p>Subject Rate: $30/h</p>
                                <p>Level: Pre-School</p>
                                <span>
                                <p>Maurice is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                         <!-- Single Tutors Slide -->
                         <div class="single-tutors-slides">
                            <!-- Tutor Thumbnail -->
                            <div class="tutor-thumbnail">
                                <img src="img/bg-img/J.jpg" alt="">
                            </div>
                            <!-- Tutor Information -->
                            <div class="tutor-information text-center">
                            <h5>Maurice</h5>
                                <span>Senior Tutor</span>
                                <p>Subject: Chemistry</p>
                                <p>Subject Rate: $30/h</p>
                                <p>Level: Primary</p>
                                <span>
                                <p>Jose is a very friendly and outgoing tutor who gives his all in teaching. He always ensures lessons are interesting and clear to tutees and checks their understanding before moving on. Highly recommended.</p>
                                <div class="social-info">
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Best Tutors Area End ##### -->

    <!-- ##### Form Start ##### -->
    <div id="main-container" class="container">
    <div class="section-heading">
        <h2 class="display-4"><b><h1>Request A Tutor</h1></b><br>
        <form id="form">
            <div class="form"><h2>Tutor Name</h2>
            <input type = "text" id = "tutor_id">
            <h2>Subject</h2>
            <input type = "text" id = "subject"><br>
            <br>
            <button type = "submit" id="submitBtn" class="btn btn-primary">Send Request</button>
        </form>
</div>
        <h3 id="errors"></h3>
    </div>

    <script>
        function showError(message) {

        $('#errors')
            .text(message);
        }

        $("#form").submit(async (event) => {   
            event.preventDefault(); 
            
            var tutee_id = '<?php echo $tutee_id; ?>';
            var tutor_id = $("#tutor_id").val();
            var subject = $("#subject").val();

            var addrequest = {
                tutee_id: tutee_id,
                tutor_id: tutor_id, 
                subject: subject
            };

            var serviceURL = "http://127.0.0.1:5000/tutee/request";

            try {
                const response =
                    await fetch(
                        serviceURL, { 
                            method: 'POST',
                            headers: {"Content-Type": "application/json"},
                            mode: 'cors',
                            body: JSON.stringify(addrequest)
                            });

                const request = await response.json();
    
                if (request.message) {
                    showError(request.message);
                } else {
                    showError("Your request has been sent!");
                }
            } catch (error) {
                showError
                ('There is a problem retrieving the tutor data, please try again later.<br />' + error);
            }
        });
    </script>
    </div>
    <!-- ##### Form End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Top Footer Area -->
        <div class="top-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Footer Logo -->
                        <div class="footer-logo">
                            <a href="index.html">Tutor Labs</a>
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